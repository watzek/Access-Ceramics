var view;

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
}