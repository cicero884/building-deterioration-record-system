$('#final').click(function(e){
    e.preventDefault();
    let hashData=window.location.hash.substring(1).split('-');
	let formData = new FormData($('.content')[0]);
	formData.append('page', 'deterioration');
    formData.append('action','update');
    formData.append('buildingId', Number(hashData[1]));
    formData.append('floorId', Number(hashData[2]));
    formData.append('deteriorationId', Number(hashData[3]));
    formData.append('floorId', Number(hashData[2]));
    formData.append('buildingId', Number(hashData[1]));
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
            let hashData=window.location.hash.substring(1).split('-');
            console.log( "app_main-"+Number(hashData[1]) + "-" + Number(hashData[2]) );
            window.location.hash="app_floor-"+Number(hashData[1]) + "-" + Number(hashData[2]);
        }
    });
})

let readPreviewURL = (input , index)=> {
	if (input.files && input.files[0]) {
        let reader = new FileReader();
		
		reader.onload = function(e) {
            document.getElementsByClassName('preview')[index].src = e.target.result;
            document.getElementsByClassName('preview')[index].classList.add("show__preivew-image");
		}
		
		reader.readAsDataURL(input.files[0]);
	}
}

Array.from(document.getElementsByClassName('picture__button')).forEach( (element, index)=>{
    element.onchange = ()=> {
        readPreviewURL( document.getElementsByClassName('picture__button')[index], index );
    }
});

