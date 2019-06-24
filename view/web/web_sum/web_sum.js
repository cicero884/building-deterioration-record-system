let submitButton = document.getElementById("form__submit");
let doc = new jsPDF();
let buildingInfo;
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

document.getElementById('download-button').addEventListener('click', ()=>{
	downloadPDF();
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
			buildingInfo = JSON.parse( response );
			makeTable( response );
		}
	})
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
		// row.insertCell(5).appendChild( x );
	});
}

let downloadPDF = ()=>{
	html2canvas(document.getElementById('table_location'))
	.then(function(canvas) {
		let contentWidth = canvas.width;
		let contentHeight = canvas.height;
	
		//一页pdf显示html页面生成的canvas高度;
		let pageHeight = contentWidth / 592.28 * 841.89;
		//未生成pdf的html页面高度
		let leftHeight = contentHeight;
		//页面偏移
		let position = 0;
		//a4纸的尺寸[595.28,841.89]，html页面生成的canvas在pdf中图片的宽高
		let imgWidth = 595.28;
		let imgHeight = 592.28/contentWidth * contentHeight;
	
		let pageData = canvas.toDataURL('image/jpeg', 1.0);
	
		let pdf = new jsPDF('', 'pt', 'a4');
	
		//有两个高度需要区分，一个是html页面的实际高度，和生成pdf的页面高度(841.89)
		//当内容未超过pdf一页显示的范围，无需分页
		if (leftHeight < pageHeight) {
			pdf.addImage(pageData, 'JPEG', 25, 10, imgWidth, imgHeight );
		} else {
			while(leftHeight > 0) {
				pdf.addImage(pageData, 'JPEG', 10, position, imgWidth, imgHeight)
				leftHeight -= pageHeight;
				position -= 841.89;
				//避免添加空白页
				if(leftHeight > 0) {
					pdf.addPage();
				}
			}
		}
	
		pdf.save('content.pdf');
	});
}
