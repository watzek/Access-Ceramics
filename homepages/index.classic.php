<?php
	require('../classes/navbar.class.php');

	$navbar = new navbar('classic');
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

<div id="masthead" class="container-fluid py-1"></div>

<div class="container-fluid bg-light text-center">

	<img class="logo-img mx-auto pt-3 d-block" src="../img/accessCeramics_logo.png" alt="Access Ceramics Logo"></a>
	<hr class="pb-1 mt-4 divider bg-primary">

	<div id="info" class="lead d-block text-center mx-auto">
		<div><span class="accessText">access</span><span class="ceramicsText">Ceramics</span>
		is a growing collection of contemporary ceramics images by recognized artists enhancing ceramics education worldwide.</div>
	</div>	
</div> <!-- end container-fluid -->

<div class="container-fluid bg-white text-center mt-5">
	<div class="lead text-center">
		<h3 class="h4 mb-0 ">News</h3>
		<hr class="pb-1 mt-4 divider bg-primary">
		<p id="news">
		<span><i>Apr 26 2019:</i> New images by Luciana Grazia Menegazzi.</span>
		<br/><br/>
		<span><i>Feb 26 2019:</i> New images by Hunter Stamps.</span>
		<br/><br/>
		<span><i>Feb 16 2019:</i> New images by Elaine Buss.</span>
		<br/><br/>
		</p>
	</div>


</div>
	

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
