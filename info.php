<?php
	require('classes/snippits.class.php');
	require('classes/argparser.class.php');

	$args = (new ArgParser($_GET))->get_args();
	$navbar = new Snippits('classic-navbar');

	if ($args['state'] == 'faq')
		$content = new Snippits('info-faq');
	else if ($args['state'] == 'help')
		$content = new Snippits('info-help');
	else if ($args['state'] == 'resources')
		$content = new Snippits('info-resources');
	else if ($args['state'] == 'contribute')
		$content = new Snippits('info-contribute');
	else
		$content = new Snippits('info-about');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Access Ceramics Info</title>
	<link rel="stylesheet" type="text/css" href="/css/info.css">
<script>
	<?='var get_args  ='. json_encode($args).';'?>
	<?='var _get  ='. json_encode($_GET).';'?>
	</script>
</head>
<body>
	<?php $navbar->show();?>
	<div id="content">
		<h1 class="h3">Info</h1>
		<hr class="divider pt-1 ml-0">
		<?php $content->show();?>
	</div>
</body>

<!-- Bootstrap core JavaScript -->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>
</html>
