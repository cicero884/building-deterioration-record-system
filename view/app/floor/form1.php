<div class="page">
	<p class="midium">建築基本資料</p>
	<div id='houseInfo' class="midium">
	地址：<?=$this->buildingDetail->address?><br>
	屋主姓名：<?=$this->buildingDetail->ownerName?><br>
	屋主電話：<?=$this->buildingDetail->ownerPhone?><br>
	</div>
	<p class="midium">紀錄樓層</p>
	<div id="floorNumber">
<?php
if(is_null($this->floorInfo)){
	$isUpper=false;
	$isDown=false;
	$upperfloor='';
	$downFloor='';
}
else{
	$floor=$this->floorInfo->floor;
	$isUpper=($floor>0);
	$isDown=($floor<0);
	$upperfloor=($isUpper)? $floor:'';
	$downFloor=($isUpper)? '':abs($floor);
}
?>
		<input type="radio" class="scale" value="upper" name='floor' checked=<?=$isUpper?>> 地上<br><input id="upper" type=text value="<?=$upperfloor?>">
		<p>樓</p>
		<input type="radio" class="scale" value="down" name='floor' checked=<?=$isDown?>> 地下<br><input id="down" type=text value="<?=$downFloor?>">
		<p>樓</p>
	</div>
</div>
