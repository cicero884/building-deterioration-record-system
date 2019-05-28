<div id='main'>
	<h2 id="subTitle">Recently</h2>
	<div id="homeList">
<?php foreach($this->recentHouses as $house):?>
		<figure class='house'>
			<img class='houseImage' alt="house" width='100%' height='25%' src='<?php echo $house['image'];?>'></img>
			<figcaption class='houseAddress midium'><?php echo $house['address'];?></figcaption>
		</figure>
<?php endforeach;?>
	</div>
	<img id="addHouse" src='view/app/image/buttons/new.png'>
</div>
