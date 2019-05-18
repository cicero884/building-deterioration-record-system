function getAbsolutePos(element) {
    var top = 0, left = 0;
    do {
        top += element.offsetTop  || 0;
        left += element.offsetLeft || 0;
		do{
			element = element.offsetParent;
		}while(element&&element.classList.contains('page'))
    } while(element);

    return {
        top: top,
        left: left
    };
};
function setSize(element,width,height){
	element.width=width;
	element.height=height;
}
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
function vh(v) {
	var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
	return (v * h) / 100;
}

function vw(v) {
	var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
	return (v * w) / 100;
}

function vmin(v) {
	return Math.min(vh(v), vw(v));
}

function vmax(v) {
	return Math.max(vh(v), vw(v));
}
