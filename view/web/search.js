
function myFunction( pc, flake, crack ) {
	$.ajax({
		url:'../../web.php',
		type:'POST',
		data:{
			action: 'select',
      		pc:      pc,
      		flake:   flake,
      		crack:   crack,
		},
		error: function(xhr) {
			alert('Ajax request error');
		},
		success: function(response){
			console.log(response);
		}
		
	});
}

let submitButton = document.getElementById("submit");
submitButton.addEventListener("click", ()=>{
	let pc = 0;
	let flake = 0;
	let crack = 0;

	if( document.getElementById("pc").checked )
		pc = 1;
	if( document.getElementById("flake").checked )
		flake = 1;
	if( document.getElementById("crack").checked )
		crack = 1;
	
  	myFunction(pc, flake, crack);
})
