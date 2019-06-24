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

readPreviewURL = (input)=> {
	if (input.files && input.files[0]) {
        let reader = new FileReader();
        console.log(reader);
		
		reader.onload = function(e) {
            $('#preview_image').attr('src', e.target.result);
            document.getElementById('preview_image').classList.add('preview_show');
            document.getElementById('houseImage').classList.add('houseImage_cancel');
		}
		
		reader.readAsDataURL(input.files[0]);
	}
}

document.getElementById('houseImage').onchange = ()=> {
    readPreviewURL( document.getElementById('houseImage') );
}
  
