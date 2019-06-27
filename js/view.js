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

	view.img.src = q_results[0].original;
	for (var i = 0; i < results.length; i++) {
		results[i].childNodes[0].src = q_results[i].src;
		results[i].onclick = makeShow(i);
	}
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
function PageLimitManager()
{
	this.init = function(limit_choices)
	{
		this.choices = limit_choices;
		this.current = 1;
		this.children = document.getElementsByClassName("limit-choice");
		for (var i = 0; i < choice.length; i++) {
			if(choice.classList.contains('active'))
				this.current = i;
			choice[i].onclick = () =>
			{
				set_limit(this.value);
			}
		}
	}

	this.set_limit = function(ind)
	{
		console.log(ind);
		if(ind >= 0 && ind < this.choices.length)
		{
			this.children[current].classList.remove('active');
			this.current = ind;
		}

	}
}

function PageViewManager()
{
	this.init = function()
	{
		
	}

}

function AjaxHandler()
{
	this.init = function()
	{

	}

}

function PageManager()
{
	this.init = function(q_results)
	{
		this.navs = document.getElementsByClassName("navigate");
		this.partitions = [];
		this.partition();
		this.items = q_results;
	}

	this.partition = function(page_limit)
	{
		var len = this.items.length/page_limit;
		for (var i = 0; i < len; i++)
			for (var k = i * page_limit; k < page_limit; k++)
				this.partitions[i] = this.items[k];
	}

	this.get_page_content = function(page_num)
	{
		if(page_num >= this.partitions.length || page_num < 0)
			return false;

		return this.partitions[page_num];
	}

}