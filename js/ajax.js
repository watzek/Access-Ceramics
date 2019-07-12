export function elaborate(image_id, responseFunction)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if(xhttp.readyState == 4 && xhttp.status == 200)
			responseFunction(xhttp.responseText);
	}

	xhttp.open("GET","./php/ajax_backend.php?e=1&id="+image_id, true);
	xhttp.send();
}

export function get_range(offset, limit, resFunc)
{
	console.log(offset, limit);
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = ()=>
	{
		if(xhttp.readyState == 4 && xhttp.status == 200)
			resFunc(xhttp.responseText);
	}
	var str = "./php/ajax_backend.php"+window.location.search+"&of="+offset+"&l="+limit;
	console.log(str);
	xhttp.open("GET", str, true);
	xhttp.send();	
}