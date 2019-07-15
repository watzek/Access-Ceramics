export function elaborate(image_id, responseFunction)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if(xhttp.readyState == 4 && xhttp.status == 200)
			responseFunction(xhttp.responseText);
	}

	xhttp.open("GET","../php/ajax_backend.php?e=1&id="+image_id, true);
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
	let amp = window.location.search === '' ? '?' : '&';
	let str = "../php/ajax_backend.php"+window.location.search+amp+"of="+offset+"&l="+limit;
	xhttp.open("GET", str, true);
	xhttp.send();	
}