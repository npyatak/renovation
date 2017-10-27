$(window).load(function(){
	if ($('.slider_gallery').length > 0) {
		$(".slider_gallery").owlCarousel({
			items: 1,
			loop: true
		});
	}
	$('.grid').masonry({
	  itemSelector: '.grid_item',
	});
	if ($('.slider_front').length > 0) {
		$(".slider_front").owlCarousel({
			items: 1,
			loop: true,
			nav: true
		});
	}
	$('.grid_front').masonry({
	  itemSelector: '.grid_item',
	});
	$(".gallery_inline").colorbox({inline:true, width:"66%"});
	$('.gallery_popup .close').click(function(){
		$.colorbox.close();
		return false;
	});
	$('body').on('click', '.bottom_gallery_video', function(){
	    var videoSRC = $(this).closest('.bottom_gallery_img').find('iframe').attr('src');
	    console.log(videoSRC);
	    console.log('111');
	    $(this).closest('.bottom_gallery_img').find('iframe').attr('src', videoSRC.split('?')[0] + '?rel=0&autoplay=1');
	    $(this).closest('.bottom_gallery_img').find('iframe').fadeIn('slow');
	    return false;
	    //$(this).parent().parent().parent().after('<div class="close-video"></div>');
	});
	$('body').on('click', '.bottom_video', function(){
	    var videoSRC = $(this).closest('.video').find('iframe').attr('src');
	    $(this).closest('.video').find('iframe').attr('src', videoSRC.split('?')[0] + '?rel=0&autoplay=1');
	    $(this).closest('.video').find('iframe').fadeIn('slow');
	    return false;
	    //$(this).parent().parent().parent().after('<div class="close-video"></div>');
	});
});