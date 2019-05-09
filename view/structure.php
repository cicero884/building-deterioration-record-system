<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
<?php
foreach($this->page_css as $css){
	echo "<link rel='stylesheet' type='text/css' href='$css'>";
}
?>
	</head>
	<body>
<?php
foreach($this->page_html as $html){
	include "$html";
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
foreach($this->page_js as $js){
	echo "<script src='$js'></script>";
}
?>
	</body>
</html>

