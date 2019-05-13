var $carousel = $('.content').flickity({
	cellSelector: '.page'
});
var flkty = $carousel.data('flickity');
$carousel.on( 'change.flickity', function( event, index ) {
	if(index==1){
		pos=getAbsolutePos(canvas[0]);
		flkty.options.draggable =false;
		flkty.updateDraggable();
		$carousel.on( 'pointerDown.flickity', function(e,p,m) {
			console.log('down');
			var mouseX = p.pageX - pos.left;
			var mouseY = p.pageY - pos.top;

			paint = true;
			addClick(p.pageX - pos.left, p.pageY - pos.top);
			redraw();
		});
		$carousel.on( 'pointerUp.flickity', function() {
			console.log('up');
			paint = false;
		});
		$carousel.on( 'pointerMove.flickity', function(e,p,m) {
			console.log('move');
			if(paint){
				addClick(p.pageX - pos.left, p.pageY - pos.top, true);
				redraw();
			}
		});
	}
});
