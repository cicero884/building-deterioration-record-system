//var unsave_tags
//this var set at main page,

function tag(id, x, y) {
    this.id = id;
    this.x = x;
    this.y = y;
}
new_elem=null;
$('#new').click(function(){
	if(!new_elem){
		new_elem=$("<span class='record new_tag'>"+('0'+($('.record').length+1)).slice(-2)+"</span>");
		new_elem.click(record_deterioration);
		$('#d_tags').append(new_elem);
	}
	else{
		new_elem.removeClass("blink");
		setTimeout(function() {
			new_elem.addClass("blink");
		}, 0.5);
	}
})
$('#finish').click(function(){
	let hashData=window.location.hash.substring(1).split('-');
	document.location.href = "index.php?page=judge&floorID="+hashData[2];
});
function record_deterioration(){
	$contentFlickity.on('staticClick.flickity',function(event,pointer,cellElement,cellIndex){
		let formData=new FormData();
		let hashData=window.location.hash.substring(1).split('-');
		formData.append('page', 'deterioration');
		formData.append('action','insert');

		formData.append('floorID',hashData[2]);
		formData.append('x',$('.new_tag')[0].offsetLeft/$('#d_tags').width()*100);
		formData.append('y',$('.new_tag')[0].offsetTop/$('#d_tags').height()*100);
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
				console.log(response);
				window.location.hash=`app_deterioration-${hashData[1]}-${hashData[2]}-${response}`;
			}
		});
	});
}
