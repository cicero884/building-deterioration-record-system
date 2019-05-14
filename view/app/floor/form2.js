$('.clearCanvas').click(function(){
	clearCanvas();
});
$('#finishDraw').click(function(){
	$carousel.flickity('next');
	prev_ctx=$('#prevCanvas')[0].getContext("2d");
	prev_ctx.drawImage($('#floorDraw')[0],0,0);
})
