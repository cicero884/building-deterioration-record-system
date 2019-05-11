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
		success: function(response) {
			location.reload();
		}
	});
})
/*
let login = document.getElementById("login__button");

login.addEventListener("click", ()=>{
	$.ajax({
		url:'index.php',
		type:'POST',
		data:{
			action:'login',
            account: $('#login__account').val(),
            password: $('#login__password').val()
		},
		error: function(xhr) {
			alert('Ajax request error');
		},
		success: function(response) {
			location.reload();
		}
	});
})
window.onload = function() {
	$.ajax({
		url:'./controllers/loginCheck.php',
		error: function(xhr) {
			alert('Ajax request error');
		},
		success: function(response) {
			if( response.search('false') == -1 ) {
                nextPage(response);
			}
			else {
				console.log('test: ' + response);
			}
		}
	});	
}

let nextPage = function(response) {
    window.location.href = response;
}
*/
