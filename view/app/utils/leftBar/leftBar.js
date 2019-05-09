function leftBarBack(){
	$('#leftBar').hide('slide',{direction:'left',duration:'fast'});
	$('#mask').hide('fade',{duration:'fast'});
	$('#mask').off('click.leftBar');
}
$('#arrow').click(leftBarBack);
