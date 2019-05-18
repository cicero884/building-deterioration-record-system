<?php
$floorElement=array(
	"stair1"=>"樓梯1",
	"stair2"=>"樓梯1",
	"split"=>"隔間",
	"doorL"=>"房門(左開)",
	"doorR"=>"房門(右開)")
?>
<div class='page'>
	<div id='floorImage'>
		<canvas id='baseCanvas'></canvas>
		<canvas id='floorElement'></canvas>
		<figure id='rotateIcon'>
			<img src="view/app/image/buttons/rotate.png">
			<figcaption>旋轉</figcaption>
		</figure>
		<figure class='clearCanvas'>
			<img src="view/app/image/buttons/clean.png">
			<figcaption>清除</figcaption>
		</figure>
		<figure id='finishCanvas'>
			<img src="view/app/image/buttons/summit.png">
			<figcaption>完成</figcaption>
		</figure>
	</div>
	<div id='elementList'>
<?php foreach($floorElement as $name => $chName):?>
		<figure class='floorElement' id='<?php echo $name;?>'>
			<figcaption><?php echo $chName;?></figcaption>
			<img src='view/app/image/floorElement/<?php echo $name;?>.png'>
		</figure>
<?php endforeach;?>
	</div>
</div>
