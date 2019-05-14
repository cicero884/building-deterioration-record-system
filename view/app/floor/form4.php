<?php
$icons=array(
	"new"=>"新增區域",
	"delete"=>"刪除",
	"finish"=>"完成"
)
?>
<div class="page">
	<div id='map_back'>
		<img id="d_map">
	</div>
	<div id=recordList>
<?php foreach($icons as $name => $chName):?>
		<figure class='recordIcon' id='<?php echo $name;?>'>
			<figcaption><?php echo $chName;?></figcaption>
			<img src='view/app/image/icons/<?php echo $name;?>.png'>
		</figure>
<?php endforeach;?>
	</div>
</div>
