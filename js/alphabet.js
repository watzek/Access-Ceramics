/*  
	takes an array of items and a parent html object
	alphabetically sorts array (unless sorted=true)
	
*/

export default function(array, attr, sorted=false, parent, child_template, press_func) 
{
	if (sorted === false)
		array.sort(function(a,b){
			return (a[attr] < b[attr]) ? -1 : a[attr] == b[attr] ? 0 : 1;
		});

	let last = 0;
	let letters = [];
	let f = false;
	let ch;
	for (var i = 0; i < array.length; i++) 
	{
		ch = array[i][attr][0].toUpperCase();
		if (ch !== last)
		{
			last = ch;
			letters[last] = i;
		}
	}

	let keys = Object.keys(letters);
	for (var i = 0; i < keys.length; i++) 
	{
		let temp = document.createElement('template');
		temp.innerHTML = child_template;
		let elm = temp.content.children[0];
		elm.innerHTML = keys[i];
		elm.value = keys[i];
		elm.addEventListener('click',press_func);
		parent.appendChild(elm);
	}
}