var mousePressed = false;
var lastX, lastY;
var ctx;

function initCanvas(canvas) {
    ctx = $(canvas)[0].getContext("2d");
}
function initCanvasEvent(){
	$carousel.on( 'pointerDown.flickity', function(e,p,m) {
		console.log('down');
        mousePressed = true;
        Draw(p.pageX - pos.left, p.pageY - pos.top, false);
    });

	$carousel.on( 'pointerMove.flickity', function(e,p,m) {
        if (mousePressed) {
            Draw(p.pageX - pos.left, p.pageY - pos.top, true);
        }
    });
	$carousel.on( 'pointerUp.flickity', function(e,p,m) {
        mousePressed = false;
    });
	    $('#floorDraw').mouseleave(function (e) {
        mousePressed = false;
    });
}

function Draw(x, y, isDown) {
    if (isDown) {
        ctx.beginPath();
        ctx.strokeStyle = $('#selColor').val();
        ctx.lineWidth = $('#selWidth').val();
        ctx.lineJoin = "round";
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(x, y);
        ctx.closePath();
        ctx.stroke();
    }
    lastX = x; lastY = y;
}
function clearCanvas(){
	ctx.setTransform(1, 0, 0, 1, 0, 0);
    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
}
