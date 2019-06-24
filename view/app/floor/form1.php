<div class="page">
	<p class="page__title">建築基本資料</p>
	<div id='houseInfo' class="border">
		<p>地址：<?=$this->buildingDetail->address?></p><br>
		<p>屋主姓名：<?=$this->buildingDetail->ownerName?></p><br>
		<p>屋主電話：<?=$this->buildingDetail->ownerPhone?></p><br>
	</div>
	<p class="page__title">紀錄樓層</p>
	<div id="floorNumber" class="border">
<?php
if(is_null($this->floorInfo)){
	$isUpper=false;
	$isDown=false;
	$upperfloor='';
	$downFloor='';
}
else{
	$floor=$this->floorInfo['floor'];
	$isUpper=($floor>0);
	$isDown=($floor<0);
	$upperfloor=($isUpper)? $floor:'';
	$downFloor=($isUpper)? '':abs($floor);
}
?>
		<div class="floorRecord">
			<input id="upper_radio" type="radio" class="scale" value="upper" name='floor' checked=<?=$isUpper?>><p>  地上</p><br>
			<input id="upper" type=number value=<?=$upperfloor?> style="height:5rem;width:15rem;">
			<p>樓</p>
		</div>
		<div class="floorRecord">
			<input id="down_radio" type="radio" class="scale" value="down" name='floor' checked=<?=$isDown?>><p>  地下</p><br>
			<input id="down" type=number value=<?=$downFloor?> style="height:5rem;width:15rem;">
			<p>樓</p>
		</div>
	</div>
</div>
