let tag_count=0;

//var unsave_tags
//this var set at main page,

function tag(id, x, y) {
    this.id = id;
    this.x = x;
    this.y = y;
}
$('#new').click(function(){
	new_elem=$("<span class='record new_tag'>"+('0'+(++tag_count)).slice(-2)+"</span>");
	unsave_tags.push(new tag(tag_count,0,0));
	new_elem.click(record_deterioration);
	$('#d_tags').append(new_elem);
})
function record_deterioration(){
	console.log("click");
	$carousel.on('staticClick.flickity',function(event,pointer,cellElement,cellIndex){
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
