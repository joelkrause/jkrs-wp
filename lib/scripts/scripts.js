$(window).on('scroll', function () {
    var scrollPos = $(window).scrollTop();
    var logo = $('.site__header-logo');
    
    if (scrollPos > 10) {
        logo.addClass('small');
    } else if (scrollPos < 10) {
        logo.removeClass('small');
    }
});

$(document).ready(function () {
    InstantClick.init();

    var typingTimer;
    var doneTypingInterval = 500;
    var input = $('#post_search');

    input.keyup(function () {
        const val = $('#post_search').val();
        clearTimeout(typingTimer);
        if (input.val()) {
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        }

        function doneTyping() {
            $.ajax({
                type: "POST",
                url: ajax_postajax.ajaxurl,
                data: {
                    action: 'getPosts',
                    keywords: val,
                },
                success: function (response) {
                    console.log(response);
                }
            });
        }
    });

})