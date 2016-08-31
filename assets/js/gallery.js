/*
 WP Gallery to Slick.

 @since 1.0.0
 */
(function ($) {
    'use strict';

    var $galleries;

    function init() {

        $galleries = $('.gallery');

        if (!$galleries.length) {
            return;
        }

        $galleries.each(gallery_init);
    }

    function gallery_init() {

        $(this).slick({
            slide: '.gallery-item',
            appendArrows: $(this).find('.gallery-navigation'),
            infinite: false,
            speed: 300,
            variableWidth: true,
            prevArrow: '<button type="button" class="slick-arrow-previous" data-role="none" aria-label="Previous" role="button"><span class="fa fa-chevron-left"></span></button>',
            nextArrow: '<button type="button" class="slick-arrow-next" data-role="none" aria-label="Previous" role="button"><span class="fa fa-chevron-right"></span></button>'
        });

        $(this).on('click', '.gallery-icon', gallery_preview);
        $(this).on('click', '.gallery-preview', gallery_preview_close);
        $(this).on('click', '.gallery-preview-navigation .next', gallery_preview_next);
        $(this).on('click', '.gallery-preview-navigation .previous', gallery_preview_previous);
    }

    function gallery_preview() {

        var $preview = $(this).closest('.gallery').find('.gallery-preview'),
            url = $(this).find('a').attr('href');

        $(this).closest('.gallery-item').addClass('preview');
        $preview.show();
        $preview.append('<img src="' + url + '" />');
    }

    function gallery_preview_close() {

        $(this).find('img').remove();
        $(this).hide();
    }

    function gallery_preview_next(event) {

        event.stopPropagation();

        var $gallery = $(this).closest('.gallery');

        if ($(this).hasClass('disabled')) {
            return;
        }

        $gallery.find('.gallery-preview-navigation .previous').removeClass('disabled');

        gallery_preview_change($gallery, 'next');
    }

    function gallery_preview_previous(event) {

        event.stopPropagation();

        var $gallery = $(this).closest('.gallery');

        if ($(this).hasClass('disabled')) {
            return;
        }

        $gallery.find('.gallery-preview-navigation .next').removeClass('disabled');

        gallery_preview_change($gallery, 'previous');
    }

    function gallery_preview_change($gallery, change) {

        var $current = $gallery.find('.gallery-item.preview'),
            $next = change == 'next' ? $current.next() : $current.prev(),
            url = $next.find('a').attr('href'),
            $img = $gallery.find('.gallery-preview img'),
            max = $gallery.find('.gallery-item').length - 1;

        $current.removeClass('preview');
        $next.addClass('preview');
        $img.attr('src', url);

        // Disable
        if ((change == 'next' && $next.index() === max) || (change == 'previous' && $next.index() === 0)) {
            $gallery.find('.gallery-preview-navigation .' + change).addClass('disabled');
        }
    }

    $(init);
})(jQuery);