<script type="text/javascript">
	window.onload = function()
	{

		var pane = document.getElementById('panedisplay');
		var results = document.getElementsByClassName('paneobj');
		for (var i = 0; i < results.length; i++) {
			results[i].onclick = function(){
				console.log('hey there');
				pane.src = this.querySelector('.panepic').src;
			};
		}
	}

/*	function findByClassName(children, tag)
	{
		for (var i = 0; i < children.length; i++) {
			if (children[i]
		}
	}*/

</script>

<div id="content" class="container-fluid">
	<div class="row h-100">
		<div class="col-lg-6 col-12 bg-primary paneview"> <!-- begin results div -->
			<div class="row">
				<button class="paneobj p-2">
					<img src="img/acpics/Hirotake-Imanishi.shell.jpg" class="panepic">
					<p class="mdata">shell <br>
					Hirotake Imanishi</p>
				</button>
				<button class="paneobj p-2">
					<img src="img/acpics/Hirotake-Imanishi.shell.jpg" class="panepic">
					<p class="mdata">shell <br>
					Hirotake Imanishi</p>
				</button>
			<button class="paneobj p-2">
					<img src="img/acpics/Hirotake-Imanishi.shell.jpg" class="panepic">
					<p class="mdata">shell <br>
					Hirotake Imanishi</p>
				</button>
			<button class="paneobj p-2">
					<img src="img/acpics/Hirotake-Imanishi.shell.jpg" class="panepic">
					<p class="mdata">shell <br>
					Hirotake Imanishi</p>
				</button>
			</div>

		</div> <!-- end results div -->
		<div class="col-lg-6 col-12 bg-secondary paneview">
				<img id="panedisplay" src="">
				<p class="author"></p>
				<p class="name"></p>
		</div>
	</div>
</div>