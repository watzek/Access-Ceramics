<?php
  require('classes/snippits.class.php');
  require('classes/browsemain.class.php');

  $style = 1;

  $navbar = new Snippits('classic-navbar');
  $header = new Snippits('header-search');
  $main = new Main($style);
  $args = $main->get_args();

  $style = $main->style_pack;

  $results = $main->get_results();

  $res_count = $results['count'];

  $search_title = !isset($args['category']) ? 'No search specified' : ucfirst($args['category']).' ('.$res_count.')';
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Icon -->
  <link href="/img/a.gif" rel="shortcut icon">

  <title>accessCeramics</title>

  <!-- Font Awesome Icons -->
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>


  <link id='pagestyle' rel='stylesheet' type='text/css' href=<?=$main->active_style?>>

<script>

    <?='var q_results ='. json_encode($results) .';'?>
    <?='var get_args  ='. json_encode($args).';'?>
    <?='var _get  ='. json_encode($_GET).';'?>
    <?='var style_pack  ='. json_encode($style).';'?>
</script>

<script type="module" src="/js/PageManagement.js"></script>
<script type="module" src="/js/ajax.js?version=1"></script>
<script type="module" src="/js/alphabet.js"></script>
<script type="module" src="/js/categories.js"></script>

</head>
<body>
<?php $navbar->show()?>
<div id="content" class="container-fluid">
  <div id="result-body">
    <div class="container-fluid" id="header">
      <?php $header->show()?>

      </div>
      <div class="navigate"></div>
      <div id="results"></div>
    <div class="navigate"></div>
  </div> <!-- end results -->
</div> <!-- end content -->


  <!-- Bootstrap core JavaScript -->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>

</body>

</html>
