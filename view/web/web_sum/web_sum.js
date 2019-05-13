let submitButton = document.getElementById("form__submit");
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
	selectBuilding( pc, flake, crack );
})


function selectBuilding( pc, flake, crack ) {
	$.ajax({
		url:'web_ajax.php',
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
			makeTable( response );
		}
		
	});
}

function makeTable( items ) {
	let table = document.getElementById("table");
	content = JSON.parse( items );

	content.forEach(( item ) => {
		let row = table.insertRow(2);
		row.insertCell(0).innerHTML = item.buildingId;
		row.insertCell(1).innerHTML = item.address;
		row.insertCell(2).innerHTML = item.name;
		row.insertCell(3).innerHTML = item.phone;
		row.insertCell(4).innerHTML = item.date.substring(0, 10);
		row.insertCell(5).innerHTML = "口";
	});
}
