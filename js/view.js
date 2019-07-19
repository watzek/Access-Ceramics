import {ajax_take_the_wheel, elaborate, get_range} from "./ajax.js";
import PageManager from "./PageManagement.js";

var view;
var meta_info = {};
//var q_results passed by PHP
//var get_args passed by PHP
var LIMIT_CHOICES = [20,50,100,'all'];
var results_offset = [2,1];
var current_selection;
// where 'actual' results start and end

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
			object :  document.getElementById('meta-object'),
			height : document.getElementById('meta-height'),
			width : document.getElementById('meta-width'),
			depth : document.getElementById('meta-depth'),
			license : document.getElementById('meta-license')
		};

	let query_time = q_results['time'];
	let count = q_results['count'];
	q_results = Object.values(q_results['res']);
	let n_results = q_results.length; 
	var pm = new PageManager(q_results, count, results_offset, LIMIT_CHOICES, show_image, true, false);
	if (n_results < count)
		ajax_take_the_wheel(q_results, n_results, count, chunk_size);
}

//show image with given ID in the viewpane
function show_image(dom_elm)
{
	if (dom_elm == current_selection) return;

	let id = parseInt(dom_elm.value);

	if (id < 0 || id >= q_results.length)
	{
		console.log('invalid id: '+id);
		return;
	}

	let real_id = q_results[id]['id'];

	if (meta_info[real_id] === undefined)
	{	
		meta_info[real_id] = 1;
		elaborate(real_id, (resText) =>
		{
			try
			{
				meta_info[real_id] = JSON.parse(resText);
				show_image(dom_elm);
			}
			catch(e)
			{
				console.log(resText,e);
			}
				
		});
		return;
	}

	if (1 == meta_info[real_id])
	{
		console.log('waiting for server response');
		return;
	}

	let info = meta_info[real_id];

	view.img.src = info['src'];
	view.title.innerHTML = info['title'];
	view.artist.innerHTML = info['artist'];
	view.date.innerHTML = info['date'];

	view.stitle.innerHTML = info['stitle'] === undefined ? '' : '( '+info['stitle']+' )';
	view.technique.innerHTML = info['technique'] === undefined ? '' : info['technique'];
	view.temperature.innerHTML = info['temperature'] === undefined ? '' : info['temperature'];
	view.height.innerHTML = info['h'] === undefined ? '' : info['h'];
	view.width.innerHTML = info['w'] === undefined ? '' : info['w'];
	view.depth.innerHTML = info['d'] === undefined ? '' : info['d'];
	view.license.innerHTML = info['license'] === undefined ? '' : info['license'];

	view.glazing.innerHTML = info['glazing'] == [] ? '' : Object.values(info['glazing']).join(', ');
	view.material.innerHTML = info['material'] == [] ? '' : Object.values(info['material']).join(', ');
	view.object.innerHTML = info['object'] == [] ? '' : Object.values(info['object']).join(', ');	

	if (current_selection !== undefined)
	{
		current_selection.classList.remove('active-res');
	}
	current_selection = dom_elm;
	dom_elm.classList.add('active-res');
}
