<?php
  require('../classes/navbar.class.php');
  require('../classes/browsemain.class.php');

  $args = [
    'q' => isset($_GET['q']) ? $_GET['q'] : NULL,
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
  $results = $main->get_results();
  
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

  <!-- pane view css --> 
  <link rel="stylesheet" type="text/css" href="../css/pane.css">
  <!-- grid view css --> 
  <!-- <link rel="stylesheet" type="text/css" href="../css/grid.css"> -->
  <!-- list view css --> 
  <!-- <link rel="stylesheet" type="text/css" href="../css/list.css"> -->
  <!-- full view css --> 
 <!--  <link rel="stylesheet" type="text/css" href="../css/full.css"> -->
<script>
    <?='var q_results ='. json_encode($results) .';'?> 
</script>

<script src="../js/view.js">

</script>
</head>

<?php $navbar->show()?>

<div id="content" class="container-fluid">
  <div id="results">
    <?php
    $ind = -1;
    if($results)
    foreach ($results as $res) {
      $ind++;
      ?>
      <div class="result" value=<?=$ind?>><!-- result skeleton -->
        <img class="result-img" src=<?=$res['original']?>>
        <p class="result-title"><?=$res['title']?></p>
      </div><!-- end -->
      <?php
    }
    ?>
  </div> <!-- end results -->
  <div id="view">
    <img id="view-img" src="../img/default.jpg">
    <div id=view-meta>
      Title:<p class="meta-deta"></p>
      Series Title:<p class="meta-deta"> </p>
      Artist:<p class="meta-deta"></p>
      Date:<p class="meta-deta"></p>
      Technique:<p class="meta-deta"></p>
      Temperature:<p class="meta-deta"></p>
      Glazing / Surface Treatment:<p class="meta-deta"></p>
      Material:<p class="meta-deta"></p>
      Height:<p class="meta-deta"></p>|
      Width:<p class="meta-deta"></p>| 
      Depth:<p class="meta-deta"></p>
      License:<p class="meta-data"></p> 
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