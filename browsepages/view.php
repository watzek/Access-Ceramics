<?php
  require('../classes/navbar.class.php');
  require('../classes/browsemain.class.php');
  
  
  $navbar = new navbar('classic');
  $main = new Main();
  $args = $main->get_args();

  
  $results = $main->get_results();

  /* need to change below, but for now its fine */ 
  $res_count = $results ? count($results) : 0;

  $search_title = !isset($args['category']) ? 'No search specified' : ucfirst($args['category']).' ('.$res_count.')';
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

  <?php
    if($args['category'])
    {
    ?>
    <link rel="stylesheet" type="text/css" href="../css/browse_outer.css">
    <?php
    }
    else
    {
      switch($args['view'])
      {
        case 'pane':
    echo "<link rel='stylesheet' type='text/css' href='../css/pane.css'>";
          break;
        case 'grid':
    echo "<link rel='stylesheet' type='text/css' href='../css/grid.css'>";
          break;
        case 'list':
    echo "<link rel='stylesheet' type='text/css' href='../css/list.css'>";
          break;
      }
    }
  ?>
 <!--  <link rel="stylesheet" type="text/css" href="../css/full.css"> -->
<script>
    
    <?='var q_results ='. json_encode($results) .';'?>
    <?='var get_args  ='. json_encode($args).';'?>
     
</script>

<script src="../js/view.js"></script>

</head>
<body>
<?php $navbar->show()?>
<hr class="my-1" />
<div id="content" class="container-fluid">
  <div id="results">
    <div class="container-fluid span-all-cols" id="header">
      <p>
        <span id="search-title"><?=$search_title?></span>
      <br/>
      View Mode: 
      (<span class="view-mode pressable active" id="comfortable">Comfortable</span>) 
      (<span class="view-mode pressable" id="lost">List</span>) 
      (<span class="view-mode pressable" id="compact">Compact</span>)
      <br/>
      Results Per Page: 
      (<span class="limit-choice pressable">20</span>, 
      <span class="limit-choice pressable">50</span>, 
      <span class="limit-choice pressable">100</span>, 
      <span class="limit-choice pressable active">all</span>)
      <br/>
      </p> 
  </div>
  <div class="navigate span-all-cols">< Prev 1 2 3 4 5 Next ></div>
    <?php
    $ind = -1;
    if($results)
    foreach ($results as $res) {
      $ind++;
      ?>
      <!-- result skeleton -->
      <div class="result" value=<?=$ind?>>
        <img class="result-img" src=<?=$res['src']?>>
        <p class="result-title"><?=$res['title']?></p>
      </div>
      <!-- end -->
      <?php
    }
    ?>
    <div class="navigate span-all-cols">< Prev 1 2 3 4 5 Next ></div>
  </div> <!-- end results -->
  <div id="view">
    <img id="view-img" src="../img/default.jpg">
    <div id=view-meta>
      <p>Title:<span id="meta-title" class="meta-data"></span></p>
      <p>Artist:<span id="meta-artist" class="meta-data"></span></p>
      <p>Series Title:<span id="meta-stitle" class="meta-data"> </span></p>
      <p>Date:<span id="meta-date" class="meta-data"></span></p>
      <p>Technique:<span id="meta-technique" class="meta-data"></span></p>
      <p>Temperature:<span id="meta-temperature" class="meta-data"></span></p>
      <p>Glazing / Surface Treatment:<span id="meta-glazing" class="meta-data"></span></p>
      <p>Material:<span id="meta-material" class="meta-data"></span></p>
      <p>Height:<span id="meta-height" class="meta-data"></span>|
      Width:<span id="meta-width" class="meta-data"></span>| 
      Depth:<span id="meta-depth" class="meta-data"></span></p>
      <p>License:<span id="meta-liscense" class="meta-data"></span></p> 
    </div>
  </div> <!-- end view -->
</div> <!-- end content -->


  <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>

</body>

</html>