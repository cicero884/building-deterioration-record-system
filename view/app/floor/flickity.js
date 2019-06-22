$element_contentFlickity = $('#elementList').flickity({
	cellSelector: '.floorElement',
	groupCells: true,
	prevNextButtons: false,
	pageDots: false
});
$contentFlickity = $('.content').flickity({
	cellSelector: '.page',
	prevNextButtons: false,
});
flkty = $contentFlickity.data('flickity');
prev_index=0;
$element_contentFlickity.on('pointerDown.flickity',function(){
	flkty.options.draggable=false;
	flkty.updateDraggable();
});
$element_contentFlickity.on('pointerUp.flickity',function(){
	flkty.options.draggable=true;
	flkty.updateDraggable();
});
$contentFlickity.on( 'change.flickity', function( event, index ) {
	if(event.target.tagName.toLowerCase()!=="form") return;//prevent element_contentFlickity change event
	switch(index){
		case 1:
			if(prev_index<index){
				setFloorElements();
				setPlanes();
				$element_contentFlickity.flickity('resize');
			}

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
				base_ctx.drawImage($('#floorDraw')[0],0,0,baseCanvas.width,baseCanvas.height);
			}
			initEvent(stampDraw);
			break;
		case 3:
			let final_ctx=$("#floor")[0].getContext("2d");
			clearCanvas(final_ctx);
			final_ctx.drawImage(base_ctx.canvas,0,0,$("#floor")[0].width,$("#floor")[0].height);
			send_floor_data();
			initEvent(deteriorationPos);
			break;
	}
	prev_index=index;
});

function initEvent(func){
	let mousePressed = false;
	$contentFlickity.off('pointerDown.flickity');
	$contentFlickity.off('pointerMove.flickity');
	$contentFlickity.off('pointerUp.flickity');
	$contentFlickity.on( 'pointerDown.flickity', function(e,p,m) {
        mousePressed = true;;
        func(p, false);
    });

	$contentFlickity.on( 'pointerMove.flickity', function(e,p,m) {
        if (mousePressed) {
            func(p, true);
        }
    });
	$contentFlickity.on( 'pointerUp.flickity', function(e,p,m) {
        func(p, false);
        mousePressed = false;
    });
}
function send_floor_data(){
	$.ajax({
		url:'index.php',
		type:'GET',
		data:{
			type:'floor',

		}
	});
}
