import {ajax_take_the_wheel, elaborate, get_range} from "./ajax.js";
import PageManager from "./PageManagement.js";
import Alphabet from './alphabet.js';

var LIMIT_CHOICES = [20,50,100,'all'];

window.onload = function()
{
	let chunk_size = 40;

	var results = document.getElementsByClassName('result').children;

	let count = q_results['count'];

	q_results = Object.values(q_results['res']);
	let n_results = q_results.length;

// Alphabet sorts the array, so we call it before PageManager loads results
	let alp = new Alphabet(q_results,
				(get_args['category'] == 'artists') ? 'lname' : 'title',
				false,
				document.getElementById('alphabet'),
				'<span class=\'alphabet-letter clickable\'></span>'
				);

	var pm = new PageManager(q_results, count, LIMIT_CHOICES, navigate, false, false);

	alp.letter_clicked = (el,st,end) => {pm.set_context(q_results.slice(st,end));};

	if (n_results < count) ajax_take_the_wheel(q_results, n_results, count, chunk_size);

	document.getElementById('search-title').innerHTML = get_args['category']+' ('+count+')';

}

function navigate(dom_elm)
{
	let id = dom_elm.value;
	let link = q_results[id]['id'];
	console.log(link);
	window.location.href = link;
}
