$('#submitHouse').click(function(e){
	e.preventDefault();
	let formData = new FormData($('.content')[0]);
	formData.append('page', 'building');
	formData.append('action','insert');
	formData.set('houseImage',$('[name="houseImage"]').prop('files')[0]);
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
			window.location.hash="app_main";
        }
    });
})
