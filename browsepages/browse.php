<?php
  require('../classes/navbar.class.php');
  require('../classes/browsemain.class.php');

  $artist_fn = isset($_GET['af']) ? $_GET['af'] : NULL;
  $artist_ln = isset($_GET['al']) ? $_GET['al'] : NULL;
  $glazing = isset($_GET['g']) ? $_GET['g'] : NULL;
  $material = isset($_GET['m']) ? $_GET['m'] : NULL;
  $object = isset($_GET['o']) ? $_GET['o'] : NULL;
  $technique = isset($_GET['t']) ? $_GET['t'] : NULL;
  $temperature = isset($_GET['tem']) ? $_GET['tem'] : NULL;
  $view = isset($_GET['v']) ? $_GET['v'] : NULL;


  $navbar = new navbar('classic');
  $main = new main($view);
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>accessCeramics</title>

  <!-- Font Awesome Icons -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="../vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Icon -->
  <link href="../img/a.gif" rel="shortcut icon">
</head>

<body id="page-top" class="bg-pic">

<?php $navbar->show()?>

<!-- <header class="tile main-tile align-text-bottom">
</header> -->
	<?php $main->printTemplate(); ?>


  <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="../js/creative.min.js"></script>

<script type="text/javascript">
	$("#card").flip();
</script>
</body>

</html>
