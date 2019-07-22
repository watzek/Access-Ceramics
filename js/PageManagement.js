function create_result()
{
	var template = document.createElement('template');
	template.innerHTML = "<div class=\"result pressable\"><img class=\"result-img\"><p class=\"result-title\"></p></div>";
	return template.content.children[0];
}

var MAX_PAGES = 5; //keep as an odd number
var page_num = "<span class=\"clickable pagenum\"></span>";


export default class PageManager
{
	constructor(q_results, results_total, res_elm_offs = [0,0], limit_choices, show_callback, call_on_page=true, selected_limit=false)
	{
		this.current_page = 0;
		this.items = q_results; 
		this.total_items = results_total; 
		this.lm = new LimitManager(limit_choices, selected_limit);
		
		this.n_pages = Math.ceil(this.total_items/this.lm.limit());

		this.pnm = new PageNumberManager(this.n_pages);
		this.pnm.page_selected = this.set_page.bind(this);

		this.res_elm_offs = res_elm_offs;
		this.show_callback = show_callback;
		this.call_on_page = call_on_page;

		let self = this;
		this.lm.limit_changed = function()
		{
			self.set_page(self.current_page);

			self.n_pages = Math.ceil(self.total_items/self.lm.limit())
			self.pnm.n_pages = self.n_pages;	
			if (self.n_pages == 1)
			{
				self.current_page = 0;		
				self.pnm.current_page = 0;
			}
			self.pnm.set_labels();
		};

		this.results_body = document.getElementById('results');
		this.set_page(0);

	}

	result_count(page)
	{
		let lim = this.lm.limit();
		if (page == this.n_pages)
			return this.total_items % lim;
		else return lim;
	}

	set_page(index)
	{
		this.current_page = index;
		let lim = this.lm.limit();
		
		lim = lim > this.total_items ? this.total_items : lim;

		let results = this.results_body.children;
		let n_results = this.results_body.childElementCount-(this.res_elm_offs [0] + this.res_elm_offs [1]);

		/*
			if the page limit does not match the amount of results we have currently on the page,
			remove or add results until these values match
		*/
		while (n_results != lim)
		{
			let index = n_results - (this.res_elm_offs [1] + 1);

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

		/*
			populate the results with with their corresponding pictures and values
		*/
		let page_offset = this.current_page * this.lm.limit();
		console.log(page_offset, this.items.length, this.total_items);
		for (var i = 0; (i < lim) && (page_offset+i < this.items.length); i++) 
		{	
			let res = results[i+this.res_elm_offs[0]];
			res.children[0].src = this.items[page_offset + i].src;
			res.children[1].innerHTML = this.items[page_offset + i].title;
			res.value = page_offset+i;
		}
		if (this.call_on_page) this.show_callback(results[this.res_elm_offs[0]]);
	}
}


class PageNumberManager
{
	constructor(n_pages)
	{
		this.navs = document.getElementsByClassName("navigate");
		this.current_page = 0;
		this.n_nums = MAX_PAGES < n_pages ? MAX_PAGES : n_pages;
		this.n_pages = n_pages;
		this.page_selected = (index) => {};
		let self = this;
		for (var i = 0; i < this.navs.length; i++)
		{
			let child = this.create_child('<');
			child.addEventListener('click', () => self.prev());
			this.navs[i].appendChild(child);
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

				this.navs[i].appendChild(child);
			}

			child = this.create_child('>');
			child.addEventListener('click', () => self.next());
			this.navs[i].appendChild(child);
			if (this.current_page == this.n_pages-1)
				child.classList.add('invisible');
		}
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

	}
	
	end()
	{

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
			let child1 = this.navs[0];
			let child2 = this.navs[1];
			if (this.current_page == 0)
			{
				child1.children[0].classList.add('invisible');
				child2.children[0].classList.add('invisible');
			}
			else 
			{
				child1.children[0].classList.remove('invisible');
				child2.children[0].classList.remove('invisible');	
			}

			if (this.current_page == this.n_pages-1)
			{
				child1.children[child1.childElementCount-1].classList.add('invisible');
				child2.children[child2.childElementCount-1].classList.add('invisible');
			}else 
			{
				child1.children[child1.childElementCount-1].classList.remove('invisible');
				child2.children[child2.childElementCount-1].classList.remove('invisible');			
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
			we have to shift if there's only 5 pages, but if theres more than 5
			we get 2 3 <4> 5 6, and 4 can be in the middle.
		*/
		let mid = Math.floor(this.n_nums/2);
		let cp = this.current_page;
		let end = this.n_pages

		while (cp < mid) mid--;
		while (this.n_pages - cp < mid) mid++;
		for (var i = 0; i < this.navs.length; i++) 
		{
			var children = this.navs[i].children;
			
			children[mid+1].value = cp;
			children[mid+1].innerHTML = cp+1;
			children[mid+1].classList.add('active');
			for (var k = 0; k < this.n_nums; k++)
			{
				let val = cp - (mid-k);
				
				let ch = children[k+1];
				if (val < 0 || val >= this.n_pages)
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
PageManager outer info
	- nagivate dom-elms
	- q_results
	- total results
	- limit-choices
	- ajax calls for missing results


ViewManager
	- results dom-elm
	- results start offset

-set_limit-
*upon button press*
set the limit, and call partition

-partition-
see how many results there are, and what the current
results per page is to determine page count,
create partition indicators (page numbers),
populate page (page view manager)

-switch page-
have ViewManager remove existing elements
get next 'page' of results and feed to ViewManager

-set page(lim, items)-
	change # of results to match lim, then fill in results

-clear page-
remove all results

-populate page(array)-
populate the page with given array of results

-set rpp (int)-
sets the results per page to the given int,
repartitions pages
resets page index to page 1
then populates page
*/

/*
	partition, switch page, set rpp
*/

/*
	handles the DOM elements and event handlers for 
	settting the limit.
	
	*changes to limit fire the event LimitManger.limit_changed*
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
