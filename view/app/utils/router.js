let HashReflashFlag=true;
window.onhashchange=function(){
	//hash type:page-buildingID-floorID-deteriorationID
	if(!HashReflashFlag){
		HashReflashFlag=true;
		return;
	}
	let data=window.location.hash.substring(1).split('-');
	let TitleImageList={
		'app_main':'',
		'app_house':'view/app/image/title/houseTitle.png',
		'app_floor':'view/app/image/title/dataTitle.png',
		'app_deterioration':'view/app/image/title/dataTitle.png',
	};
	$('#upperBar').css("background-image", `url(${TitleImageList[data[0]]})`);
	$.ajax({
		url:'index.php',
		type:'POST',
		data:{
			page:data[0],
			buildingID:(data.length>1)? data[1]:'',
			floorID:(data.length>2)? data[2]:'',
			deteriorationID:(data.length>3)? data[3]:''
		},
		success:function(responce){
			$('.content').remove();
			$('body').append(`<form class='content'></form>`);
			$('.content').html(responce);
		},
	});
	HashReflashFlag=true;
}
