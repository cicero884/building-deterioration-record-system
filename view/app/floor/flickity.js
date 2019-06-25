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
			let floor=getInputFloor();
			if(isNaN(floor)||floor==0){
				$contentFlickity.flickity('previous');
				$('#floorNumber').addClass("blink");
				setTimeout(function() {
					$('#floorNumber').removeClass("blink");
				}, 0.5);
				break;
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
			console.log('here');
			let final_ctx=$("#floor")[0].getContext("2d");
			clearCanvas(final_ctx);
			final_ctx.drawImage(base_ctx.canvas,0,0,$("#floor")[0].width,$("#floor")[0].height);
			if(prev_index<index) send_floor_data();
			initEvent(deteriorationPos);
			break;
	}
	prev_index=index;
});
function setImage(img){
	let final_ctx=$("#floor")[0].getContext("2d");
	let drawCanvas=$('#floorDraw')[0];
	let draw_ctx=baseCanvas.getContext("2d");
	base_ctx.drawImage(img,0,0,baseCanvas.width,baseCanvas.height);
	final_ctx.drawImage(img,0,0,$("#floor")[0].width,$("#floor")[0].height);
	draw_ctx.drawImage(img,0,0,$('#floorDraw')[0].width,$('#floorDraw')[0].height);
}
setTimeout(function() {
	if($("#floor")[0].getAttribute('src')!==''){
		$contentFlickity.flickity( 'select',1, false, true );
		$contentFlickity.flickity( 'select',2, false, true );
		$contentFlickity.flickity( 'select',3, false, true );
		onImageLoaded($("#floor")[0].getAttribute('src'),setImage);

		let xSize=$('#d_tags').width()/100;
		let ySize=$('#d_tags').height()/100;
		for(let i=0;i<$(".record").length;++i){
			let x=Number($(".record")[i].getAttribute('posLeft'))*xSize;
			let y=Number($(".record")[i].getAttribute('posTop'))*ySize;
			$(".record")[i].style.left=x+"px";
			$(".record")[i].style.top=y+"px";
			$(".record")[i].innerHTML=('0'+(1+i)).slice(-2);
		}
	}
}, 500);
function onImageLoaded(url, cb) {
	var image = new Image()
	image.src = url

	if (image.complete) {
		// 圖片已經被載入
		cb(image)
	} else {
		// 如果圖片未被載入，則設定載入時的回調
		image.onload = function () {
			cb(image)
		}
	}
}

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
	let formData = new FormData();
	let hashData=window.location.hash.substring(1).split('-');
	let planeData=$("#baseCanvas")[0].toDataURL("image/png");
	formData.append('page', 'floor');
	if(hashData.length>2){
		formData.append('action', 'update');
		formData.append('floorID',hashData[2]);
	}
	else formData.append('action', 'insert');

	formData.append('floor',getInputFloor());
	formData.append('buildingId', hashData[1]);
	formData.append('floorPlan',planeData);
	$.ajax({
		url:'upload.php',
		type:'POST',
		processData: false,
		contentType: false,
		data:formData,
		error: function(xhr) {
			alert('Ajax request error');
		},
		success: function(response){
			HashReflashFlag=false;
			window.location.hash=window.location.hash+"-"+response;
		}
	});
}
function getInputFloor(){
	let upper_or_down=$('input[name="floor"]:checked').val();
	let floor;
	if(upper_or_down==='upper') floor=$('#upper').val();
	else if(upper_or_down==='down') floor='-'+$('#down').val();
	return Number(floor);
}
