import {ajax_insert_range} from "./ajax.js";

function create_result()
{
	var template = document.createElement('template');
	template.innerHTML = "<div class=\"result pressable\"><img class=\"result-img\"><p class=\"result-title\"></p></div>";
	return template.content.children[0];
}

var MAX_PAGES = 5; //keep as an odd number
var page_num = "<span class=\"clickable pagenum\"></span>";
var view_mode = "<span class=\"view-mode pressable\"></span>";
var default_sheets = style_pack; //provided via php

import UrlManager from '/js/UrlManager.js';

/*
PageManager relies on 4 other classes
	PageNumberManager -> handles pagination
	LimitManager -> handles rpp (results per page)
	StyleChangeManager -> handles style changes for result styles
	UrlManager -> Handles setting the URL to reflect frontend changes (pagenum, view...)
*/
export default class PageManager
{
	constructor(array, //array of elements to be managed
							results_total, //total, expected results
							initial_page=1, //first page to access
							limit_choices, //results per page posibilities
							selected_limit=false, //limit can be preset
							show_callback, //function called when a result is clicked
							call_on_page=true, //determins if show_callback is called on page change
							sheets=default_sheets) //style sheets for view-mode changes
	{
		this.current_page = initial_page-1;
		this.items = array;
		this.total_items = results_total;
		this.show_callback = show_callback;
		this.call_on_page = call_on_page;
		this.results_body = document.getElementById('results');
		this.urlm = new UrlManager(_get);

		this.st = new StyleChangeManager(sheets,'',style => {this.urlm.set_url({'view':style});});

		this.lm = new LimitManager(limit_choices, selected_limit);
		this.n_pages = this.calculate_pages();

		this.pnm = new PageNumberManager(this.n_pages, this.current_page);
		this.pnm.page_selected = this.set_page.bind(this);

		let self = this;
		this.lm.limit_changed = function() //called when limit is changed
		{
			self.set_page(0);

			self.pnm.set_pages(self.calculate_pages(),0);//calculate_pages also sets self.n_pages
			if (self.n_pages == 1)
			{
				self.current_page = 0;
				self.pnm.current_page = 0;
			}
			self.pnm.set_labels();
			self.urlm.set_url({'limit':this.lm.limit()});
		};

		this.urlm.set_url({'limit':this.lm.limit(),'page':0+1});
		this.set_page(this.current_page);
	}

	// returns the number of elements on a given page
	result_count()
	{
		var amount;

		let lim =  this.lm.limit();
		if (this.current_page == this.n_pages-1 && this.total_items != lim)
			amount = this.total_items % lim;
		else amount = lim;

		return amount < lim ? amount : lim;
	}

	calculate_pages()
	{
		return (this.n_pages = Math.ceil(this.total_items/this.lm.limit()));
	}

	// set the context for paging, aka what array results come from
	// returns the previous context
	set_context(array)
	{
		let current = this.items;

		this.items = array;
		this.total_items = array.length;

		this.pnm.set_pages(this.calculate_pages(),0);
		this.pnm.set_labels();
		this.set_page(0);

		return current;
	}

	/*
		destroy/add dom elements to match lim
	*/
	align_children(lim)
	{
		let n_results = this.results_body.childElementCount;
		let results = this.results_body.children;
		while (n_results != lim)
		{
			let index = n_results-1;

			if (n_results > lim)
			{
				this.results_body.removeChild(results[index]);
				n_results--;
			}
			else
			{
				var newnode = create_result();
				let self = this;

				newnode.addEventListener('click', function(){self.show_callback(this);});

				this.results_body.insertBefore(newnode,results[results.length-1]);
				n_results++;
			}
		}
	}
	// 'page' to the current page
	set_page(index)
	{
		this.current_page = index;
		let lim = this.result_count(), limit = this.lm.limit();

		this.align_children(lim);
		let results = this.results_body.children;

		// for (var i = 0; i < lim; i++)
		// {
		// 	let res = results[i];
		// 	console.log(res);
		// 	res.children[0].classList.add('loading');
		// }

		{ //populate the results with with their corresponding pictures and values
			let page_offset = this.current_page * limit;
			for (var i = 0; (i < lim); i++)
			{
				let res = results[i];

				let _i = page_offset + i
				if (this.items[_i] === undefined)
				{
					ajax_insert_range(this.items, _i, limit, () => {this.set_page(index)});
					return;
				}

				res.children[0].src = this.items[_i].src; //picture
				res.children[1].innerHTML = this.items[_i].title; //text
				res.value = _i;
			}
		}
		if (this.call_on_page) this.show_callback(results[0]);
		this.urlm.set_url({'page':this.current_page+1});
	}

} //end PageManager

class PageNumberManager
{
	constructor(n_pages, initial_page=1)
	{
		this.navs = document.getElementsByClassName("navigate");
		this.arrows = [[],[]];
		this.nums = [[],[]];
		this.set_pages(n_pages, initial_page);
		this.page_selected = (index) => {};

		let self = this;
		for (var i = 0; i < this.navs.length; i++)
		{
			let child = this.create_child('<');
			child.addEventListener('click', () => self.beg());
			this.navs[i].appendChild(child); //add to dom
			this.arrows[i].push(child); //add to array


			child = this.create_child('>');
			child.addEventListener('click', () => self.end());
			this.navs[i].appendChild(child); //add to dom
			this.arrows[i].push(child); //add to array
		}
		this.set_labels();
	}

	align_children()
	{
		let self = this;
		for (var i = 0; i < this.nums.length; i++)
			while (this.nums[i].length != this.n_labels)
			{
				let nav = this.navs[i];
				if (this.nums[i].length < this.n_labels)
				{
					let child = this.create_child('');
					child.addEventListener('click',function() {
						self.select_page(this.value);
					});
					nav.insertBefore(child, nav.children[nav.childElementCount-1]); //add to dom
					this.nums[i].push(child); //add to array
				}
				else
				{
					nav.removeChild(nav.children[nav.childElementCount-2]); //remove from dom
					this.nums[i].pop(); //remove to array
				}
			}
	}

	set_pages(n_pages, current_page)
	{
		this.n_labels = MAX_PAGES < n_pages ? MAX_PAGES : n_pages;
		this.n_pages = n_pages;
		this.current_page = current_page;
	}

	valid_then_set(index)
	{
		if (index < 0 || index >= this.n_pages)
		{
			console.log('no page at this index!', index, this.n_pages);
			return false;
		}
		this.current_page = index;

		return true;
	}

	beg()
	{
		this.current_page = 0;
		this.set_labels();
		this.page_selected(this.current_page);
	}

	end()
	{
		this.current_page = this.n_pages-1;
		this.set_labels();
		this.page_selected(this.current_page);
	}

	prev()
	{
		if (!this.valid_then_set(this.current_page-1)) return;

		this.set_labels();
		this.page_selected(this.current_page);
	}

	next()
	{
		if (!this.valid_then_set(this.current_page+1)) return;

		this.set_labels();
		this.page_selected(this.current_page);
	}

	select_page(index)
	{
		if (!this.valid_then_set(index)) return;

		this.set_labels();
		this.page_selected(index);
	}

	create_child(innerHTML)
	{
		let neweml = document.createElement('template');
		neweml.innerHTML = page_num;
		neweml = neweml.content.children[0];
		neweml.innerHTML = innerHTML;
		return neweml;
	}

	set_labels()
	{
		{//decide whether edge arrow should be visible
			let top = this.arrows[0];
			let bot = this.arrows[1];
			if (this.current_page == 0 || this.n_pages <= this.n_labels)
			{
				top[0].classList.add('invisible');
				bot[0].classList.add('invisible');
			}
			else
			{
				top[0].classList.remove('invisible');
				bot[0].classList.remove('invisible');
			}

			if (this.current_page == this.n_pages-1 || this.n_pages <= this.n_labels)
			{
				top[1].classList.add('invisible');
				bot[1].classList.add('invisible');
			}
			else
			{
				top[1].classList.remove('invisible');
				bot[1].classList.remove('invisible');
			}
		}

		this.align_children();
		let mid = Math.floor(this.n_labels/2);
		let cp = this.current_page;

		if (cp < mid) mid = cp;
		else if (this.n_pages - cp <= mid) mid = this.n_labels - (this.n_pages - cp);

		for (var i = 0; i < this.nums.length; i++)
		{
			let children = this.nums[i];
			children[mid].value = cp;
			children[mid].innerHTML = cp+1;
			children[mid].classList.add('active');
			for (var k = 0; k < children.length; k++)
			{
				let val = cp - (mid-k);

				let ch = children[k];
				if (this.n_pages == 1)
				{
					ch.innerHTML = '';
					ch.value = -1;
				}
				else
				{
					ch.innerHTML = val+1;
					ch.value = val;
				}
				if (val != cp)
					ch.classList.remove('active');
			}
		}
	}
}

/*
	Handles the dom elements associated with changing style sheets (for result styling)
	and sets style based on passed array of style paths
*/
class StyleChangeManager
{
	constructor(style_sheets, active_style = '', style_changed = () => {})
	{
		this.sheets = style_sheets;
		this.style_changed = style_changed;
		this.children = Array.from(document.getElementsByClassName('view-mode'));
		if (this.sheets === undefined)
		{
			console.log('no sheet provided');
			return;
		}

		let active = this.sheets['active'];
		delete this.sheets['active'];
		if (active_style != '' && this.sheets[active_style] !== undefined)
			active = this.sheets[active_style]

		{
			let chlen = this.children.length, shlen = Object.keys(this.sheets).length;
			parent = document.getElementById('views');
			let count = 0;
			while (chlen != shlen && count < 10)
			{
				if (chlen > shlen)
				{
					parent.removeChild(this.children[chlen-1]);
					chlen--;
				}
				else
				{
					let cp = document.createElement('template');
					cp.innerHTML = view_mode;
					parent.appendChild(cp.content.children[0]);
					chlen++;
				}
				count++;
			}
		}

		let keys = Object.keys(this.sheets);
		let self = this;
		for (var i = 0; i < this.children.length; i++)
		{
			let key = keys[i];

			this.children[i].addEventListener('click', function()
			{
				self.set_style(this.value);
			});
			this.children[i].value = i;
			this.children[i].innerHTML = key;
			if (key == active) this.children[i].classList.add('active-view');
		}
		this.keys = Object.keys(this.sheets);
		this.sheets = Object.values(this.sheets);
		this.style_changed(active);
	}

	set_style(index)
	{
		if (index < 0 || index >= this.sheets.length)
			console.log('no style sheet at invalid index:',index);

		document.getElementById("pagestyle").setAttribute("href", this.sheets[index]);
		this.children.forEach( function(element, ind)
		{
			if (index == ind)
				element.classList.add('active-view');
			else
				element.classList.remove('active-view');
		});
		this.style_changed(this.keys[index]);
	}
}

class LimitManager
{
	constructor(limit_choices, selected_limit = false)
	{
		this.limit_changed = () => {};
		this.choices = limit_choices;
		this.children = document.getElementsByClassName("limit-choice");
		this.selected = selected_limit ? selected_limit : 0;

		var parent = this;
		for (var i = 0; i < this.choices.length; i++)
		{
			let child = this.children[i];

			child.value = i;
			child.innerHTML = this.choices[i];

			child.addEventListener('click', function()
			{
				parent.set_limit(this.value);
			});

			if (this.selected == i ) child.classList.add('active')
			else if (child.classList.contains('active')) child.classList.remove('active');
		}
	}

	set_limit(ind)
	{
		if(ind < 0 || ind >= this.choices.length || this.choices[ind] == this.limit)
		{
			console.log('limit remains unchanged');
			return;
		}

		this.children[this.selected].classList.remove('active');
		this.selected = ind;
		this.children[ind].classList.add('active');

		this.limit_changed();
		console.log("Browse Limit set to: " + this.choices[ind]);
	}

	limit()
	{
		let choice = this.choices[this.selected];
		if (choice == 'all') return 10000;

		return choice;
	}
}
