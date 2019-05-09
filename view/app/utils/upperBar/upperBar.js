$('#hamburger').click(function(){
	$('#leftBar').show('slide',{direction:'left',duration:'fast'});
	$('#mask').show('fade',{duration:'fast'});
	$('#mask').on('click.leftBar',leftBarBack);
});
$('#leftBar').hide();
