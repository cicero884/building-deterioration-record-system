$('#addHouse').click(function(){
	window.location.hash='app_house';
	/*
	$.ajax({
		url:'index.php',
		type:'POST',
		data:{
			page:'app_house',
		},
		success:function(responce){
			window.location.hash = 'add_building';
			$('.content').html(responce);
			var flky = new Flickity( '.content', {
				cellSelector: ".page"
			})
		}
	})
	*/
});
$('.house').click(function(){
	window.location.hash=`app_floor-${this.getAttribute('value')}`;
	/*
	$.ajax({
		url:'index.php',
		type:'POST',
		data:{
			page:'app_floor',
			buildingID:this.getAttribute('value'),
		},
		success:function(responce){
			window.location.hash = 'floor';
			$('.content').html(responce);
			var flky = new Flickity( '.content', {
				cellSelector: ".page"
			})
		}
	})
	*/
});

window.location.hash='app_main';
