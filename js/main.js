import {elaborate, get_range} from "./ajax.js";
		var details = [];
		function printResponse(json) 
		{
			let res = JSON.parse(json)[0];/*
			let final = '';
			for (var i = 0; i < arr.length; i++) {
				
				let keys = Object.keys(arr[i]);
				for (var k = 0; k < keys.length; k++) {
					final += keys[k] + ' => ';
					final += arr[i][keys[k]] + '<br>';

				}
			}*/
			


		}
		var artist_img = document.getElementById('artist_img');
		var artist_name = document.getElementById('artist_name');
		var artist_id = document.getElementById('artist_id');
		var artist_args = document.getElementById('artist_args');
		var dumprest = document.getElementById('metadump');

		window.onload = function()
		{
			document.getElementById('elab').addEventListener('click', 
				() => {
					var val = document.getElementById('artistnum');
					elaborate(val, function(resText)
					{
						console.log(resText);
						var obj = JSON.parse(resText)[0];
						if (obj !== undefined && obj.length != 0)
						{
							artist_img.innerHTML = obj['src'];
							artist_name.innerHTML = obj['title'];
							artist_id.innerHTML = obj['id'];
							artist_args.innerHTML = obj['args'];
							dumprest.innerHTML = obj;
						}
						else
						{
							dumprest.innerHTML = 'no image found';	
						}


					});

				}				
				);
			document.getElementById('range').addEventListener('click', 
				() => {
					var val0 = parseInt(document.getElementById('offset').value);
					var val1 = parseInt(document.getElementById('limit').value);
					get_range(val0, val1, function(resText)
						{
							document.getElementById("dump").innerHTML = resText;
						});

				}
				);
		}

		/*document.addEventListener("DOMContentLoaded", () => {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function ()
			{
				if(this.readyState == 4 && this.status == 200)
					var text = printResponse(xhttp.responseText);
			}
			xhttp.open("GET","./php/ajax_backend.php?c=artists&of=51&l=1", true);
			xhttp.send();
			
		});*/