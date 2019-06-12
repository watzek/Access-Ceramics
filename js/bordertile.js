function shuffle(array)
	{
		var temp;
		for (var i = array.length -1 ; i >= 0 ; i--) 
		{
			var j = Math.floor(Math.random() * (i+1));
			temp = array[i];
			array[i] = array[j];
			array[j] = temp;
		}
	}

	//check if image URL is still valid
	function URL_exists(URL)
	{
		return true;
		/*
			doesnt work because flickr only allows me to make no-cors
			requests which always have response code equal to 0
		*/
		/*return (fetch(URL, mode: 'no-cors').then(function(response){
			if(response.status == 404) return false;
			else return true;
		}))*/
	}

	window.onload = function()
	{
		var tiles = Array.from(document.getElementsByClassName('flipper'));
		var pics = Array.from(document.getElementsByClassName('borderimg'));
		var anim_len = 10;
		var url, img_i = 0;

		//initially pause all tile-animations
		for (var i = 0; i < tiles.length; i++) {
			tiles[i].style.webkitAnimationPlayState = "paused";
		}
		//set pictures from database for all border images

		/* UNCOMMENT to change tile pictures
		var url, img_i = 0;
		for (var i = 0; i < pics.length; i++) {
			url = imgs[i].original;
			if(URL_exists(url))
				pics[i].src = url;
			else 
				i--;
			
			img_i++;
		}*/

		//shuffle tiles so border flips are in random order
		shuffle(tiles);

		var i = 0, l = tiles.length;

		var timer = setInterval(function()
		{
			tiles[i].style.webkitAnimationPlayState = "running";

			
			var _i = i; //local i for the following closure
			setTimeout(function()
			{
				tiles[_i].style.webkitAnimationPlayState = "paused";
			},anim_len*1000);//after the animation ends, re-pause the animation

			i++;
			if(i == l) i = 0;

		},5000);//every 5 seconds, flip a tile
	}