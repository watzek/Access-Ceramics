<?php
  require('../classes/navbar.class.php');
  require('../classes/browsemain.class.php');

  $args = [
    'query' => isset($_GET['q']) ? $_GET['q'] : NULL,
    'artist_fn' => isset($_GET['af']) ? $_GET['af'] : NULL,
    'artist_ln' => isset($_GET['al']) ? $_GET['al'] : NULL,
    'glazing' => isset($_GET['g']) ? $_GET['g'] : NULL,
    'material' => isset($_GET['m']) ? $_GET['m'] : NULL,
    'object' => isset($_GET['o']) ? $_GET['o'] : NULL,
    'technique' => isset($_GET['t']) ? $_GET['t'] : NULL,
    'temperature' => isset($_GET['tem']) ? $_GET['tem'] : NULL,
    'view' => isset($_GET['v']) ? $_GET['v'] : NULL,  
  ];


  $navbar = new navbar('classic');
  $main = new main($args);
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

  <link rel="stylesheet" type="text/css" href="../css/pane.css">
</head>


<div id="content" class="container-fluid">
	<div class="row h-100">
		<div class="col-lg-6 col-12 bg-primary paneview"> <!-- begin results div -->
			<div class="row">
				<button class="paneobj p-2">
					<img src="../img/acpics/Hirotake-Imanishi.shell.jpg" class="panepic">
					<p class="mdata">shell <br>
					Hirotake Imanishi</p>
				</button>
				<button class="paneobj p-2">
					<img src="../img/acpics/Hirotake-Imanishi.shell.jpg" class="panepic">
					<p class="mdata">shell <br>
					Hirotake Imanishi</p>
				</button>
			<button class="paneobj p-2">
					<img src="../img/acpics/Hirotake-Imanishi.shell.jpg" class="panepic">
					<p class="mdata">shell <br>
					Hirotake Imanishi</p>
				</button>
			<button class="paneobj p-2">
					<img src="../img/acpics/Hirotake-Imanishi.shell.jpg" class="panepic">
					<p class="mdata">shell <br>
					Hirotake Imanishi</p>
				</button>
			</div>

		</div> <!-- end results div -->
		<div class="col-lg-6 col-12 bg-secondary paneview">
				<img id="panedisplay" src="">
				<p class="author"></p>
				<p class="name"></p>
		</div>
	</div>
</div>

  <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>

</body>

</html>