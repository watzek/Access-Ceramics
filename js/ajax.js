export function elaborate(image_id, responseFunction)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if(xhttp.readyState == 4 && xhttp.status == 200)
			responseFunction(xhttp.responseText);
	}
	let str = "/ajax_backend.php?elaborate=1&id="+image_id;
	console.log(str);
	xhttp.open("GET",str, true);
	xhttp.send();
}

export function get_range(offset, limit, resFunc)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = ()=>
	{
		if(xhttp.readyState == 4 && xhttp.status == 200)
			resFunc(xhttp.responseText);
	}
	let str = "/ajax_backend.php"+query_string()+"offset="+offset+"&limit="+limit;
	console.log(str);
	xhttp.open("GET", str, true);
	xhttp.send();
}


export function ajax_take_the_wheel(array, offset, current_amount, target, chunk_size)
{
	var current = 0, flag = 0;
	if (offset === 0)
	{
		current = current_amount;
		flag = 1;
	}

	for (current; current < target; current += chunk_size)
	{
		var amount = chunk_size;
		//if next chunk starts in the middle of existing elements
		if (!flag && current >= offset && current < offset+current_amount)
		{
				current = offset+current_amount;
				flag = 1;
		}
		else
		{
			//if next chunk would skip over existing elements
			if (!flag && current+chunk_size > offset)
				amount -= (offset-current);

			get_range(current, amount, (resText) => {
				if(resText !== '')
				{
					try
					{
						let obj = Object.values(JSON.parse(resText)['res']);
						for (var i = 0; i < chunk_size && i < obj.length; i++)
							array[current+i] = obj[i];
					}
					catch(e) console.log(resText, e);
				}
				});
		}
	} //end for

}// end 'ajax_take_the_wheel'

function query_string()
{
	let str = '?';
	let keys = Object.keys(_get);
	for (var i = 0; i < keys.length; i++)
	{
		let key = keys[i];
		let val = _get[key];

		if (val != '') str += key + '=' + val + '&';
	}
	return str;
}
