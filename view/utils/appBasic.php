<?php session_start(); ?>
<h1 id='userName'>
	<?php echo $_SESSION['userId'];?>
</h1>
<canvas id='background'></canvas>
<script
	src="https://code.jquery.com/jquery-3.4.1.min.js"
	integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
	crossorigin="anonymous"></script>
<script src='appBasic.js'></script>
