$(window).on('load', function () {
    var bodyLoad = new TimelineMax({
        paused: true,
        reversed: true
    });

    bodyLoad.staggerTo('[data-animate]', .35, {
        opacity: '1',
        y: '0',
    }, 0.075);

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

$(window).bind("pageshow", function(event) {
    if (event.originalEvent.persisted) {
        window.location.reload() 
    }
});

$(document).ready(function () {
    // InstantClick.init();

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