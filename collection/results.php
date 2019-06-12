<?php
	require('../classes/navbar.class.php');
	require('../classes/browsemain.class.php');

	$args = [
		'artist_fn' => isset($_GET['af']) ? $_GET['af'] : NULL,
		'artist_ln' => isset($_GET['al']) ? $_GET['al'] : NULL,
		'glazing' => isset($_GET['g']) ? $_GET['g'] : NULL,
		'material' => isset($_GET['m']) ? $_GET['m'] : NULL,
		'object' => isset($_GET['o']) ? $_GET['o'] : NULL,
		'technique' => isset($_GET['t']) ? $_GET['t'] : NULL,
		'temperature' => isset($_GET['tem']) ? $_GET['tem'] : NULL,
		'view' => isset($_GET['v']) ? $_GET['v'] : NULL,	
	];

	$navbar = new Navbar('classic');
	$main = new Main($args);
?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="shortcut icon" href="../img/a.gif">
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<title>Access Ceramics</title>

		<link rel="stylesheet" type="text/css" href="../css/classic.css">
	</head>
	<body>
		<?php $navbar->getHTML() ?> <!--read corresponding navbar file -->
		





		<!-- Bootstrap core JavaScript -->
		<script src="../vendor/jquery/jquery.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!-- Plugin JavaScript -->
		<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
		<script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>


		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>
