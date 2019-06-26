<?php
  require('../classes/navbar.class.php');
  require('../classes/mysql.class.php')
  $navbar = new navbar('classic');

  $db = new mysql();
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

  <link rel="stylesheet" type="text/css" href="..\css\browse.css">
</head>

<body id="page-top" class="bg-pic">

<?php $navbar->show()?>

<div id="content" class="container" style="overflow-x: hidden;">
  <div class="row h-100">
    
    <div class="col-xl-3 col-6 flip-container px-0">
      <a href="view.php?q=images">
      <div class="flipper w-100">
        <div class="front w-100 tile collection-tile">
          
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?='\'amount\''?> Collection</h2></div>
        </div>
        <div class="back tile w-100">
          <!-- <a class="selection-btn btn btn-primary btn-xl" href="view.php?q=images"></a> -->
        </div>

      </div>
          </a>
    </div>
    <div class="col-xl-3 col-6 flip-container px-0">
      <a href="view.php?q=artists">
      <div class="flipper w-100">
        <div class="front w-100 tile artist-tile">
          
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?='\'amount\''?> Artists</h2></div>
        </div>
        <div class="back tile w-100">
          <!-- <a class="selection-btn btn btn-primary btn-xl" href="view.php?q=artists"></a> -->
        </div>

      </div>
          </a>
    </div>

    <div class="col-xl-3 col-6 flip-container px-0">
      <a href="view.php?q=glazings">
      <div class="flipper w-100">
        <div class="front w-100 tile glazing-tile">
          
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?='\'amount\''?> Glazing/Surface</h2></div>
        </div>
        <div class="back tile w-100">
          <!-- <a class="selection-btn btn btn-primary btn-xl" href="view.php?q=glazings"></a> -->
        </div>

      </div>
          </a>
    
    </div>

    <div class="col-xl-3 col-6 flip-container px-0">
      <a href="view.php?q=materials">
      <div class="flipper w-100">
        <div class="front w-100 tile material-tile">
          
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?='\'amount\''?> Material</h2></div>
        </div>
        <div class="back tile w-100">
          <!-- <a class="selection-btn btn btn-primary btn-xl" href="view.php?q=materials"></a> -->
        </div>

      </div>
          </a>
    
    </div>

    <div class="col-xl-3 col-6 flip-container px-0">
      <a href="view.php?q=objects">
      <div class="flipper w-100">
        <div class="front w-100 tile object-tile">
          
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?='\'amount\''?> Object Type</h2></div>
        </div>
        <div class="back tile w-100">
          <!-- <a class="selection-btn btn btn-primary btn-xl" href="view.php?q=objects"></a> -->
        </div>

      </div>
          </a>
    
    </div>

    <div class="col-xl-3 col-6 flip-container px-0">
      <a href="view.php?q=techniques">
      <div class="flipper w-100">
        <div class="front w-100 tile technique-tile">
          
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?='\'amount\''?> Technique</h2></div>
        </div>
        <div class="back tile w-100">
          <!-- <a class="selection-btn btn btn-primary btn-xl" href="view.php?q=techniques"></a> -->
        </div>

      </div>
          </a>
    
    </div>

    <div class="col-xl-3 col-6 flip-container px-0 ">
      <a href="view.php?q=temperatures">
      <div class="flipper w-100">
        <div class="front w-100 tile temperature-tile">
          
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?='\'amount\''?> Temperature</h2></div>
        </div>
        <div class="back tile w-100">
          <!-- <a class="selection-btn btn btn-primary btn-xl" href="view.php?q=temperatures"></a> -->
        </div>
      </div>  
    </div>
          </a>

    <div class="col-xl-3 col-6 flip-container px-0 ">
      <a href="view.php?v=search">
      <div class="flipper w-100">
        <div class="front w-100 tile search-tile">
          
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Advanced Search</h2></div>
        </div>
        <div class="back tile w-100">
          <!-- <a class="selection-btn btn btn-primary btn-xl" href="browse.php?v=search"></a> -->
        </div>
      </div>  
    </div>
          </a>
  </div> <!-- end row -->
</div>


  <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="../js/creative.min.js"></script>
</body>

</html>
