let canvas=$('#floor')
let clickX = new Array();
let clickY = new Array();
let clickDrag = new Array();
let paint;
let context = canvas[0].getContext("2d");

function addClick(x, y, dragging){
	clickX.push(x);
	clickY.push(y);
	clickDrag.push(dragging);
}

function redraw(){
	context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas

	context.strokeStyle = "#000";
	context.lineJoin = "round";
	context.lineWidth = 5;

	for(let i=0; i < clickX.length; i++) {
		context.beginPath();
		if(clickDrag[i] && i){
			context.moveTo(clickX[i-1], clickY[i-1]);
		}else{
			context.moveTo(clickX[i]-1, clickY[i]);
		}
		context.lineTo(clickX[i], clickY[i]);
		context.closePath();
		context.stroke();
	}
}

canvas.mousedown(function(e){
	var mouseX = e.pageX - this.offsetLeft;
	var mouseY = e.pageY - this.offsetTop;

	paint = true;
	addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);
	redraw();
});
canvas.mousemove(function(e){
	if(paint){
		addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
		redraw();
	}
});
canvas.mouseup(function(e){
	paint = false;
});
canvas.mouseleave(function(e){
	paint = false;
});

