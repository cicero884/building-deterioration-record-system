let $element_carousel = $('#elementList').flickity({
	cellSelector: '.floorElement',
	freeScroll: true,
	prevNextButtons: false,
	pageDots: false
});
let $carousel = $('.content').flickity({
	cellSelector: '.page',
	prevNextButtons: false,
});
let flkty = $carousel.data('flickity');
let prev_index=0;
let mousePressed = false;
$carousel.on( 'change.flickity', function( event, index ) {
	switch(index){
		case 1:
			flkty.options.draggable=false;
			flkty.updateDraggable();

			setCanvasVar($("#floorDraw")[0]);
			initEvent(brushDraw);
			break;
		case 2:
			flkty.options.draggable =true;
			flkty.updateDraggable();

			setCanvasVar($("#floorElement")[0]);
			if(prev_index<index){
				clearCanvas(base_ctx);
				base_ctx.drawImage($('#floorDraw')[0],0,0);
			}
			initEvent(stampDraw);
			break;
		case 3:
			$('#d_map').attr("src",$('#baseCanvas')[0].toDataURL());
			break;
	}
	prev_index=index;
});

function initEvent(func){
	$carousel.off('pointerDown.flickity');
	$carousel.off('pointerMove.flickity');
	$carousel.off('pointerUp.flickity');
	$carousel.on( 'pointerDown.flickity', function(e,p,m) {
        mousePressed = true;;
        func(p, false);
    });

	$carousel.on( 'pointerMove.flickity', function(e,p,m) {
        if (mousePressed) {
            func(p, true);
        }
    });
	$carousel.on( 'pointerUp.flickity', function(e,p,m) {
        mousePressed = false;
    });
}
