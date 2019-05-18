let lastX, lastY,pos;
let cur_ctx,angle=0;
let selectImage;

function setCanvasVar(canvas){
    cur_ctx=canvas.getContext("2d");
	pos=getAbsolutePos($('#floorDraw')[0]);
}
function brushDraw(pointer,isDown){
	let x=between(pointer.offsetX,vmin(1),pointer.srcElement.width-vmin(1)),
		y=between(pointer.offsetY,vmin(1),pointer.srcElement.height-vmin(1));
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
function stampDraw(pointer){
	if(selectImage) {
		let x,y;
		if(typeof pointer==="undefined" || (pointer.srcElement.tagName.toLowerCase()!=="canvas")){
			x=lastX;
			y=lastY;
		}
		else{
			x=between(pointer.offsetX,0,pointer.srcElement.width-selectImage.width);
			y=between(pointer.offsetY,0,pointer.srcElement.height-selectImage.height);
		}
		cur_ctx.clearRect(0,0,cur_ctx.canvas.width,cur_ctx.canvas.height);
		cur_ctx.save();
		cur_ctx.translate(x,y);
		cur_ctx.rotate(angle);
		cur_ctx.translate(-x,-y);
		cur_ctx.drawImage(selectImage,x,y);
		cur_ctx.restore();
		lastX = x; lastY = y;
	}
}
function clearCanvas(ctx=cur_ctx){
	ctx.setTransform(1, 0, 0, 1, 0, 0);
	ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
}
