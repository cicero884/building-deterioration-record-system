$('#addHouse').click(function(){
	$.ajax({
		url:'index.php',
		type:'GET',
		data:{
			action:'addHouse',
		},
		success:function(responce){
			$('.content').remove();
			$('body').append("<div class='content'></content>");
			$('.content').html(responce);
			var flky = new Flickity( '.content', {
				cellSelector: ".page"
			})
		}
	})
})
