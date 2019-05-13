function getAbsolutePos(element) {
    var top = 0, left = 0;
    do {
        top += element.offsetTop  || 0;
        left += element.offsetLeft || 0;
		do{
			element = element.offsetParent;
		}while(element&&element.classList.contains('is-selected'))
    } while(element);

    return {
        top: top,
        left: left
    };
};
