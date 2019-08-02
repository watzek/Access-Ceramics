<?php
  require('classes/snippits.class.php');
  require('classes/main.class.php');

  $style = -1;
  if (isset($_GET['s']) && $_GET['s'] == 'category') $style = 1; //fix this
  else if (isset($_GET['s']) && ($_GET['s'] == 'view' || $_GET['s'] == 'artist')) $style = 0; //fix this
  $main = new Main($style);

  //move these 2 to a snippits function taking a desc_string
  $navbar = new Snippits('classic-navbar');
  $header = new Snippits('header-search');

  $args = $main->get_args();
  $results = $main->get_results();

  if ($args['state'] != 'main')
  {
    $style = $main->style_pack;
    $res_count = $results['count'];
    if ($args['state'] == 'artist')
    {
      $artist_info = $main->artist_info();
      $artist_name = $artist_info['res']['artist_fname'].' '.$artist_info['res']['artist_lname'];
    }
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Access Ceramics">
  <meta name="author" content="">

  <title id='page-title'>accessCeramics</title>

  <!-- Font Awesome Icons -->
  <link href="\vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
  <!-- Icon -->
  <link href="\img/a.gif" rel="shortcut icon">

  <!--<head> Changes according to State-->
  <?php
  if ($args['state'] == 'main')
  { ?>
    <link rel="stylesheet" type="text/css" href="\css\browse.css">
  <?php
  }
  else
  { ?>
    <script>
        <?='var q_results ='. json_encode($results) .';'?>
        <?='var get_args  ='. json_encode($args).';'?>
        <?='var _get  ='. json_encode($_GET).';'?>
        <?php if(isset($style))echo ('var style_pack  ='. json_encode($style).';');?>
        console.log(get_args);
    </script>
    <script type="module" src="/js/PageManagement.js"></script>
    <script type="module" src="/js/ajax.js?version=1"></script>

    <link rel="stylesheet" type="text/css" href="\css\view.css">
    <link id='pagestyle' rel='stylesheet' type='text/css' href=<?=$main->active_style?>>
    <?php

    if($args['state'] == 'category')
    { ?>
      <script type="module" src="/js/alphabet.js"></script>
      <script type="module" src="/js/categories.js"></script>
      <!-- <link rel="stylesheet" type="text/css" href="\css\category.css"> -->
    <?php }
    else
    { ?>
      <script type="module" src="/js/view.js"></script>
      <link rel="stylesheet" type="text/css" href="\css\view.css">
    <?php }
}  ?>

</head>
<body>
<?php  $navbar->show()?>

<?php
if($args['state'] == 'main')
{ /*<--- Main Browse State --->*/
  ?>
<div id="content" class="container-fluid" style="overflow-x: hidden;">
  <div class="row h-100">

    <div class="col-xl-3 col-6 px-0">
      <a class="w-100 tile" href="/collection/?">
          <img src=<?="{$results['collection']['src']}"?>/>
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?=$results['collection']['ct']?> Images</h2></div>
          </a>
    </div>
    <div class="col-xl-3 col-6 px-0">
      <a class='w-100 tile' href="/artists/">
          <img src=<?="{$results['artists']['src']}"?>/>
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?=$results['artists']['ct']?> Artists</h2></div>
          </a>
    </div>

    <div class="col-xl-3 col-6 px-0">
      <a class='w-100 tile' href="/glazings/">
          <img src=<?="{$results['glazing']['src']}"?>/>
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?=$results['glazing']['ct']?> Glazing/Surfaces</h2></div>
          </a>
    </div>

    <div class="col-xl-3 col-6 px-0">
      <a class='w-100 tile' href="/materials/">
          <img src=<?="{$results['material']['src']}"?>/>
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?=$results['material']['ct']?> Materials</h2></div>
          </a>
    </div>

    <div class="col-xl-3 col-6 px-0">
      <a class='w-100 tile' href="/objects/">
          <img src=<?="{$results['object']['src']}"?>/>
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?=$results['object']['ct']?> Object Types</h2></div>
      </a>
    </div>

    <div class="col-xl-3 col-6 px-0">
      <a class='w-100 tile' href="/techniques/">
          <img src=<?="{$results['technique']['src']}"?>/>
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?=$results['technique']['ct']?> Techniques</h2></div>
      </a>
    </div>

    <div class="col-xl-3 col-6 px-0 ">
      <a class='w-100 tile' href="/temperatures/">
          <img src=<?="{$results['temperature']['src']}"?>/>
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Browse <?=$results['temperature']['ct']?> Temperatures</h2></div>
          </a>
    </div>

    <div class="col-xl-3 col-6 px-0 ">
      <a class='w-100 tile' href="/search/">
        <img class="search-tile tile"/>
            <div class="titlediv"><h2 class="text-light text-center align-text-bottom">Advanced Search</h2></div>
          </a>
    </div>
  </div> <!-- end row -->
</div>
<?php
} // <-- End Main Browse State -->
else
{ // <-- Begin 'Category' State-->
  ?>
  <div id="content" class="container-fluid">
    <div id="result-body">
      <div class="container-fluid" id="header">
        <?php
          if ($args['state'] == 'artist')
          { ?>
            <div id='header-statement'>
              <h1 class="h3 text-center"><span id="meta-artist" class="meta-data"></span></h1>
              <hr class="divider pt-1">
              <p id='artist-statement' class="text-center">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>

            </div>
          <?php }
        ?>
        <?php  $header->show()?>
      </div>
      <div class="navigate"></div>
      <div id="results"></div>
      <div class="navigate"></div>

    </div> <!-- end results-body -->
      <div id="view">
        <img id="view-img" src="/img/default.jpg">
        <div id=view-meta>
          <p>
            <?php if($args['state'] != 'artist'){ ?><span id="meta-artist" class="meta-data"></span> ,<?php } ?>
            <span id="meta-title" class="meta-data"></span>
            <span id="meta-stitle" class="meta-data"></span> ,
            <span id="meta-date" class="meta-data"></span>
          </p>
          <hr class="divider pt-1">
          <div id="meta-other">
          <div>Technique: <span id="meta-technique" class="meta-data"></span></div>
          <div>Temperature: <span id="meta-temperature" class="meta-data"></span></div>
          <div>Surface Treatment: <span id="meta-glazing" class="meta-data"></span></div>
          <div>Material: <span id="meta-material" class="meta-data"></span></div>
          <div>Object Type: <span id="meta-object" class="meta-data"></span></div>
          <div>Height: <span id="meta-height" class="meta-data"></span>|
          Width: <span id="meta-width" class="meta-data"></span>|
          Depth: <span id="meta-depth" class="meta-data"></span></div>
          <div>License: <span id="meta-license" class="meta-data"></span></div>
          </div>
        </div>
      </div> <!-- end view -->
  </div> <!-- end content -->
 <?php }  // <-- End 'Category' State-->
 ?>

<!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<!-- End Scripts -->
</body>
</html>
