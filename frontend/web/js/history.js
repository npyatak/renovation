$('.btn-down').click(function(){
    $('html, body').animate({scrollTop: $('.history-content').offset().top }, 500)
});
$('.tass_logo').attr({src:'images/Logo_TASS_white.svg'});
$('.urls a').click(function(e){
    e.preventDefault();
    var target = $(this).attr('href');
    $('html, body').animate({scrollTop: $(target).offset().top - 30}, 500);
    return false;
});