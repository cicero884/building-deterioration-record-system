<div id='upperBar' style='position:fixed;'>
	<h1 id='userName'>
		<?php //echo $_SESSION['userId'];?>
	</h1>
<?php echo "<img id='hamburger' src='$cur_path/image/buttons/hamburger.png'></img>";?>
	<script type="text/javascript" defer>
		$('#hamburger').click(function(){
			$('#leftBar').show('slide',{direction:'right'});
		});
	</script>
</div>
