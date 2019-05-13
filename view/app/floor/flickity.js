var $element_carousel = $('#iconList').flickity({
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
	if(index==1){
		pos=getAbsolutePos($('#floorDraw')[0]);
		flkty.options.draggable =false;
		flkty.updateDraggable();
		initCanvas("#floorDraw");
		initCanvasEvent();
	}
	else if(index==2){
		initCanvas("#floorElement");
	}
});

