function create_result()
{
	var template = document.createElement('template');
	template.innerHTML = "<div class=\"result pressable\"><img class=\"result-img\"><p class=\"result-title\"></p></div>";
	return template.content.children[0];
}

var MAX_PAGES = 5; //keep as an odd number
var page_num = "<span class=\"clickable pagenum\"></span>";
var view_mode = "<span class=\"view-mode pressable\"></span>";
var default_sheets = style_pack; //provided from php

export default class PageManager
{
	constructor(q_results, //all current results
							results_total, //total, expected results
							limit_choices, //results per page posibilities
							show_callback, //function called when a result is clicked
							call_on_page=true, //determins if show_callback is called on page change
							selected_limit=false, //limit can be preset
							sheets=default_sheets) //style sheets for view-mode changes
	{
		this.current_page = 0;
		this.items = q_results;
		this.total_items = results_total;
		this.show_callback = show_callback;
		this.call_on_page = call_on_page;
		this.results_body = document.getElementById('results');
		this.st = new StyleChangeManager(sheets);

		this.lm = new LimitManager(limit_choices, selected_limit);
		this.n_pages = this.calculate_pages();

		this.pnm = new PageNumberManager(this.n_pages);
		this.pnm.page_selected = this.set_page.bind(this);

		let self = this;
		this.lm.limit_changed = function() //called when limit is changed
		{
			self.set_page(self.current_page);

			self.pnm.set_pages(self.calculate_pages());//calculate_pages also sets self.n_pages
			if (self.n_pages == 1)
			{
				self.current_page = 0;
				self.pnm.current_page = 0;
			}
			self.pnm.set_labels();
		};

		this.set_page(0);
	}
	// returns the number of elements on a given page
	result_count(page)
	{
		let lim = this.lm.limit();
		if (page == this.n_pages)
			return this.total_items % lim;
		else return lim;
	}

	calculate_pages()
	{
		return (this.n_pages = Math.ceil(this.total_items/this.lm.limit()));
	}
	// set the context for paging, aka what array results come from
	// returns the current_context
	set_context(array)
	{
		let current = this.items;

		this.items = array;
		this.total_items = array.length;

		this.pnm.set_pages(this.calculate_pages());
		this.pnm.set_labels();
		this.set_page(0);

		return current;
	}

	// 'page' to the current page
	set_page(index)
	{
		console.log('setting page: ',index,this.n_pages);
		this.current_page = index;
		let lim = this.lm.limit();

		{//set limit
			let res_count = this.result_count(index+1);
			lim = lim > res_count ? res_count : lim;
		}

		let results = this.results_body.children;
		let n_results = this.results_body.childElementCount;

		/*
			if the page limit does not match the amount of results we have currently on the page,
			remove or add results until these values match
		*/
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

		{ //populate the results with with their corresponding pictures and values

			let page_offset = this.current_page * this.lm.limit();
			for (var i = 0; (i < lim) && (page_offset+i < this.items.length); i++)
			{
				let res = results[i];
				res.children[0].src = this.items[page_offset + i].src;
				res.children[1].innerHTML = this.items[page_offset + i].title;
				res.value = page_offset+i;
			}

		}

		if (this.call_on_page) this.show_callback(results[0]);

	}
}

class PageNumberManager
{
	constructor(n_pages)
	{
		let navs = document.getElementsByClassName("navigate");
		this.arrows = [[],[]];
		this.nums = [[],[]];
		this.current_page = 0;
		this.set_pages(n_pages)
		this.page_selected = (index) => {};
		let self = this;
		for (var i = 0; i < navs.length; i++)
		{
			let child = this.create_child('<');
			child.addEventListener('click', () => self.beg());

			navs[i].appendChild(child); //add to dom
			this.arrows[i].push(child); //add to array

			if (this.current_page == 0)
				child.classList.add('invisible');
			let self = this;
			for (var k = 0; k < this.n_nums; k++)
			{
				child = this.create_child(k+1);
				child.value = k;
				child.innerHTML = k+1;
				if(k == this.current_page)
					child.classList.add('active');
				child.addEventListener('click',function() {
					self.select_page(this.value);
				});

				navs[i].appendChild(child); //add to dom
				this.nums[i].push(child); //add to array
			}

			child = this.create_child('>');
			child.addEventListener('click', () => self.end());

			navs[i].appendChild(child); //add to dom
			this.arrows[i].push(child); //add to array

			if (this.current_page == this.n_pages-1)
				child.classList.add('invisible');
		}
	}
	set_pages(n_pages)
	{
		this.n_nums = MAX_PAGES < n_pages ? MAX_PAGES : n_pages;
		this.n_pages = n_pages;
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
			if (this.current_page == 0)
			{
				top[0].classList.add('invisible');
				bot[0].classList.add('invisible');
			}
			else
			{
				top[0].classList.remove('invisible');
				bot[0].classList.remove('invisible');
			}

			if (this.current_page == this.n_pages-1)
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
		/*
			Consider the labels 1 2 3 4 5
			We want the current page to be displayed in the middle of the labels
			ie. 1 2 <3> 4 5 (3 is current). In this case, the index of the middle elm. is length/2.

			However, if we are on page 2, 1 <2> 3 4 5
				the number 2 cant be in the middle because there arent enough pages to pad it
				on the left. So, we have to shift the middle over.

			If we are on the 4th page, 1 2 3 <4> 5
			we have to shift the middle one to the right if there's only 5 pages,
			if theres more than 5 page we get 2 3 <4> 5 6: 4 Can be in the middle.

			The following accounts for these posibilities
		*/

		let mid = Math.floor(this.n_nums/2);
		let cp = this.current_page;

		if (cp < mid) mid = cp;
		else if (this.n_pages - cp < mid) mid += (this.n_pages - cp);

		for (var i = 0; i < this.nums.length; i++)
		{
			var children = this.nums[i];

			children[mid].value = cp;
			children[mid].innerHTML = cp+1;
			children[mid].classList.add('active');
			for (var k = 0; k < children.length; k++)
			{
				let val = cp - (mid-k);

				let ch = children[k];
				if (this.n_pages == 1 || val < 0 || val >= this.n_pages)
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
	constructor(style_sheets)
	{
		this.sheets = style_sheets;
		this.children = Array.from(document.getElementsByClassName('view-mode'));
		if (this.sheets === undefined)
		{
			console.log('no sheet provided');
			return;
		}

		let active = this.sheets['active'];
		delete this.sheets['active'];

		{ let chlen = this.children.length, shlen = Object.keys(this.sheets).length;
			parent = document.getElementById('views');
			var cnt = 0;
			while (chlen != shlen && cnt < 10)
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
				cnt++;
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
		this.sheets = Object.values(this.sheets);
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
	}
}

/*

	Handles the dom elements used to switch limits
	offers an event (LimitManager.limit_changed), called upon the limit changing
	LimitManager.limit() returns the current limit
*/
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
