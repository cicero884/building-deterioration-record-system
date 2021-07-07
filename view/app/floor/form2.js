drawCanvas=$('#floorDraw')[0];
draw_ctx=baseCanvas.getContext("2d");
$('.clearCanvas').click(function(){
	clearCanvas();
});
$('#finishDraw').click(function(){
	$contentFlickity.flickity('next');
})
