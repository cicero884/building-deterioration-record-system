let submitButton = document.getElementById("form__submit");
submitButton.addEventListener("click", ()=>{

	for(let i = document.getElementById("table").rows.length; i > 1;i--)
	{
		document.getElementById("table").deleteRow(i -1);
	}

	let pc = 0;
	let flake = 0;
	let crack = 0;
	let date = 0;
	let address = document.getElementById("question1").value;

	if( document.getElementById("pc").checked )
		pc = 1;
	if( document.getElementById("flake").checked )
		flake = 1;
	if( document.getElementById("crack").checked )
		crack = 1;
		
	if( $('input[name=time]:checked', '.main__form').val() !==  undefined)
		date =  $('input[name=time]:checked', '.main__form').val();
	selectBuilding( pc, flake, crack, date, address.replace(/\s/g, '') );
})


function selectBuilding( pc, flake, crack, date, address ) {
	$.ajax({
		url:'web_ajax.php',
		type:'POST',
		data:{
			page:   'sum',
      		pc:      pc,
      		flake:   flake,
			crack:   crack,
			date:    date,
			address:   address
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
	let table = document.getElementById("table").getElementsByTagName('tbody')[0];
	content = JSON.parse( items );

	document.getElementsByClassName("table_1")[0].innerHTML = "共有" + content.length + "筆";

	content.forEach(( item ) => {
		let row = table.insertRow( table.length );
		let x = document.createElement("INPUT");
		x.setAttribute("type", "checkbox");
		x.setAttribute("name", "select");
		x.setAttribute("value", item.buildingId);
		tempAddressElement = document.createElement("a");
		tempAddressElement.innerHTML = item.address;
		tempAddressElement.style.color = "rgb(0,0,0)";
		tempAddressElement.href = document.URL + "?page=web_building&buildingId=" + item.buildingId;
 		row.insertCell(0).appendChild( document.createTextNode( item.buildingId ));
		row.insertCell(1).appendChild( tempAddressElement);
		row.insertCell(2).appendChild( document.createTextNode( item.name ) );
		row.insertCell(3).appendChild( document.createTextNode( item.phone ) );
		row.insertCell(4).appendChild( document.createTextNode( item.date.substring(0,10) ) );
		row.insertCell(5).appendChild( x );
	});
}
