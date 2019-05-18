setSize($("#floorDraw")[0],vw(80),vh(80));

$('.clearCanvas').click(function(){
	clearCanvas();
});
$('#finishDraw').click(function(){
	$carousel.flickity('next');
})
