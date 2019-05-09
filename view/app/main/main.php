<div>
<h2 id="subTitle">Recently</h2>
<div id="home_list">
<?php foreach($recentHouses as $house):?>
	<div id='house'>
		<img id='houseImage' src='<?php echo "$house->img";?>'></img>
		<p id='houseAddress'><?php echo "$house->address";?></p>
	</div>
<?php endforeach;?>
</div>
	<img id="add_house" src='view/app/image/buttons/new.png'>
</div>
