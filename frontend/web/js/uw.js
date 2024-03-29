$(window).on('load', function(){
// $(document).ready(function(){
	$('#preloader').fadeOut(1000);
	if ($('.slider_gallery').length > 0) {
		$(".slider_gallery").owlCarousel({
			items: 1,
			loop: true
		});
	}

	if ($('.slider_front').length > 0) {
		$(".slider_front").owlCarousel({
			items: 1,
			loop: true,
			nav: true
		});
	}

	$('.grid_front').masonry({
		itemSelector: '.grid_item'
	});
	
	$(window).resize(function () {
		if($(this).width() > 1000){
			$('.grid').masonry({
				itemSelector: '.grid_item',
			});
		}
	});
	$(window).trigger('resize');
	$(".gallery_inline").colorbox({
		inline:true,
		width:"66%",
		onOpen: function(){
			$('#popup .popup_img').html($.colorbox.element().html());
			$('#popup .popup_text').html($.colorbox.element().parent().find('p').html());
		}
	});
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
	$('.open-menu-btn,.close-menu__btn').on('click', function(){
		$('.open-menu-btn,.close-menu__btn').toggleClass('show');
		$('.header ul').toggleClass('show');
	});
	if ($(window).width() < 999) {
		$('.header ul').css('height',($(window).height()-$('.header').height()))
	} else {
		$('.header ul').css('height','initial');
	}
	if ($('.slider_history .item').length > 0) {
		$(".slider_history").owlCarousel({
			items: 1,
			loop: false,
			nav: false,
			dots: true
		});
	}
	if ($('.slider_history2 .item').length > 0) {
		$(".slider_history2").owlCarousel({
			loop: false,
			nav: false,
			dots: true,
			responsive: {
				0:{items:1}
			}
		});
	}

	var wow = new WOW(
		{
			boxClass: 'wow',      // animated element css class (default is wow)
			animateClass: 'animated', // animation css class (default is animated)
			offset: 300,          // distance to the element when triggering the animation (default is 0)
			mobile: false,       // trigger animations on mobile devices (default is true)
			live: true,       // act on asynchronously loaded content (default is true)
			callback: function (box) {
				$(box).addClass('wow_vis');
			},
			scrollContainer: null // optional scroll container selector, otherwise use window
		}
	);
	wow.init();

});
$(window).resize(function(){
	if ($(window).width() < 999) {
		$('.header ul').css('height',($(window).height()-$('.header').height()))
	} else {
		$('.header ul').css('height','initial');
	}
});

$('.social a, .social-wrap a, .np-social a').click(function(e) {
    var url = getShareUrl($(this));
    window.open(url,'','toolbar=0,status=0,width=626,height=436');
    return false;
});


function getShareUrl(obj) {
    if(obj.data('type') == 'vk') {
        url  = 'http://vkontakte.ru/share.php?';
        url += 'url='          + encodeURIComponent(obj.data('url'));
        url += '&title='       + encodeURIComponent(obj.data('title'));
        url += '&text=' 	   + encodeURIComponent(obj.data('desc'));
        url += '&image='       + encodeURIComponent(obj.data('image'));
        url += '&noparse=true';
    } else if(obj.data('type') == 'fb') {
        url  = 'http://www.facebook.com/sharer.php?s=100';
        url += '&p[title]='     + encodeURIComponent(obj.data('title'));
        url += '&p[url]='       + encodeURIComponent(obj.data('url'));
        url += '&p[images][0]=' + encodeURIComponent(obj.data('image'));
        url += '&p[summary]='   + encodeURIComponent(obj.data('desc'));
    } else if(obj.data('type') == 'ok') {
		url  = 'http://www.ok.ru/dk?st.cmd=addShare&st.s=1';
		url += '&st.comments='  + encodeURIComponent(obj.data('desc'));
		url += '&st._surl='     + encodeURIComponent(obj.data('url'));
	} else if(obj.data('type') == 'tw') {
		url  = 'http://twitter.com/share?';
		url += 'text='      + encodeURIComponent(obj.data('title'));
		url += '&url='      + encodeURIComponent(obj.data('url'));
		url += '&counturl=' + encodeURIComponent(obj.data('url'));
	}

    return url;
}