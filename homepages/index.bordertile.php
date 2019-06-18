<?php
	$NUM_IMG = 105;
	require('../classes/mysql.class.php');
	$mydb = new mysql();
	$images = $mydb->query_db('images'); 
	$len = count($images);
	$imgs = [];
	$temp;
	for ($i=0; $i < $NUM_IMG; $i++)
	{ 
		$rand_i = mt_rand(0,$len-(1+$i));
		if($images[$rand_i]['active'] == 'yes')
		{
			$imgs[$i] = $images[$rand_i];
			$temp = $images[$i];
			$images[$i] = $images[$rand_i];
			$images[$rand_i] = $temp;
		}else $i--;
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<script>
  	<?='var imgs = '. json_encode($imgs) .';'?>//pass php images to js
</script>

<script src="../js/bordertile.js"></script>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>bordertile</title>

  <!-- Font Awesome Icons -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Icon -->
  <link href="../img/a.gif" rel="shortcut icon">

  <link rel="stylesheet" type="text/css" href="../css/bordertile.css">

</head>

<body>
	<div id="content" class="container-fluid m-0 p-0 h-100">
		<div class="bg-dark border-container bordertile"> <!-- top left corner -->
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
		</div>
		
		<div class="d-flex border-container flex-wrap justify-content-around align-items-stretch bg-dark"> <!-- top middle -->
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/Hirotake-Imanishi.shell.
					jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
		</div>

		<div class="bg-dark border-container bordertile"> <!-- top right corner -->
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
		</div>

		<div class="d-flex flex-column border-container flex-wrap justify-content-around align-items-stretch bg-dark sideborder"> <!-- mid left -->
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
		</div>

		<div id="main" class=""> <!-- middle -->
			<h1 class="text-center mt-lg-5 mt-2"><img class="logo-img" src="../img/accessCeramics_logo.png"></h1>
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
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
		</div>

		<div class="bg-dark border-container bordertile"> <!-- bot left corner -->
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
		</div>

		<div class="d-flex border-container flex-wrap justify-content-around align-items-stretch bg-dark"> <!-- bot middle -->
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
		</div>

		<div class="bg-dark border-container bordertile"> <!-- bot right corner -->
			<div class="bordertile flip-container">
				<div class="flipper">
					<div class="bt-front">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
					<div class="bt-back">
						<img class="borderimg" src="../img/acpics/23578883568.jpg">
					</div>
				</div>
			</div>
		</div>

	</div>


  <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>


</body>

</html>
