export function elaborate(image_id, responseFunction)
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function()
	{
		if(xhttp.readyState == 4 && xhttp.status == 200)
			responseFunction(xhttp.responseText);
	}
	let str = "../php/ajax_backend.php?e=1&id="+image_id;
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
	let amp = window.location.search === '' ? '?' : '&';
	let str = "../php/ajax_backend.php"+window.location.search+amp+"of="+offset+"&l="+limit;
	xhttp.open("GET", str, true);
	xhttp.send();	
}

export function ajax_take_the_wheel(array, current_amount, target, chunk_size)
{
	let current = current_amount;

	for (current; current < target; current += chunk_size) 
	{
		get_range(current, chunk_size, (resText) => {
				if(resText !== '')
				{
					let obj;
					try 
					{
						obj = Object.values(JSON.parse(resText)['res']);
						array.push.apply(array, obj);
					} catch(e) 
					{
						console.log(resText, e);
					}
				}
			});
	}
	//might instead have callback function just call this function again
	//incase queries will arrive out of order
}