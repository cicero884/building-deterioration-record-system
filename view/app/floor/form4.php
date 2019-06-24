<?php
$icons=array(
	"new"=>"新增區域",
	"delete"=>"刪除",
	"finish"=>"完成"
);
$image=(is_null($this->floorInfo))? '':'image/'.$this->floorInfo['picture'];
?>
<div class="page">
	<div id='f4_plane' class="plane">
		<canvas class="grid" align=center></canvas>
		<canvas id="floor" src='<?=$image?>'></canvas>
		<div id="d_tags">
<?php foreach($this->deteriorations as $d) echo "<span class='record' posLeft=".$d['locationX']." posTop=".$d['locationY']."></span>";?>
		</div>
	</div>
	<div id="recordList">
<?php foreach($icons as $name => $chName):?>
		<figure class='recordIcon' id='<?php echo $name;?>'>
			<img src='view/app/image/icons/<?php echo $name;?>.png'>
			<figcaption class="small"><?php echo $chName;?></figcaption>
		</figure>
<?php endforeach;?>
	</div>
</div>
