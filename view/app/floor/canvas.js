var mousePressed = false;
var lastX, lastY;
var ctx,pos,angle=0,prev_ctx;
var selectImage;

function initCanvas(canvas) {
	$(canvas)[0].width=window.innerWidth*0.8;
	$(canvas)[0].height=window.innerHeight*0.8;
    ctx = $(canvas)[0].getContext("2d");
}
function initCanvasEvent(func){
	$carousel.on( 'pointerDown.flickity', function(e,p,m) {
        mousePressed = true;
        func(p.pageX - pos.left, p.pageY - pos.top, false);
    });

	$carousel.on( 'pointerMove.flickity', function(e,p,m) {
		e.preventDefault();
        if (mousePressed) {
            func(p.pageX - pos.left, p.pageY - pos.top, true);
        }
    });
	$carousel.on( 'pointerUp.flickity', function(e,p,m) {
        mousePressed = false;
    });
	$('#floorDraw').mouseleave(function (e) {
        mousePressed = false;
    });
}
function Move(x,y, isDown){
	if (isDown&&selectImage) {
		let mid_x=lastX+selectImage.width/2,mid_y=lastY+selectImage.height/2;
		ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height);
		ctx.save();
		ctx.translate(mid_x,mid_y);
		ctx.rotate(angle);
		ctx.translate(-mid_x,-mid_y);
		ctx.drawImage(selectImage,x,y);
		ctx.restore();
		lastX = x; lastY = y;
	}
}
function Draw(x,y,isDown){
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
