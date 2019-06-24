let baseCanvas=$('#baseCanvas')[0],
	base_ctx=baseCanvas.getContext("2d");

(function(){
	let ratio=$("#f3_plane").height()/9/40;//40 is image size
	console.log($("#floorElement").height());
	$(".floorElement").children('img').each(function(){
		this.height=$(this).height()*ratio;
	});
	$element_carousel.data('flickity').reloadCells();
})();

$element_carousel.on('staticClick.flickity',function( event, pointer, cellElement, cellIndex ){
	flkty.options.draggable =false;
	flkty.updateDraggable();

	selectImage=$(cellElement).children('img')[0];
	angle=lastX=lastY=0;
	stampDraw();
});
$('#rotateIcon').click(function(){
	angle+=Math.PI/2;
	stampDraw();
});
$('#finishCanvas').click(function(){
	flkty.options.draggable=true;
	flkty.updateDraggable();

	base_ctx.drawImage($('#floorElement')[0],0,0);
	clearCanvas();
	selectImage=null;
});
