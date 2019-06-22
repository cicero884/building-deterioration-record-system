let FloorInfo;
let DeteriorationInfo;

const DeteriorationType = {
    'flakeDepth' : '深度',
    'flakeScrap' : '碎片',
    'crackLength': '長度',
    'crackWidth' : '寬度'
}

window.onload = ()=> {
    let id = document.getElementsByClassName("building")[0].id.substring(10);
    $.ajax({
        url:'web_ajax.php',
        type:'POST',
        data:{
            page: 'building',
            action: 'selectFloorInfo',
            buildingId: id
        },
        error: function(xhr) {
            alert(xhr);
        },
        success: function(response) {
            FloorInfo = JSON.parse( response );
        }
    })
    .done(() => {
        makeFloorBlock()
        .then(( floorIds )=> getDeterationDetail( floorIds ) );
    })
}

let makeFloorBlock = ()=> {
    let floorIds = [];
    let detailBlock = document.getElementsByClassName("detail")[0];
    let floorBlock  = document.getElementsByClassName("floor__info")[0].cloneNode(true);
    detailBlock.removeChild( document.getElementsByClassName("floor__info")[0] );

    FloorInfo.forEach( ( element )=>{
        console.log( element );
        tempBlock = floorBlock.cloneNode( true );
        tempBlock.getElementsByClassName( "floor-plan__title" )[0].innerHTML = element.floor;
        tempBlock.getElementsByClassName( "deterioration__table" )[0].id = "table__" + element.floorId;
        detailBlock.appendChild( tempBlock );
        floorIds.push(element.floorId);
    } )

    return new Promise((resolve, reject) => {
        if( floorIds == null )
            reject( null );
        else
            resolve( floorIds );
    })
}

let getDeterationDetail = ( floorIds )=>{
    floorIds.forEach( ( id, index )=>{
        $.ajax({
            url:'web_ajax.php',
            type:'POST',
            data:{
                page: 'building',
                action: 'selectDeteriorationInfo',
                floorId: id
            },
            error: function(xhr) {
                alert(xhr);
            },
            success: function(response) {
                DeteriorationInfo = JSON.parse( response );
            }
        })
        .done(() => {
            makeDeteriorationTable( id )
            .then( ()=>{
                setFloorImage( index );
            } );
        })
    } )
}

let makeDeteriorationTable = ( id )=> {
    console.log(id);
    let table = document.getElementById( "table__" + id  );
    return new Promise ((resolve) => {
        DeteriorationInfo.forEach( ( element, index ) => {
            let row = table.insertRow( index + 1 );
            let cell = [];
            let tempElement;
            for( let i = 0; i < 7; ++i ) 
                cell[i] = row.insertCell(i);
            // column for number
            cell[0].innerHTML = index + 1;
            cell[0].classList.add("td__number");

            // column for position
            cell[1].innerHTML = element.position;
            cell[1].classList.add("td__position");

            // column for flake
            cell[2].classList.add("td__flake");
            cell[2].appendChild( deteriorationItem('flakeDepth', element.flakeDepth ) );
            cell[2].appendChild( deteriorationItem('flakeScrap', element.flakeScrap ) );

            // column for crack
            cell[3].classList.add("td__crack");
            cell[3].appendChild( deteriorationItem('crackLength', element.crackLength ) );
            cell[3].appendChild( deteriorationItem('crackWidth', element.crackWidth ) );

            // column for pc
            cell[4].classList.add("td__rc");
            cell[4].appendChild( deteriorationItem('RC', element.RC ) );

            // column for addon
            cell[5].classList.add("td__add-on");
            cell[5].appendChild( deteriorationItem('addOn', element.addOn ) );

            // column for image
            cell[6].classList.add("td__image");
            tempElement = document.createElement("img");
            tempElement.src = "img";
            tempElement.addEventListener( "click", ()=>{
                $(this).lightGallery({
                    dynamic: true,
                    dynamicEl: [{
                        "src": element.image1,
                        'thumb': element.image1,
                        'subHtml': '<h4>遠</h4>'
                    }, {
                        'src': element.image2,
                        'thumb': element.image2,
                        'subHtml': "<h4>近</h4>"
                    }, {
                        'src': element.image3,
                        'thumb': element.image3,
                        'subHtml': "<h4>其他</h4>"
                    }, {
                        'src': element.image4,
                        'thumb': element.image4,
                        'subHtml': "<h4>其他</h4>"
                    }]
                })
            } )
            cell[6].appendChild( tempElement );
        })
        resolve( id );
    })

}

let deteriorationItem = ( type, value ) => {
    let tempElement = document.createElement("p");
    tempElement.classList.add("flake__item");
    if( type.search( "flake" ) != -1 || type.search( "crack" ) != -1 ) {
        if( value == 1 ) {
            tempElement.innerHTML = DeteriorationType[type] + " > 2.5cm";
            tempElement.classList.add("serious");
        }
        else
            tempElement.innerHTML = DeteriorationType[type] + " < 2.5cm";
    }
    else {
        if( value == 1 ) {
            tempElement.innerHTML = "O";
            tempElement.classList.add("serious");
        }
        else
            tempElement.innerHTML = "X";
    }

    return tempElement;
}

let setFloorImage = ( index )=> {
    let floorBlock = document.getElementsByClassName( "floor__info" )[ index ];
    let floorImage = floorBlock.getElementsByClassName("floor-plan__image")[0];
    floorImage.src = FloorInfo[index].picture;
};

