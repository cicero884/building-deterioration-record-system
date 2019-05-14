<div class='main'>
	<h2 id="subTitle">Recently</h2>
	<div id="homeList">
<?php foreach($this->recentHouses as $house):?>
		<div id='house'>
			<img id='houseImage' src='<?php echo $house['image'];?>'></img>
			<p id='houseAddress'><?php echo $house['address'];?></p>
		</div>
<?php endforeach;?>
	</div>
	<img id="addHouse" src='view/app/image/buttons/new.png'>
</div>
