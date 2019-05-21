let lastX, lastY,pos;
let cur_ctx,angle=0;
let selectImage;

function setCanvasVar(canvas){
    cur_ctx=canvas.getContext("2d");
	pos=getAbsolutePos($('#floorDraw')[0]);
}
function brushDraw(pointer,isDown){
	let x=between(pointer.offsetX,vmin(0.5),pointer.srcElement.width-vmin(0.5)),
		y=between(pointer.offsetY,vmin(0.5),pointer.srcElement.height-vmin(0.5));
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
function angleWH(){
	let ans=[
		(Math.abs(selectImage.width*Math.cos(angle))+Math.abs(selectImage.height*Math.sin(angle)))/2,
		(Math.abs(selectImage.width*Math.sin(angle))+Math.abs(selectImage.height*Math.cos(angle)))/2
	];
	return ans;
}
function stampDraw(pointer=null){
	if(selectImage) {
		let x,y,rotateAdjust=angleWH();
		if(!pointer || (pointer.srcElement.tagName.toLowerCase()!=="canvas")){
			x=lastX;
			y=lastY;
		}
		else{
			x=pointer.offsetX;
			y=pointer.offsetY;
		}
		x=between(x,rotateAdjust[0],cur_ctx.canvas.width-rotateAdjust[0]);
		y=between(y,rotateAdjust[1],cur_ctx.canvas.height-rotateAdjust[1]);

		cur_ctx.clearRect(0,0,cur_ctx.canvas.width,cur_ctx.canvas.height);
		cur_ctx.save();
		cur_ctx.translate(x,y);
		cur_ctx.rotate(angle);
		cur_ctx.translate(-x,-y);
		cur_ctx.drawImage(selectImage,x-selectImage.width/2,y-selectImage.height/2,selectImage.width,selectImage.height);
		cur_ctx.restore();
		lastX = x; lastY = y;
	}
}
function deteriorationPos(pointer){
	e=pointer.srcElement;
	if(e.classList.contains('record')){
		flkty.options.draggable=!pointer.pressure;
		flkty.updateDraggable();
		console.log(pointer);
		e.style.left=e.offsetLeft+pointer.offsetX+"px";
		e.style.top=e.offsetTop+pointer.offsetY+"px";
	}
}
function clearCanvas(ctx=cur_ctx){
	ctx.setTransform(1, 0, 0, 1, 0, 0);
	ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
}

//set canvas size
$(".plane").each(function(){
	let height=$(this).height(),
		width=height/3*2;
	$(this).children("canvas").each(function(){
		setSize($(this)[0],width,height);
	});
});
$("#d_tags").width($("#floor").width());
$("#d_tags").height($("#floor").height());

//draw grid
$(".grid").each(function(){
	ctx=$(this)[0].getContext("2d");
	for(let i=0;i<=6;++i){
		ctx.beginPath();
		ctx.lineWidth = (i%6==0)? vmin(0.6):vmin(0.2);
		ctx.moveTo(i*ctx.canvas.width/6,0);
		ctx.lineTo(i*ctx.canvas.width/6,ctx.canvas.height);
		ctx.stroke();
	}
	for(let i=0;i<=9;++i){
		ctx.beginPath();
		ctx.lineWidth = (i%9==0)? vmin(0.6):vmin(0.2);
		ctx.moveTo(0,i*ctx.canvas.height/9);
		ctx.lineTo(ctx.canvas.width,i*ctx.canvas.height/9);
		ctx.stroke();
	}
});
