<?php
  require('../classes/navbar.class.php');
  require('../classes/mysql.class.php');

  $navbar = new navbar('classic');

  $db = new mysql();
  $categories = $db->categories();
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
<hr style="margin: 0;" />

<div id="content" class="container" style="overflow-x: hidden;">
  <div class="row h-100">
    
    <div class="col-xl-3 col-6 flip-container px-0">
      <a href="view.php?">
      <div class="flipper w-100">
        <div class="front w-100 tile">
          <img src=<?="{$categories['collection']['src']}"?>/>
            <!-- <p><?="background: url('{$categories['collection']['src']}')"?></p> -->
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?=$categories['collection']['ct']?> Images</h2></div>
        </div>
        <div class="back tile w-100">
          <!-- <a class="selection-btn btn btn-primary btn-xl" href="category.php?c=images"></a> -->
        </div>

      </div>
          </a>
    </div>
    <div class="col-xl-3 col-6 flip-container px-0">
      <a href="category.php?c=artists">
      <div class="flipper w-100">
        <div class="front w-100 tile">
          <img src=<?="{$categories['artists']['src']}"?>/>
            <!-- <p><?="background: url('{$categories['artists']['src']}')"?></p> -->
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?=$categories['artists']['ct']?> Artists</h2></div>
        </div>
        <div class="back tile w-100">
          <!-- <a class="selection-btn btn btn-primary btn-xl" href="category.php?c=artists"></a> -->
        </div>

      </div>
          </a>
    </div>

    <div class="col-xl-3 col-6 flip-container px-0">
      <a href="category.php?c=glazings">
      <div class="flipper w-100">
        <div class="front w-100 tile">
          <img src=<?="{$categories['glazing']['src']}"?>/>
            <!-- <p><?="background: url('{$categories['glazing']['src']}')"?></p> -->
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?=$categories['glazing']['ct']?> Glazing/Surfaces</h2></div>
        </div>
        <div class="back tile w-100">
          <!-- <a class="selection-btn btn btn-primary btn-xl" href="category.php?c=glazings"></a> -->
        </div>

      </div>
          </a>
    
    </div>

    <div class="col-xl-3 col-6 flip-container px-0">
      <a href="category.php?c=materials">
      <div class="flipper w-100">
        <div class="front w-100 tile">
          <img src=<?="{$categories['material']['src']}"?>/>
            <!-- <p><?="background: url('{$categories['material']['src']}')"?></p> -->
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?=$categories['material']['ct']?> Materials</h2></div>
        </div>
        <div class="back tile w-100">
          <!-- <a class="selection-btn btn btn-primary btn-xl" href="category.php?c=materials"></a> -->
        </div>

      </div>
          </a>
    
    </div>

    <div class="col-xl-3 col-6 flip-container px-0">
      <a href="category.php?c=objects">
      <div class="flipper w-100">
        <div class="front w-100 tile">
          <img src=<?="{$categories['object']['src']}"?>/>
            <!-- <p><?="background: url('{$categories['object']['src']}')"?></p> -->
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?=$categories['object']['ct']?> Object Types</h2></div>
        </div>
        <div class="back tile w-100">
          <!-- <a class="selection-btn btn btn-primary btn-xl" href="category.php?c=objects"></a> -->
        </div>

      </div>
          </a>
    
    </div>

    <div class="col-xl-3 col-6 flip-container px-0">
      <a href="category.php?c=techniques">
      <div class="flipper w-100">
        <div class="front w-100 tile">
          <img src=<?="{$categories['technique']['src']}"?>/>
            <!-- <p><?="background: url('{$categories['technique']['src']}')"?></p> -->
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?=$categories['technique']['ct']?> Techniques</h2></div>
        </div>
        <div class="back tile w-100">
          <!-- <a class="selection-btn btn btn-primary btn-xl" href="category.php?c=techniques"></a> -->
        </div>

      </div>
          </a>
    
    </div>

    <div class="col-xl-3 col-6 flip-container px-0 ">
      <a href="category.php?c=temperatures">
      <div class="flipper w-100">
        <div class="front w-100 tile">
          <img src=<?="{$categories['temperature']['src']}"?>/>
            <!-- <p><?="background: url('{$categories['temperature']['src']}')"?></p> -->
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?=$categories['temperature']['ct']?> Temperatures</h2></div>
        </div>
        <div class="back tile w-100">
          <!-- <a class="selection-btn btn btn-primary btn-xl" href="category.php?c=temperatures"></a> -->
        </div>
      </div>  
    </div>
          </a>

    <div class="col-xl-3 col-6 flip-container px-0 ">
      <a href="category.php?v=search">
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
