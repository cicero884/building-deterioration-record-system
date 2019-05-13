$('#clearCanvas').click(function(){
	clearCanvas();
});
$('#finishDraw').click(function(){
	$carousel.flickity('next');
	$('#prevCanvas').attr('src',$('#floorDraw')[0].toDataURL());
})
