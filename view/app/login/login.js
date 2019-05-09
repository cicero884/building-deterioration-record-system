let login = document.getElementById("login__button");
let errorMessage = document.getElementById("error__message");

login.addEventListener("click", ()=>{
    errorMessage.classList.remove("error__message--show");
	$.ajax({
		url:'../../../controllers/login.php',
		type:'POST',
		data:{
            account: $('#login__account').val(),
            password: $('#login__password').val()
		},
		error: function(xhr) {
			alert('Ajax request error');
		},
		success: function(response) {
			if( response.search('false') != -1 ) {
                errorMessage.classList.add("error__message--show");
            }
            else {
				nextPage();
            }
		}
	});
})

window.onload = function() {
	$.ajax({
		url:'../../../controllers/loginCheck.php',
		error: function(xhr) {
			alert('Ajax request error');
		},
		success: function(response) {
			if( response.search('success') != -1 ) {
                nextPage();
			}
			else {
				console.log('test: ' + response);
			}
		}
	});	
}

let nextPage = function() {
    window.alert('next page');
}