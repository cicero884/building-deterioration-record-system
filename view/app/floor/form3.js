let baseCanvas=$('#baseCanvas')[0],
	base_ctx=baseCanvas.getContext("2d");

setSize(canvas=$("#floorElement")[0],vw(80),vh(80));
setSize(baseCanvas,vw(80),vh(80));

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
