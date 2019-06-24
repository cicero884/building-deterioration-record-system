<div id='main'>
	<h2 id="subTitle">Recently</h2>
	<div id="homeList">
<?php foreach($this->recentHouses as $house):?>
		<figure class='house' name='buildingID' value='<?=$house['buildingId']?>'>
			<img class='houseImage' alt="house" width='100%' height='25%' src='<?=$house['image'];?>'></img>
			<figcaption class='houseAddress midium'><?=$house['address'];?></figcaption>
		</figure>
<?php endforeach;?>
	</div>
	<img id="addHouse" src='view/app/image/buttons/plus.png'>
</div>
