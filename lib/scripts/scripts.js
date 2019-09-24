$(window).on('scroll',function(){
    var scrollPos = $(window).scrollTop();
    var logo = $('.site__header-logo');

    if(scrollPos > 1){
        logo.addClass('small');
    } else if(scrollPos < 1) {
        logo.removeClass('small');
    }
});