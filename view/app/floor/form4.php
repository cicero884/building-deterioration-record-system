<?php
$icons=array(
	"new"=>"新增區域",
	"delete"=>"刪除",
	"finish"=>"完成"
)
?>
<div class="page">
	<div id='f4_plane' class="plane">
		<canvas class="grid" align=center></canvas>
		<canvas id="floor"></canvas>
		<div id="d_tags"></div>
	</div>
	<div id="recordList">
<?php foreach($icons as $name => $chName):?>
		<figure class='recordIcon' id='<?php echo $name;?>'>
			<img src='view/app/image/icons/<?php echo $name;?>.png'>
			<figcaption><?php echo $chName;?></figcaption>
		</figure>
<?php endforeach;?>
	</div>
</div>
