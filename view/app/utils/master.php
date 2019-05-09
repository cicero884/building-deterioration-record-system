<?php $cur_path='view/app/';?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
<?php
foreach($page_css as $css){
	echo "<link type='text/css' href='index.css' rel='$cur_path$css'>\n";
}
?>
	</head>
	<body>
<?php
foreach($page_html as $html){
	include "$cur_path$html";
}
?>
	<body>
	<script
		src="https://code.jquery.com/jquery-3.4.1.min.js"
		integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
		crossorigin="anonymous"></script>
	<script
  		src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
  		integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
  		crossorigin="anonymous"></script>
<?php
foreach($page_js as $js){
	echo "<script src='$cur_path$js'></script>";
}
?>
	</body>
</html>

