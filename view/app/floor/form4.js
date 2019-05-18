let d_array=[],current_elem;

setSize($("#d_map")[0],vw(80),vh(80));

$('#new').click(function(){
	new_elem=$("<div class='not-record'>"+(d_array.length+1)+"</div>");
	d_array.push(new_elem);
	current_elem=new_elem;
	new_elem.click(record_deterioration);
	$('#map_back').append(new_elem);
	new_elem.draggable();
})
function record_deterioration(){
	$carousel.on('staticClick.flickity',function(event,pointer,cellElement,cellIndex){
		
	});
}
