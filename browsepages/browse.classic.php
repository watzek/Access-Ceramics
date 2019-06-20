<?php
  require('../classes/navbar.class.php');
  $navbar = new navbar('classic');
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Browse Classic</title>

  <!-- Font Awesome Icons -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="../vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Icon -->
  <link href="../img/a.gif" rel="shortcut icon">
  <link rel="stylesheet" type="text/css" href="..\css\classic.css">
</head>

<body id="page-top" class="bg-browse">
  <div id="bg-picture"></div>

<?php $navbar->show()?>

<!-- <header class="tile main-tile align-text-bottom">
</header> -->
	

<div id="content" class="container-fluid d-grid h-100" style="overflow-x: hidden; overflow-y: hidden;">
  <div class="row h-100">

    <div class="col-6 w-100 d-flex flex-column justify-content-start mx-0 px-0"> <!-- begin left side -->
      <a class="d-flex align-items-center justify-content-start selection-card left d-block" href="">
        <img class="img-selection" src="../img/acpics/23578883568.jpg">
        <div>Browse by Artist</div>
      </a>
      <a class="d-flex align-items-center justify-content-start selection-card left d-block" href="">
        <img class="img-selection" src="../img/acpics/23578883568.jpg">
        <div>Browse by Temperature</div>
      </a>
    </div> <!-- end left side -->


    <div class="col-6 w-100 d-flex flex-column justify-content-start align-items-end mx-0 px-0"> <!-- begin right side -->
      <a class="d-flex align-items-center justify-content-end selection-card right d-block " href="">
        <div>Browse by Object Type</div>
        <img class="img-selection" src="../img/acpics/23578883568.jpg">
        
      </a>
      <a class="d-flex align-items-center justify-content-end selection-card right d-block" href="">
        <div>Browse by Material</div>
        <img class="img-selection" src="../img/acpics/23578883568.jpg">
        
      </a>
    </div> <!-- end right side -->

    <div class="col-12 d-flex justify-content-around mx-auto">
      <div><button class="btn btn-lg btn-primary" href="view.php">Browse Collection</button></div>
      <div><button class="btn btn-lg btn-secondary" href="view.php">Advanced Search</button></div>
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
