let newElement;
$element_carousel.on('staticClick.flickity',function( event, pointer, cellElement, cellIndex ){
	if(!cellElement) return;
	let newElement=$(cellElement).children('img').clone();
});
$('#rotateIcon').click(function(){
	angle+=Math.PI/2;
	Move(lastX,lastY,true);
});
$('#finishCanvas').click(function(){
	flkty.options.draggable=true;
	flkty.updateDraggable();
	prev_ctx.drawImage($('#floorElement')[0],0,0);
	ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height);
	selectImage=null;
});
