(function ($) {
    $(function () {
        let count = 0;
        let incremental = 140;
        $('.wd_recommender .wd_left_control').click(function () {
            count -= incremental;
            if (count <= 0) {
                count = 0;
            }
            let el = $('.wd_recommender_list');
            el.animate({
                scrollLeft: count
            });
        });

        $('.wd_recommender .wd_right_control').click(function () {
            count += incremental;
            let el = $('.wd_recommender_list');
            let width = el.prop('scrollWidth') - el.prop('clientWidth');
            if (count >= width) {
                count = width;
            }
            el.animate({
                scrollLeft: count
            })
        });
    });
})(jQuery);