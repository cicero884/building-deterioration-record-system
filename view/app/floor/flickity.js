let $element_carousel = $('#elementList').flickity({
	cellSelector: '.floorElement',
	groupCells: true,
	prevNextButtons: false,
	pageDots: false
});
let $carousel = $('.content').flickity({
	cellSelector: '.page',
	prevNextButtons: false,
});
let flkty = $carousel.data('flickity');
let prev_index=0;
$element_carousel.on('pointerDown.flickity',function(){
	flkty.options.draggable=false;
	flkty.updateDraggable();
});
$element_carousel.on('pointerUp.flickity',function(){
	flkty.options.draggable=true;
	flkty.updateDraggable();
});
$carousel.on( 'change.flickity', function( event, index ) {
	if(event.target.tagName.toLowerCase()!=="form") return;//prevent element_carousel change event
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
