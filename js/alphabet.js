/*
	Handles the creation and events associated with the alphabet sort feature.
	given an array, an attribute present on each element in array, parent element,
	and a template for creation of new children the class will:

	sort the array if sorted=false, determine which characters need to be included
	in the alphabet bar, and create an element for each. These elements are
	clickable and call select_letter and fire the letter_clicked event
*/
export default class{

	constructor(array, attr, sorted=false, parent, child_template)
	{
		this.letter_clicked = function(el,p_start, p_end){};
		this.letters = [];
		this.children = [];
		if (sorted === false)
			array.sort(function(a,b){
				return (a[attr] < b[attr]) ? -1 : a[attr] == b[attr] ? 0 : 1;
			});

		{ //fill this.letters
			let last = 0;
			let f = false;
			let ch;
			for (var i = 0; i < array.length; i++)
			{
				ch = array[i][attr][0].toUpperCase();
				if (ch !== last)
				{
					last = ch;
					this.letters.push({ch:last,ind:i});
				}
			}
			this.letters.push({ch:null,ind:array.length});
		}

		{// initialize this.children and coresponding dom elms
			for (var i = 0; i < this.letters.length-1; i++)
			{
				let temp = document.createElement('template');
				temp.innerHTML = child_template;
				let elm = temp.content.children[0];
				elm.innerHTML = this.letters[i].ch;
				elm.value = i;
				let self = this;
				elm.addEventListener('click',function() {self.select_letter(this)});
				parent.appendChild(elm);
				this.children.push(elm);
			}
		}
	}

	// called each time a child element is clicked
	select_letter(el)
	{
		if (el.classList.contains('active'))
		{
			el.classList.remove('active');

			var p_start = 0;
			var p_end = this.letters[this.letters.length-1].ind;
		}
		else
		{
			for (var i = 0; i < this.children.length; i++)
				this.children[i].classList.remove('active');

			el.classList.add('active');

			let val = el.value;
			if (val < 0 || val >= this.letters.length-1)
			{
				console.log('no partition found with key: ', val);
				return;
			}
			var p_start = this.letters[val];
			var p_end = this.letters[val+1];
		}
		this.letter_clicked(el, p_start.ind, p_end.ind);
	}



}
