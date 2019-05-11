function leftBarBack(){
	$('#leftBar').hide('slide',{direction:'left',duration:'fast'});
	$('#mask').hide('fade',{duration:'fast'});
	$('#mask').off('click.leftBar');
}
$('#arrow').click(leftBarBack);
$('#logOut').click(function(){
	$.ajax({
		url:'login.php',
		type:'POST',
		data:{
			action:'logout',
		},
		error: function(xhr) {
			alert('Ajax request error');
		},
		success: function(response) {
			location.reload();
		}
	});
})
