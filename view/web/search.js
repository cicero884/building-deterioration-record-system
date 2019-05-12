
function myFunction() {
	$.ajax({
		url:'ajax.php',
		type:'GET',
		data:{
      pc: document.getElementById("pc").checked(),
      flake: document.getElementById("flake").checked(),
      crack: document.getElementById("crack").checked(),
      addon: document.getElementById("addon").checked(),
      month: document.getElementById("month").checked(),
      dmonth: document.getElementById("dmonth").checked(),
      year: document.getElementById("year").checked()
		},
		error: function(xhr) {
			alert('Ajax request error');
		},
	});
}

let submitButton = document.getElementById("submit");
submitButton.addEventListener("click", ()=>{
  myFunction();
})
