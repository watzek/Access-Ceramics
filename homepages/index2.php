<?php
	function css_resize($desired_h,$image_url)
	{
		list($width, $height, $type, $attr) = getimagesize($image_url);
		$final_height = 0;
		$final_width = 0;
		if($height != $desired_h)
		{
			$factor = $desired_h/$height;
			$final_height = floor($desired_h);
			$final_width = floor($width * $factor);
		}else
		{
			$final_height = $height;
			$final_width = $width;
		}

		return "height:{$final_height}px; width:{$final_width}px;";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="/images/a.gif">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
	<title>Access Ceramics</title>
	<link rel="stylesheet" type="text/css" href="css/main2.css">
	<link rel="stylesheet" type="text/css" href="css/style2.css">
</head>
<body class="bg-gradient-dark">
	<nav class="navbar navbar-expand-lg navbar-light">
		<!-- <a class="navbar-brand mr-5" href="#">
			<img src="./images/accessCeramics_logo.png" alt="Access Ceramics Logo"></a>
		</a> -->
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>

	  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	  		<ul class="navbar-nav mx-auto text-center">
	      		<li class="nav-item active">
	        		<a class="nav-link text-primary" href="#">Home<span class="sr-only">(current)</span></a>
	      		</li>
	      		<!-- <li class="nav-item">
	        		<a class="nav-link" href="#">Link</a>
	      		</li> -->
		     	 <li class="nav-item dropdown">
		        	<a class="nav-link dropdown-toggle text-primary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Browse
		        	</a>
		        	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          	<a class="dropdown-item" href="./institutions">Institutions</a>
		          	<a class="dropdown-item" href="./result_table/collection/1/1">Collection</a>
		          	<!-- <div class="dropdown-divider"></div> -->
		          	<a class="dropdown-item" href="./artists">Artists</a>
		          	<a class="dropdown-item" href="./glazing">Glazing/Surface</a>
		          	<a class="dropdown-item" href="./material">Material</a>
		          	<a class="dropdown-item" href="./object">Object Type</a>
		          	<a class="dropdown-item" href="./technique">Technique</a>
		          	<a class="dropdown-item" href="./temperature">Temperature</a>
		        	</div>
		      	</li>
		      	<li class="nav-item">
	        		<a class="nav-link text-primary" href="#">Artists</a>
	      		</li>
	      		<li class="nav-item">
	        		<a class="nav-link text-primary" href="#">Contribute</a>
	      		</li>
	      		<li class="nav-item dropdown">
		        	<a class="text-primary nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Information
		        	</a>
		        	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          	<a class="dropdown-item" href="./about">About</a>
		          	<a class="dropdown-item" href="./faq">FAQ</a>
		          	<a class="dropdown-item" href="./help">Help</a>
		          	<a class="dropdown-item" href="https://www.flickr.com/groups/contemporary_ceramics/">Flickr</a>
		          	<a class="dropdown-item" href="./resources">Resources</a>
		        	</div>
		      	</li>
		      	<form class="form-inline my-2 my-lg-0 mx-auto">
	      			<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
	      			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	    		</form>
		    </ul>
	  </div>
	</nav> <!-- end navbar -->

	<div class="py-1 mb-1 toprule"></div>
<div class="container-fluid">
	<div class="row">
		<div id="container" class="container-fluid mx-auto col-12">
			<div id="carouselExampleControls" class="carousel slide h-100" data-ride="carousel">
			  	<div class="carousel-inner">
			    	<?php 
						$first = True;
						$active = "active";

						$image_path = './images/carousel/*.jpg';
						foreach (glob($image_path) as $image) {
							$split = explode(".", explode("/", $image)[3]);

							$piece_name = str_replace("_"," ", $split[0]);
							$artist_name = str_replace("_"," ", $split[1]);
							$style = css_resize(200,$image);

							echo("
							<div class=\"carousel-item w-100 {$active}\" style=\"\">
					  			<img src=\"{$image}\" class=\"d-block mx-auto\" alt=\"...\" style=\"height:60vh;\"> 
					  			<div class=\"carousel-caption d-md-block\">
					  				<h5>{$artist_name}</h5>
					  				<p>{$piece_name}</p>
					  			</div>
							</div>");
							if($first == True)
							{ 
								$first = False;
								$active = "";
							}

						}
					?>
			  	</div>
			  	<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			    	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    	<span class="sr-only">Previous</span>
			  	</a>
			  	<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			    	<span class="carousel-control-next-icon" aria-hidden="true"></span>
			    	<span class="sr-only">Next</span>
			  	</a>
			</div> <!-- end carousel -->
		</div>	<!-- end carousel container -->
		<div class="lead text-center col-sm-12 col-lg-3 px-2 py-2">
			<p><span id="accessText">access</span><span id="ceramicsText">Ceramics</span>
			is a growing collection of contemporary ceramics images by recognized artists enhancing ceramics education worldwide.</p>
		</div>
		<div class="lead text-center col-sm-6 col-lg-2 px-2 py-2">
			<h3 class="h4 mb-0">News</h3>
			<hr/>
			<p id="news">
			<i>Apr 26 2019:</i> New images by Luciana Grazia Menegazzi.
			<br/><br/>
			<i>Feb 26 2019:</i> New images by Hunter Stamps.
			<br/><br/>
			<i>Feb 16 2019:</i> New images by Elaine Buss.
			<br/><br/>
			</p>
		</div>
	</div>  <!-- end row -->
</div> <!-- end container-fluid -->
	

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
