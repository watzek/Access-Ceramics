<?php
	$num_rows = 10;
	$main_squares = 16;
	$NUM_IMG = $num_rows*$num_rows*2;
	require('../classes/mysql.class.php');
	$mydb = new mysql();
	$images = $mydb->query_db('images',0,$NUM_IMG*2); 
	$len = count($images);
	$imgs = [];
	$temp;
	for ($i=0; $i < $NUM_IMG and $i < $len; $i++)
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

<script>
  	<?='var imgs = '. json_encode($imgs) .';'?>//pass php images to js
</script>

<!-- <script src="../js/bordertile.js"></script> -->


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

<body style="overflow: hidden;">
	<div id="content" class="container p-0">
		<?php
		$_i = 0;
		$lim = $num_rows*$num_rows - $main_squares;

		for ($i=0; $i < $lim; $i++)
		{ 
			?>
			<div class="bordertile flip-container">
				<div class="flipper" style="animation-play-state: paused;">
					<div class="bt-front">
						<img class="borderimg" src=<?=$imgs[$_i]['original']?>>
					</div>
					<div class="bt-back">
						<img class="borderimg" src=<?=$imgs[$_i]['original']?>>
					</div>
				</div>
			</div>
		<?php	
		$_i += 2;		
		}
		?>
			<div id="main">
				<img class="mt-2" src="../img/accessCeramics_logo2.png">
				<hr class="invisible my-5" style="max-width:5rem;">
				<p>accessCeramics is a growing collection of contemporary ceramics images by recognized artists enhancing ceramics education worldwide.</p>
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
