<?php
$image=(is_null($this->floorInfo))? '':'image/'.$this->floorInfo['picture'];
?>
<div class='page'>
	<span class="large">建立建築平面圖  </span><span class="large white">請儘量將平面圖畫至最大</span>
	<div id="f2_plane" class="plane">
		<canvas id="f2_grid" class="grid"></canvas>
		<canvas id="floorDraw" src='<?=$image?>'></canvas>
		<div class="small">
			<figure class='clearCanvas'>
				<img src="view/app/image/buttons/clean.png">
				<figcaption>清除</figcaption>
			</figure>
			<figure id='finishDraw'>
				<img src="view/app/image/buttons/summit.png">
				<figcaption>完成</figcaption>
			</figure>
		</div>
	</div>
</div>
