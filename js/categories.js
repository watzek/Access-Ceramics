import {ajax_take_the_wheel, elaborate, get_range} from "./ajax.js";
import PageManager from "./PageManagement.js";
import Alphabet from './alphabet.js';

var LIMIT_CHOICES = [20,50,100,'all'];
var CHUNK_SIZE = 40;

window.onload = function()
{

	let count = q_results['count'];

	q_results = Object.values(q_results['res']);
	let n_results = q_results.length,
	 		page = parseInt(get_args['page']),
			limit = parseInt(get_args['limit']);

	document.getElementById('search-title').innerHTML = get_args['category']+' ('+count+')';

	// Alphabet sorts the array, so we call it before PageManager loads results
	var alp = new Alphabet(q_results,
				(get_args['category'] == 'artists') ? 'lname' : 'title',
				false,
				document.getElementById('alphabet'),
				'<span class=\'alphabet-letter clickable\'></span>'
				);

	var pm = new PageManager(q_results, count, LIMIT_CHOICES, navigate, false, false);

	alp.letter_clicked = (el,st,end) => {pm.set_context(q_results.slice(st,end));};

	// below not needed
	if (n_results < count)
		ajax_take_the_wheel(q_results, page*limit, n_results, count, CHUNK_SIZE);
}

function navigate(dom_elm)
{
	let id = dom_elm.value;
	let link = q_results[id]['id'];
	console.log(link);
	window.location.href = link;
}
