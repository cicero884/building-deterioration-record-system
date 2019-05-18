let mousePressed = false;
let lastX, lastY,pos;
let cur_ctx,angle=0;
let selectImage;

function setCanvasVar(canvas){
    cur_ctx=canvas.getContext("2d");
	pos=getAbsolutePos($('#floorDraw')[0]);
}
function initCanvasEvent(func){
	$carousel.off('pointerDown.flickity');
	$carousel.off('pointerMove.flickity');
	$carousel.off('pointerUp.flickity');
	$carousel.on( 'pointerDown.flickity', function(e,p,m) {
        mousePressed = true;
        func(p.pageX - pos.left, p.pageY - pos.top, false);
    });

	$carousel.on( 'pointerMove.flickity', function(e,p,m) {
        if (mousePressed) {
            func(p.pageX - pos.left, p.pageY - pos.top, true);
        }
    });
	$carousel.on( 'pointerUp.flickity', function(e,p,m) {
        mousePressed = false;
    });
}
function brushDraw(x,y,isDown){
	if (isDown) {
		cur_ctx.beginPath();
		cur_ctx.strokeStyle = "#000";// $('#selColor').val();
		cur_ctx.lineWidth = vmin(1);// $('#selWidth').val();
		cur_ctx.lineJoin = "round";
		cur_ctx.moveTo(lastX,lastY);
		cur_ctx.lineTo(x,y);
		cur_ctx.closePath();
		cur_ctx.stroke();
	}
	lastX = x; lastY = y;
}
function stampDraw(x,y, isDown){
	if (isDown&&selectImage) {
		let mid_x=lastX+selectImage.width/2,mid_y=lastY+selectImage.height/2;
		cur_ctx.clearRect(0,0,cur_ctx.canvas.width,cur_ctx.canvas.height);
		cur_ctx.save();
		cur_ctx.translate(mid_x,mid_y);
		cur_ctx.rotate(angle);
		cur_ctx.translate(-mid_x,-mid_y);
		cur_ctx.drawImage(selectImage,x,y);
		cur_ctx.restore();
		lastX = x; lastY = y;
	}
}
function clearCanvas(ctx=cur_ctx){
	ctx.setTransform(1, 0, 0, 1, 0, 0);
	ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
}
