$('.btn-down').click(function(){
    $('html, body').animate({scrollTop: $('.history-content').offset().top }, 500)
});
$('.urls a').click(function(){
    var target = $(this).attr('href');
    $('html, body').animate({scrollTop: $(target).offset().top - 30}, 500);
    return false;
});