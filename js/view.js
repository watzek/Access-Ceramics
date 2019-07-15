import {elaborate, get_range} from "./ajax.js";

var view;
//var q_results passed by PHP
//var get_args passed by PHP
var LIMIT_CHOICES = [20,50,100,'all'];

var results_offset = [2,1];// where 'actual' results start and end

var page_num = "<span class=\"clickable pagenum\"></span>";

var MAX_PAGES = 5; //keep as an odd number

window.onload = function()
{
	let chunk_size = 40;

	var results = document.getElementsByClassName('result').children;

	//get references to all the elements needed in displaying image data
	view = {
		img : document.getElementById('view-img'),
			title : document.getElementById('meta-title'),
			stitle : document.getElementById('meta-stitle'),
			artist : document.getElementById('meta-artist'),
			date : document.getElementById('meta-date'),
			technique : document.getElementById('meta-technique'),
			temperature : document.getElementById('meta-temperature'),
			glazing : document.getElementById('meta-glazing'),
			material : document.getElementById('meta-material'),
			height : document.getElementById('meta-height'),
			width : document.getElementById('meta-width'),
			depth : document.getElementById('meta-depth'),
			license : document.getElementById('meta-license')
		};
	//show_image(0); //initialize viewpane with first image

	/*for (var i = 0; i < q_results.length; i++) {
	}*/

	let query_time = q_results['time'];
	let count = q_results['count'];
	q_results = Object.values(q_results['res']);
	let n_results = q_results.length; 

	if (n_results < count)
	{
		ajax_take_the_wheel(n_results, count, chunk_size);
	}
	var pm = new PageManager(LIMIT_CHOICES, q_results, count);
}

function ajax_take_the_wheel(current_amount, target, chunk_size)
{
	let current = current_amount;

	for (current; current+chunk_size < target; current += chunk_size) {
		get_range(current, chunk_size, (resText) => {
				if(resText !== '')
				{
					let obj = Object.values(JSON.parse(resText)['res']);
					q_results.push.apply(q_results, obj);
				}
			});
	}
	//might instead have callback function just call this function again
	//incase queries will arrive out of order
}


function create_result()
{
	var template = document.createElement('template');
	template.innerHTML = "<div class=\"result pressable\"><img class=\"result-img\"><p class=\"result-title\"></p></div>";
	return template.content.children[0];
}

//show image with given ID in the viewpane
function show_image(id)
{
	if (id < 0 || id >= q_results.length)
	{
		console.log('invalid id: '+id);
		return;
	}

	/*
		If we dont have meta-data for the given image yet,
		query db using ajax and upon retrieval store the information and call the function again
	*/
	if (q_results[id]['info'] === undefined)
	{
		let real_id = q_results[id]['id'];
		elaborate(real_id, (resText) =>{
			q_results[id]['info'] = JSON.parse(resText)[0];
			show_image(id);
		});
		return;
	}


	let info = q_results[id]['info'];
	view.img.src = info['src'];
	view.title.innerHTML = info['title'];
	view.artist.innerHTML = info['artist'];
	view.date.innerHTML = info['date'];
	
	view.stitle.innerHTML = info['stitle'] === undefined ? '' : '( '+info['stitle']+' )';

	view.technique.innerHTML = info['tech'];
	view.temperature.innerHTML = info['temp'];
	view.glazing.innerHTML = Object.values(info['glazing']).join(', ');
	view.material.innerHTML = Object.values(info['material']).join(', ');
	view.height.innerHTML = info['h'];
	view.width.innerHTML = info['w'];
	view.depth.innerHTML = info['d'];
	view.license.innerHTML = info['lic'];
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
				child1.children[1].classList.add('invisible');
				child2.children[1].classList.add('invisible');
			}else 
			{
				child1.children[1].classList.remove('invisible');
				child2.children[1].classList.remove('invisible');			
			}
		}

		let mid = Math.floor(this.n_nums/2);
		let cp = this.current_page;
		let end = this.n_pages

		while (cp < mid) 
		{
			console.log('--');
			mid--;
		}
		while (this.n_pages - cp < mid) 
		{
			console.log('++');
			mid++;
		}
		console.log('mid ',mid);
		
		for (var i = 0; i < this.navs.length; i++) 
		{
			//var children = Array.from(this.navs[i].children).slice(1,-1);
			var children = this.navs[i].children;
			
			children[mid+1].value = cp;
			children[mid+1].innerHTML = cp+1;
			children[mid+1].classList.add('active');

			for (var k = 1; k <= mid; k++) 
			{
				let left = mid - k;
				let right = mid + k;

				if (left >= 0)
				{
					let ch = children[left+1];
					ch.innerHTML = cp-k+1;
					ch.value = cp-k;
					ch.classList.remove('active');
				}
				if (right < this.n_pages)
				{

					let ch = children[right+1];
					ch.innerHTML = cp+k+1;
					ch.value = cp+k;
					ch.classList.remove('active');	
				}
			}	
		}
	}
}


class PageManager
{
	constructor(limit_choices, q_results, results_total, selected_limit=false)
	{
		this.current_page = 0;
		this.items = q_results; 
		this.total_items = results_total; 
		
		this.vm = new ViewManager();
		this.lm = new LimitManager(limit_choices, selected_limit);
		
		this.n_pages = Math.ceil(this.total_items/this.lm.limit());

		this.pnm = new PageNumberManager(this.n_pages);
		this.pnm.page_selected = this.set_page.bind(this);

		let self = this;
		this.lm.limit_changed = function()
		{
			self.current_page = 0;
			self.set_page(self.current_page);
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
		let n_results = this.results_body.childElementCount-(results_offset[0] + results_offset[1]);

		/*
			if the page limit does not match the amount of results we have currently on the page,
			remove or add results until these values match
		*/
		while (n_results != lim)
		{
			let index = n_results - (results_offset[1] + 1);

			if (n_results > lim)
			{
				this.results_body.removeChild(results[index]);
				n_results--;
			}
			else
			{
				var newnode = create_result();
				newnode.addEventListener('click', function(){show_image(this.value);});
				this.results_body.insertBefore(newnode,results[results.length-1]);
				n_results++;
			}
		}

		/*
			populate the results with with their corresponding pictures and values
		*/
		let page_offset = this.current_page * this.lm.limit();

		for (var i = 0; i < lim && page_offset+i < this.total_items; i++) {
			
			let res = results[i+results_offset[0]];
			res.children[0].src = this.items[page_offset + i].src;
			res.children[1].innerHTML = this.items[page_offset + i].title;
			res.value = page_offset+i;
		}

		show_image(0);
	}
}

/*
	handles the DOM elements and event handlers for 
	settting the limit
	changes to limit fire the event LimitManger.limitChanged
	
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
		return this.choices[this.selected];
	}
}
/*
	clear page, populate page(array)
*/
class ViewManager
{
	constructor()
	{
		
	}

}
