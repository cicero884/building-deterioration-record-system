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
$carousel.on( 'change.flickity', function( event, index ) {
	switch(index){
		case 1:
			flkty.options.draggable=false;
			flkty.updateDraggable();

			setCanvasVar($("#floorDraw")[0]);
			initCanvasEvent(brushDraw);
			break;
		case 2:
			flkty.options.draggable =true;
			flkty.updateDraggable();

			setCanvasVar($("#floorElement")[0]);
			if(prev_index<index){
				clearCanvas(base_ctx);
				base_ctx.drawImage($('#floorDraw')[0],0,0);
			}
			initCanvasEvent(stampDraw);
			break;
		case 3:
			$('#d_map').attr("src",$('#baseCanvas')[0].toDataURL());
			break;
	}
	prev_index=index;
});

