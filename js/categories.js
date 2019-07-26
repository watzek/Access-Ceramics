import {ajax_take_the_wheel, elaborate, get_range} from "./ajax.js";
import PageManager from "./PageManagement.js";
import make_alphabet from './alphabet.js';

var LIMIT_CHOICES = [20,50,100,'all'];
var results_offset = [2,1];

window.onload = function()
{
	let chunk_size = 40;

	var results = document.getElementsByClassName('result').children;

	let count = q_results['count'];

	q_results = Object.values(q_results['res']);
	let n_results = q_results.length; 
	

	make_alphabet(q_results,
				'lname',
				false,
				document.getElementById('alphabet'),
				'<span class=\'alphabet-letter\'></span>',
				function()
				{
					console.log(this);
				}
				);

	var pm = new PageManager(q_results, count, results_offset, LIMIT_CHOICES, navigate, false, false);

	if (n_results < count) ajax_take_the_wheel(q_results, n_results, count, chunk_size);

	document.getElementById('search-title').innerHTML = get_args['category']+' ('+count+')';

}

function navigate(dom_elm)
{
	let id = dom_elm.value;
	let link = q_results[id]['id'];
	console.log(link);
	window.location.href += link;
}