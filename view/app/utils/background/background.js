function drawBackground(){
	let background=$('#background')[0];
	let ctx=background.getContext('2d');
	let grd=ctx.createLinearGradient(0,0,0,window.innerHeight);
	grd.addColorStop(0,"#3BC7AA");
	grd.addColorStop(1,"#105464");
	ctx.fillStyle=grd;
	ctx.fillRect(0,0,window.innerWidth,window.innerHeight)
	ctx.stroke();
	console.log('draw_background!');
}
drawBackground();
