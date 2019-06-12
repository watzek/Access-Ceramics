<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>accessCeramics</title>

  <!-- Font Awesome Icons -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- CSS - Includes Bootstrap -->
  <link href="css/browse.css" rel="stylesheet">

  <!-- Icon -->
  <link href="img/a.gif" rel="shortcut icon">

  <?php
    require 'classes\\browsemain.class.php';
    $main = new main();
  ?>

</head>

<body id="page-top" class="bg-pic">

<nav class="navbar fixed-top py-3 mt-0" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger mx-auto" href="./index.html"><img src="img/accessCeramics_logo2.png"/><!-- <img src="img/accessCeramics_logo2.png"/> --></a>
    </div>
  </nav>

<!-- <header class="tile main-tile align-text-bottom">
</header> -->
	<?php $main->printTemplate(); ?>


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/creative.min.js"></script>

<script type="text/javascript">
	$("#card").flip();
</script>
</body>

</html>
