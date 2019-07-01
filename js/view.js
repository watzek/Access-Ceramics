var view;
//var q_results passed by PHP
//var get_args passed by PHP
var LIMIT_CHOICES = [20,50,100,'all'];

window.onload = function()
{
	var results = document.getElementsByClassName('result');
	var viewmeta = document.getElementById('view-meta').childNodes;
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

	view.img.src = q_results[0].src;
	for (var i = 0; i < results.length; i++) {
		results[i].childNodes[0].src = q_results[i].src;
		results[i].onclick = makeShow(i);
	}
	PLM = new PageLimitManager(LIMIT_CHOICES);
}

function makeShow(id)
{
	return function()
	{
		showImage(id);
	}
}

function showImage(id)
{
	view.img.src = q_results[id].original;
	view.title.innerHTML = q_results[id].title;
	view.title.artist = q_results[id].artist;
}
/*
	Set arg, repartition pages, add new elements/remove old elements

*/
class PageLimitManager
{
	constructor(limit_choices)
	{
		this.choices = limit_choices;
		this.current = 1;
		this.children = document.getElementsByClassName("limit-choice");
		var parent = this;
		for (var i = 0; i < this.choices.length; i++) {
			var child = this.children[i];

			if(child.classList.contains('active'))
				this.current = i;

			child.value = i;
			child.innerHTML = this.choices[i];

			child.addEventListener('click', function()
			{
				console.log(this.value);
			});
		}
		this.set_limit(this.current);
	}

	set_limit(ind)
	{
		console.log(ind);
		if(ind >= 0 && ind < this.choices.length)
		{
			this.children[this.current].classList.remove('active');
			this.current = ind;
			this.children[this.current].classList.add('active');
		}

	}
}

class PageViewManager
{
	constructor()
	{
		
	}

}

class AjaxHandler
{
	constructor()
	{

	}

}

class PageManager
{
	init(q_results)
	{
		this.navs = document.getElementsByClassName("navigate");
		this.partitions = [];
		this.partition();
		this.items = q_results;
	}

	partition(page_limit)
	{
		var len = this.items.length/page_limit;
		for (var i = 0; i < len; i++)
			for (var k = i * page_limit; k < page_limit; k++)
				this.partitions[i] = this.items[k];
	}

	get_page_content(page_num)
	{
		if(page_num >= this.partitions.length || page_num < 0)
			return false;

		return this.partitions[page_num];
	}

}