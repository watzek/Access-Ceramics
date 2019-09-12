import PageManager from "./PageManagement.js";
import Alphabet from './alphabet.js';

var LIMIT_CHOICES = [20,50,100,'all'];
var CHUNK_SIZE = 40;

var get_item;

window.onload = function()
{

	let count = q_results['count'];

	q_results = Object.values(q_results['res']);
	let page = parseInt(get_args['page']),
			limit = parseInt(get_args['limit']);

	document.getElementById('search-title').innerHTML = get_args['category']+' ('+count+')';

	// Alphabet sorts the array, so we call it before PageManager loads results
	var alp = new Alphabet(q_results,
				(get_args['category'] == 'artists') ? 'lname' : 'title',
				false,
				document.getElementById('alphabet'),
				'<span class=\'alphabet-letter clickable\'></span>'
				);

	var pm = new PageManager(q_results,
													count,
													parseInt(get_args['page'])-1,
													LIMIT_CHOICES,
													parseInt(get_args['limit']),
													navigate,
													false,
													get_args['view']);

get_item = pm.get_item.bind(pm);

	alp.letter_clicked = (el,st,end) => {pm.set_context(q_results.slice(st,end));};
}

function navigate(dom_elm)
{
	let id = dom_elm.value;
	let link = get_item(id).id;
	window.location.href = link;
}
