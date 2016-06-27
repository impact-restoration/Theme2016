/*
 Functionality for the home page service selector.

 @since {{VERSION}}
 */
(function ($) {
    'use strict';

    var $service_lists,
        animation_delay = 2000;

    function init() {

        var $service_lists = $('.services-list');

        if (!$service_lists.length) {
            return;
        }


        $service_lists.each(service_list_init);
    }

    function service_list_init() {

        var $list = $(this);

        $(window).scroll(function () {
            service_list_scroll($list);
        });

        $(function () {
            service_list_scroll($list);
        });
    }

    function service_list_scroll($list) {

        if (!$list.hasClass('shown') && $(window).scrollTop() + ($(window).height() * 0.75) > $list.offset().top) {
            service_list_show($list);
            $list.addClass('shown');
        }
    }

    function service_list_show($list) {

        var $line = $list.find('.services-list-line'),
            $rows = $list.find('.services-row'),
            rows = $rows.length;

        $list.addClass('in-view');

        $rows.each(function () {

            var $row = $(this),
                $items = $row.find('.services-row-item'),
                row_delay = $(this).index() * (animation_delay / rows),
                item_delay = row_delay + ((animation_delay / rows) / 2);

            setTimeout(function () {
                $row.addClass('in-view');
                $items.first().addClass('in-view');
            }, row_delay);

            setTimeout(function () {
                $items.last().addClass('in-view');
            }, item_delay);
        });
    }

    $(init);
})(jQuery);