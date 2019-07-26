<?php
	require('classes/snippits.class.php');
	$navbar = new Snippits('classic-navbar');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Access Ceramics Info</title>
	<link rel="stylesheet" type="text/css" href="css/info.css">
</head>
<body>
	<?php $navbar->show();?>
	<div id="content">
		<h1 class="h3">Info</h1>
		<hr class="divider pt-1 ml-0">
	</div>

</body>

<!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>
</html>