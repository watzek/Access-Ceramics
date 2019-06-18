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
	<link rel="stylesheet" type="text/css" href="..\css\browse.css">

<div id="content" class="container-fluid" style="overflow-x: hidden; overflow-y: hidden;">
  <div class="row h-100">
    
    <div class="col-xl-3 col-6 flip-container px-0">
      <div class="flipper w-100">
        <div class="front w-100 tile collection-tile">
          <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Collection</h2></div>
        </div>
        <div class="back tile w-100">
          <a class="btn btn-primary btn-xl" href="view.php?q=images">Browse Collection</a>
        </div>

      </div>
    </div>
    <div class="col-xl-3 col-6 flip-container px-0">
      <div class="flipper w-100">
        <div class="front w-100 tile artist-tile">
          <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Artists</h2></div>
        </div>
        <div class="back tile w-100">
          <a class="btn btn-primary btn-xl" href="view.php?q=artists">Browse By Artists</a>
        </div>

      </div>
    </div>

    <div class="col-xl-3 col-6 flip-container px-0">
      <div class="flipper w-100">
        <div class="front w-100 tile glazing-tile">
          <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Glazing/Surface</h2></div>
        </div>
        <div class="back tile w-100 text-center">
          <a class="btn btn-primary btn-xl" href="view.php?q=glazings">Browse By Glazing/Surface</a>
        </div>

      </div>
    
    </div>

    <div class="col-xl-3 col-6 flip-container px-0">
      <div class="flipper w-100">
        <div class="front w-100 tile material-tile">
          <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Materials</h2></div>
        </div>
        <div class="back tile w-100">
          <a class="btn btn-primary btn-xl" href="view.php?q=materials">Browse By Material</a>
        </div>

      </div>
    
    </div>

    <div class="col-xl-3 col-6 flip-container px-0">
      <div class="flipper w-100">
        <div class="front w-100 tile object-tile">
          <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Objects</h2></div>
        </div>
        <div class="back tile w-100">
          <a class="btn btn-primary btn-xl" href="view.php?q=objects">Browse By Object Type</a>
        </div>

      </div>
    
    </div>

    <div class="col-xl-3 col-6 flip-container px-0">
      <div class="flipper w-100">
        <div class="front w-100 tile technique-tile">
          <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Technique</h2></div>
        </div>
        <div class="back tile w-100">
          <a class="btn btn-primary btn-xl" href="view.php?q=techniques">Browse By Technique</a>
        </div>

      </div>
    
    </div>

    <div class="col-xl-3 col-6 flip-container px-0 ">
      <div class="flipper w-100">
        <div class="front w-100 tile temperature-tile">
          <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Temperature</h2></div>
        </div>
        <div class="back tile w-100">
          <a class="btn btn-primary btn-xl" href="view.php?q=temperatures">Browse By Temperature</a>
        </div>
      </div>  
    </div>

    <div class="col-xl-3 col-6 flip-container px-0 ">
      <div class="flipper w-100">
        <div class="front w-100 tile search-tile">
          <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Search</h2></div>
        </div>
        <div class="back tile w-100">
          <a class="btn btn-primary btn-xl" href="browse.php?v=search">Advanced Search</a>
        </div>
      </div>  
    </div>
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

<!-- <script type="text/javascript">
	$("#card").flip();
</script> -->
</body>

</html>
