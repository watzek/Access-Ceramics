export function elaborate(image_id, responseFunction)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if(xhttp.readyState == 4 && xhttp.status == 200)
			responseFunction(xhttp.responseText);
	}
	let str = "/ajax_backend.php?elaborate=1&id="+image_id;
	//console.log(str);
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



/*
	retreives results from ajax_backend and inserts them into object_array
*/
export function ajax_insert_range(object_array, offset, limit, callback)
{
	get_range(offset, limit, resText =>
	{
		if(resText !== '')
			try
			{
				let vals = Object.values(JSON.parse(resText)['res']);
				object_insert(object_array, vals, offset);
				callback();
			}
			catch(e)
			{
				console.log(resText, e);
			}
		else
			console.log('got nothing',ind);
	});
}


export function object_insert(obj, array, start_ind)
{
	for (var i = 0; i < array.length; i++)
		obj[start_ind+i] = array[i];
}

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
