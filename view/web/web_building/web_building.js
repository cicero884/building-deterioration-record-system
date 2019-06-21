let floorInfo;

window.onload = ()=> {
    let id = document.getElementsByClassName("building")[0].id.substring(10);
    $.ajax({
        url:'web_ajax.php',
        type:'POST',
        data:{
            page: 'building',
            action: 'selectFloorImage',
            buildingId: id
        },
        error: function(xhr) {
            alert(xhr);
        },
        success: function(response) {
            floorInfo = JSON.parse( response );
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

    floorInfo.forEach( (element)=>{
        console.log( element );
        tempBlock = floorBlock.cloneNode( true );
        tempBlock.getElementsByClassName( "floor-plan__title" )[0].innerHTML = element.floor;
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

let getDeterationDetail = (floorIds)=>{
    console.log(floorIds);
}