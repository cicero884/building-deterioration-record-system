var $element_carousel = $('#elementList').flickity({
	cellSelector: '.floorElement',
	freeScroll: true,
	prevNextButtons: false,
	pageDots: false
});
var $carousel = $('.content').flickity({
	cellSelector: '.page',
	prevNextButtons: false,
});
var flkty = $carousel.data('flickity');
$carousel.on( 'change.flickity', function( event, index ) {
	console.log(index);
	switch(index){
		case 1:
			pos=getAbsolutePos($('#floorDraw')[0]);
			flkty.options.draggable =false;
			flkty.updateDraggable();
			initCanvas("#floorDraw");
			initCanvasEvent(Draw);
			break;
		case 2:
			closePointerEvent();
			pos=getAbsolutePos($('#floorElement')[0]);
			flkty.options.draggable =true;
			flkty.updateDraggable();
			initCanvas("#floorElement");
			initCanvasEvent(Move);
			$element_carousel.on('staticClick.flickity',function(event,pointer,cellElement,cellIndex){
				ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height);
				selectImage=$(cellElement).children('img')[0];
				ctx.drawImage(selectImage,0,0);
				flkty.options.draggable =false;
				flkty.updateDraggable();
			});
			break;
		case 3:
			closePointerEvent();
			$('d_map').attr("src",$('#prevCanvas')[0].toDataURL());
			break;
	}
});

function closePointerEvent(){
	$carousel.off('pointerDown.flickity');
	$carousel.off('pointerMove.flickity');
	$carousel.off('pointerUp.flickity');
}
