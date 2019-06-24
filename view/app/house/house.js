$('#submitHouse').click(function(){
	

	$.ajax({
        url:'upload.php',
        type:'POST',
        data:{
			type:'building',
        },
        error: function(xhr) {
            alert('Ajax request error');
        },
        success: function(response){
			$('.content').html(response);
        }
    });
})
