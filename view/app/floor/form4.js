//var unsave_tags
//this var set at main page,

function tag(id, x, y) {
    this.id = id;
    this.x = x;
    this.y = y;
}
$('#new').click(function(){
	if(!new_elem){
		new_elem=$("<span class='record new_tag'>"+('0'+(++window.tag_count)).slice(-2)+"</span>");
		new_elem.click(record_deterioration);
		$('#d_tags').append(new_elem);
	}
	else{
		new_elem.removeClass("blink");
		setTimeout(function() {
			new_elem.addClass("demo");
		}, 1);
	}
})
function record_deterioration(){
	$contentFlickity.on('staticClick.flickity',function(event,pointer,cellElement,cellIndex){
		$.ajax({
			url:'upload.php',
			type:'POST',
			data:{
				img:$("#floor")[0].toDataURL(),
				floor:($(".scale").val()=="upper")? $("#upper").val():"-"+$("#down").val(),
			}
		});
		$.ajax({
			url:'index.php',
			type:'GET',
			data:{action:"addDeterioration"}
		});
	});
}
