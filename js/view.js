var view;

window.onload = function()
{
	var results = document.getElementsByClassName('result');
	var viewmeta = document.getElementById('view-meta').childNodes;
	view = {
		img : document.getElementById('view-img'),
			title : viewmeta[0],
			stitle : viewmeta[1],
			artist : viewmeta[2],
			date : viewmeta[3],
			technique : viewmeta[4],
			temperature : viewmeta[5],
			glazing : viewmeta[6],
			material : viewmeta[7],
			height : viewmeta[8],
			width : viewmeta[9],
			depth : viewmeta[10],
			license : viewmeta[11]
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