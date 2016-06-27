/*
 Functionality for the home page service selector.

 @since {{VERSION}}
 */
(function ($) {
    'use strict';

    var $services_container, $services, $service_selectors, auto_change;

    function init() {

        $services_container = $('.home-services');

        if (!$services_container.length) {
            return;
        }

        $services = $services_container.find('.services .service');
        $service_selectors = $services_container.find('.service-selector a');

        $services_container.find('.service-selector a').click(select_service);

        set_interval();
    }

    function set_interval() {
        auto_change = setInterval(service_auto_change, 6000);
    }

    function select_service(e) {

        clearInterval(auto_change);
        set_interval();

        change_service($(this).attr('href'));

        e.preventDefault();
        return false;
    }

    function change_service(selector) {

        var $service = $(selector),
            color = $service.attr('data-color');

        $services_container.css('background-color', color);

        $service_selectors.removeClass('active');
        //$service_selectors.filter('[href="' + selector + '"]').addClass('active');
        $service_selectors.filter('[href="' + selector + '"]').addClass('active');

        $services.removeClass('active');
        $service.addClass('active');
    }

    function service_auto_change() {

        var $active_service = $service_selectors.filter('.active'),
            $next = $active_service.next();

        if (!$next.length) {

            $next = $service_selectors.first();

        } else if (!$next.attr('href')) {

            // Skip clearfix
            $next = $next.next();
        }

        change_service($next.attr('href'));
    }

    $(init);
})(jQuery);