function getAbsolutePos(element) {
    var top = 0, left = 0;
    do {
        top += element.offsetTop  || 0;
        left += element.offsetLeft || 0;
		do{
			element = element.offsetParent;
		}while(element&&element.classList.contains('is-selected'))
    } while(element);

    return {
        top: top,
        left: left
    };
};
function previewPhoto(element){
	$(element).change(function(){                                                                                                                     
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				console.log(e);
				$(element).parent(".image-upload").children().children(".preview").attr("src",e.target.result);
			}   
			reader.readAsDataURL(this.files[0]);
		}   
	})
}
