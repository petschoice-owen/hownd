jQuery(function ($) {
    $('body').on('click', '.hownd-faq__sidebar a', function(e) {
        e.preventDefault();
        var id = $(this).attr('href');

        $('html, body').animate({
            scrollTop: $(id).offset().top - 90
        }, 100);
    });
});