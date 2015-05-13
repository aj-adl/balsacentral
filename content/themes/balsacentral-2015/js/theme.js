/* Toggle/FAQ
 ---------------------------------------------------------- */
if (typeof window['vc_toggleBehaviour'] !== 'function') {
    window.vc_toggleBehaviour = function($el) {
        var event = function(e) {
            e && e.preventDefault && e.preventDefault();
            var title = jQuery(this);
            var element = title.closest('.vc_toggle');
            var content = element.find('.vc_toggle_content');
            if (element.hasClass('vc_toggle_active')) {
                content.slideUp({
                    duration: 300,
                    complete: function () {
                        element.removeClass('vc_toggle_active');
                    }
                });
            } else {
                content.slideDown({
                    duration: 300,
                    complete: function () {
                        element.addClass('vc_toggle_active');
                    }
                });
            }
        };
        if($el) {
            if($el.hasClass('vc_toggle_title')) {
                $el.unbind('click').click(event);
            } else {
                $el.find(".vc_toggle_title").unbind('click').click(event);
            }
        } else {
            jQuery(".vc_toggle_title").unbind('click').on('click', event);
        }
    }
}

jQuery(document).ready(function ($) {
    window.vc_toggleBehaviour();
});