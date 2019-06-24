/*var $carousel = $('.content').flickity({
    cellSelector: '.page',
    prevNextButtons: false,
});
*/
var flky=new Flickity( '.content', {
	cellSelector: ".page",
	prevNextButtons: false,
	draggable: '>1',
});
