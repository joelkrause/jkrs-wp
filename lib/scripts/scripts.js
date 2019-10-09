quicklink();

$(window).on('load', function () {
    var bodyLoad = new TimelineMax({
        paused: true,
        reversed: true
    });

    bodyLoad.staggerTo('[data-animate]', .25, {
        opacity: '1',
        y: 0,
    }, 0.055);

    bodyLoad.play();

    $('a:not([href="#"]').click(function (e) {
        e.preventDefault();
        var _link = $(this).attr('href');
        var _current = window.location.href;
        console.info(_current);
        var _duration = bodyLoad.duration() * 1000;
        if (_link != _current) {
            bodyLoad.reverse();
            setTimeout(function () {
                window.location = _link;
            }, _duration);
        }
    });
});

$(window).bind("pageshow", function (event) {
    if (event.originalEvent.persisted) {
        window.location.reload()
    }
});

$(document).ready(function () {
    _headerHeight = $('.site__header').outerHeight();
    var lastScrollTop = 0;
    $(window).on('scroll', function () {
        if ($(window).scrollTop() > _headerHeight) {
            $('body').addClass('scrolling');
        } else {
            $('body').removeClass('scrolling');
        }

        var st = $(this).scrollTop();
        if (st > lastScrollTop) {
            $('body').removeClass('scrolling-up');
        } else {
            $('body').addClass('scrolling-up');
        }
        lastScrollTop = st;
    });
    // InstantClick.init();

    var typingTimer;
    var doneTypingInterval = 500;
    var input = $('#post_search');

    input.keyup(function () {
        var val = $('#post_search').val();
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
                beforeSend: function () {
                    $('#posts ').html('');
                },
                success: function (response) {
                    setTimeout(function () {
                        $('#posts ').html(response);
                    }, 500);
                    // console.log(response);
                }
            });
        }
    });

})