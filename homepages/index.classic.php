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
	<title>Access Ceramics</title>

	<link rel="stylesheet" type="text/css" href="../css/classic.css">
</head>

<body class="bg-white">
<?php $navbar->show() ?> <!--read corresponding navbar file -->

<div id="masthead" class="container-fluid py-1"></div>

<div class="container-fluid bg-white text-center">
	<div class="row">
		<div id="info" class="my-md-0 py-pd-0 pb-5 mb-5 mx-auto col-sm-4 order-sm-2 lead text-center mx-auto">
			<h3 class="h4 mb-0 mt-4">Access Ceramics</h3>
			<hr class="pb-1 mt-4 divider bg-primary">
				<span class="accessText">access</span><span class="ceramicsText">Ceramics</span>
				is a growing collection of contemporary ceramics images by recognized artists enhancing ceramics education worldwide.
		</div> <!-- end info section -->

		<div class="col-12 col-sm-4 order-sm-1">
			<h3 class="h4 mb-0 mt-4">Something</h3>
			<hr class="pb-1 mt-4 divider bg-primary">
		</div> <!-- end 'extra' section -->
		
		<div class="col-12 col-sm-4 order-sm-3 lead text-center" id="news-container">
			<h3 class="h4 mb-0 mt-4">News</h3>
			<hr class="pb-1 mt-4 divider bg-primary">
			<p id="news">
				<span><i>Apr 26 2019:</i> New images by Luciana Grazia Menegazzi.</span>
				<br/><br/>
				<span><i>Feb 26 2019:</i> New images by Hunter Stamps.</span>
				<br/><br/>
				<span><i>Feb 16 2019:</i> New images by Elaine Buss.</span>
				<br/><br/>
			</p>
		</div>	<!-- end news section -->
	</div>	
</div> <!-- end container-fluid -->

<div class="container-fluid bg-white text-center mt-5">
	


</div>
	

	<script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>
</body>
</html>
