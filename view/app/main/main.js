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

/*

let readPreviewURL = (input)=> {
	console.log( "lalala" );
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		
		reader.onload = function(e) {
		$('#preview_image').attr('src', e.target.result);
		}
		
		reader.readAsDataURL(input.files[0]);
	}
}

$("#houseImage").on('change', function() {
	console.log( "hahaha" );
	readPreviewURL(this);
});

*/

window.location.hash='app_main';
