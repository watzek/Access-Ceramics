<?php
	$NUM_IMG = 105;
	require('./startbootstrap-creative/classes/mysql.class.php');
	$mydb = new mysql();
	$images = $mydb->allImages(); 
	$len = count($images);
	$imgs = [];
	$temp;
	for ($i=0; $i < $NUM_IMG; $i++)
	{ 
		$rand_i = mt_rand(0,$len-(1+$i));
		$imgs[$i] = $images[$rand_i];
		$temp = $images[$i];
		$images[$i] = $images[$rand_i];
		$images[$rand_i] = $temp;
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<script type="text/javascript">
  	<?='var imgs = '. json_encode($imgs) .';'?>//pass php images to js

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
</script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>bordertile</title>

  <!-- Font Awesome Icons -->
  <link href="startbootstrap-creative/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Icon -->
  <link href="startbootstrap-creative/img/a.gif" rel="shortcut icon">

  <link rel="stylesheet" type="text/css" href="css/bordertile.css">

</head>

<body>
	<div id="content" class="container-fluid m-0 p-0 h-100">
		<div class="bg-dark border-container bordertile"> <!-- top left corner -->
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
		</div>
		
		<div class="d-flex border-container flex-wrap justify-content-around align-items-stretch bg-dark"> <!-- top middle -->
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/Hirotake-Imanishi.shell.
					jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
		</div>

		<div class="bg-dark border-container bordertile"> <!-- top right corner -->
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
		</div>

		<div class="d-flex flex-column border-container flex-wrap justify-content-around align-items-stretch bg-dark sideborder"> <!-- mid left -->
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
		</div>

		<div id="main" class=""> <!-- middle -->
			<h1 class="text-center mt-lg-5 mt-2"><img class="logo-img" src="startbootstrap-creative/img/accessCeramics_logo.png"></h1>
			<hr class="invisible my-5" style="max-width:5rem;">
			<p id="main-text" class="lead text-light mx-auto text-center">
      			accessCeramics is a growing collection of contemporary ceramics images by recognized artists enhancing ceramics education worldwide.
			</p>
			<div class="container mx-auto text-center mt-md-5 pt-lg-5">
			<button type="button "class="btn btn-primary btn-lg mx-lg-5"><h3 class="text-dark">Browse</h3></button>
			<button type="button "class="btn btn-secondary btn-lg mx-lg-5"><h3 class="text-dark">Info</h3></button>
			</div>
		</div>
		<div class=" d-flex flex-column border-container flex-wrap justify-content-around align-items-stretch bg-dark sideborder"> <!-- mid right -->
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
		</div>

		<div class="bg-dark border-container bordertile"> <!-- bot left corner -->
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
		</div>

		<div class="d-flex border-container flex-wrap justify-content-around align-items-stretch bg-dark"> <!-- bot middle -->
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
		</div>

		<div class="bg-dark border-container bordertile"> <!-- bot right corner -->
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="startbootstrap-creative/img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
		</div>

	</div>


  <!-- Bootstrap core JavaScript -->
  <script src="startbootstrap-creative/vendor/jquery/jquery.min.js"></script>
  <script src="startbootstrap-creative/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="startbootstrap-creative/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="startbootstrap-creative/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>


</body>

</html>
