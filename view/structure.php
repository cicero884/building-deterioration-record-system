<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="view/app/image/logos/login.png">
		<meta charset = "utf-8">
<?php
foreach($this->page_css as $css){
	echo "<link rel='stylesheet' type='text/css' href='$css'>\n";
}
?>
	</head>
	<body>
<?php
foreach($this->page_html as $html) include "$html";
if(count($this->contents)>0){
	echo "<form class='content'>";
	foreach($this->contents as $content) $this->load($content);
	echo "</form>";
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
	echo "<script src='$js'></script>\n";
}
?>
	</body>
</html>

