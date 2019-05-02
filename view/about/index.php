<!DOCTYPE html>
<html>
	<head>
		<meta charset=UTF-8">
		<link type="text/css" href="index.css" rel="stylesheet">
	</head>

	<body>
		<canvas id='background'>
			Your browser does not support the canvas element.
		</canvas>
		<h1 id='title' class='middle'>About us</h1>
		<h2 id='subTitle' class='middle'>Our Design Team</h2>
		<div id='content'>
		<?php 
		$json_file='./data.json';
		$json_data=json_decode(file_get_contents($json_file),true);
		foreach ($json_data as $person):
		?>
			<div class='person'>
				<div class='photo'>
					<img src="<?php echo '../image/person'.$person['img']; ?>" class='headImg'>
						person image
					</img>
					<div class='tag'>
						<img src="<?php echo '../image/'.(strpos($person['type'],'組長')===false ? 'sticker2.png':'sticker1.png');?>" class='tagImg'></img>
						<div class='tagText middle'><?php echo $person['type']?></div>
					</div>
				</div>
				<h3 class='name middle'><?php echo $person['name']?></h3>
				<h4 class='department middle'><?php echo $person['department']?></h4>
				<div class='info'>
					<p>專長/</p>
					<p><?php echo $person['expertise']?></p>
					<p>興趣/</p>
					<p><?php echo $person['interest']?></p>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
	</body>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="index.js"></script>
</html>
