function drawBackground(){
	let background=$('#background')[0];
	background.setAttribute('width', window.innerWidth);
	background.setAttribute('height', window.innerHeight);
	let ctx=background.getContext('2d');
	let grd=ctx.createLinearGradient(0,0,window.innerWidth,0);
	grd.addColorStop(0,"#CCC");
	grd.addColorStop(0.5,"#FFF");
	grd.addColorStop(1,"#CCC");
	ctx.fillStyle=grd;
	ctx.fillRect(0,0,window.innerWidth,window.innerHeight)
	ctx.stroke();	
}

function setTitle(){
	$('#title').css({"font-size":window.innerWidth/30+"px"});
	$('#subTitle').css({"font-size":window.innerWidth/20+"px"});

}
function drawLine(){
	let background=$('#background')[0];
	let ctx=background.getContext('2d');
	ctx.lineWidth=$('#subTitle').height()/4;
	ctx.strokeStyle='#32C6BA';
	let lineY=$('#subTitle').position().top+$('#subTitle').height()/7*5;
	let Xpos=0;
	let padding=window.innerWidth/100;
	ctx.beginPath();
	ctx.moveTo(Xpos,lineY);
	ctx.lineTo((Xpos+=$('#subTitle').position().left)-padding,lineY);
	ctx.moveTo(Xpos+$('#subTitle').width()+padding,lineY);
	ctx.lineTo(window.innerWidth,lineY);
	ctx.stroke();
}
function setContent(){
	persons=$('.person');
	let padding=window.innerWidth/100;
	for(let i=0;i<persons.length;++i){
		persons[i].style.left=window.innerWidth/persons.length*i+padding;
	}
	$('.tagText').css("font-size",window.innerWidth/80+'px');
	$('.name').css({"font-size":window.innerWidth/40+"px"});
	$('.department').css({"font-size":window.innerWidth/45+"px"});
}
function beginPage(){
	drawBackground();
	setTitle();
	drawLine();
	setContent();
}
$(window).resize(function(){
	beginPage();
});
window.addEventListener('load', function(){
	beginPage();
});
