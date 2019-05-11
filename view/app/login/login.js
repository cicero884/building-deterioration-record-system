
$("#login__button").click(function(){
	$.ajax({
		url:'login.php',
		type:'POST',
		data:{
			action:'login',
            account: $('#login__account').val(),
            password: $('#login__password').val()
		},
		error: function(xhr) {
			alert('Ajax request error');
		},
		success: function(response){
			if(response==="") location.reload();
			else $('#errMsg').html(response);
		}
	});
})
