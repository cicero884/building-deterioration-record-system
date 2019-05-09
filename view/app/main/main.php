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
<button id="add_house">
<?php echo "<img src='{$cur_path}image/buttons/new.png'>";?>
</button>
</div>
