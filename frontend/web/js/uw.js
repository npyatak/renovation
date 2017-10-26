$(window).load(function(){
	if ($('.slider_gallery').length > 0) {
		$(".slider_gallery").owlCarousel({
			items: 1
		});
	}
	$('.grid').masonry({
	  itemSelector: '.grid_item',
	});
});