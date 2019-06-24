$('#final').click(function(e){
    e.preventDefault();
    let hashData=window.location.hash.substring(1).split('-');
	let formData = new FormData($('.content')[0]);
	formData.append('page', 'deterioration');
    formData.append('action','update');
    formData.append('deteriorationId', Number(hashData[3]));
    console.log( Number(hashData[3]) );
	// formData.set('houseImage',$('[name="houseImage"]').prop('files')[0]);
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