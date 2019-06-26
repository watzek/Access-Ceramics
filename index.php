<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		ul
		{
			border-radius: 10px;
			max-width: 25rem;
			background-color: beige;
			padding: 5px;
			list-style: none;
			margin: auto;
		}
		li
		{
			font-size: 12pt;
			margin-top: 5px;
			transition: font-size 1s;
		}
		li:hover
		{
			background-color: lightblue;
			font-weight: bolder;
			font-size: 20pt;
		}
		a
		{
			text-decoration: none;
		}	
		div
		{
			text-align: center;
		}

	</style>
	<title>Show Case</title>
</head>
<body>
	<div>
		<h1>Home Pages</h1>
		<ul>
			<li>
				<a href="homepages/index.bordertile.php">Border Tile</a>
			</li>
			<li>
				<a href="homepages/index.border.php">Border</a>
			</li>
			<li>
				<a href="homepages/index.creative.html">Creative</a>
			</li>
			<li>
				<a href="homepages/index.classic.php">Classic</a>
			</li>
		</ul>
	</div>
	<div>
		<h1>Browse Pages</h1>
		<ul>
			<li>
				<a href="browsepages/browse.php">Home Tiles</a>
			</li>
			<li>
				<a href="browsepages/">Classic</a>
			</li>
			<li>
				<a href="browsepages/view.php">Pane View</a>
			</li>
			<li>
				<a href="browsepages/view.php?v=grid">Grid View</a>
			</li>
			<li>
				<a href="browsepages/view.php?v=list">List View</a>
			</li>
		</ul>
	</div>
	<form action="#" method="get">
  		First name: <input type="text" name="af" value=<?=$_GET["af"]?>><br>
  		Last name: <input type="text" name="al" value=<?=$_GET["al"]?>><br>
  		Glazing: <input type="text" name="g" value=<?=$_GET["g"]?>><br>
  		Material: <input type="text" name="m" value=<?=$_GET["m"]?>><br>
  		Object: <input type="text" name="o" value=<?=$_GET["o"]?>><br>
  		Technique: <input type="text" name="t" value=<?=$_GET["t"]?>><br>
  		Temperature: <input type="text" name="tem" value=<?=$_GET["tem"]?>><br>
  		From date: <input type="number" name="ds" value=<?=$_GET["ds"]?>><br>
  		To date: <input type="number" name="de" value=<?=$_GET["de"]?>><br>
  		<input type="submit" value="Submit">
	</form>

<h1 style="text-align: center;"> This is For Testing </h1>
	<?php
		require('classes/argparser.class.php');
		require('classes/mysql.class.php');

		$ap = new ArgParser($_GET);
		$db = new mysql();
		 foreach ($db->categories() as $cat => $vals) {
		 	?>
		 	<h1><?=$cat?></h1>
		 	<h3><?=$vals['ct']?></h3>
		 	<img  style="width: 20vh; height: 20vh; object-fit: contain;" src=<?=$vals['src']?>>
		 	<?php
		 }
	?>
</body>
</html>