/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

(function($){
    "use strict";
    var AdminFramework = {
        initialize: function() {
            AdminFramework.process_post_format();
            AdminFramework.datetime_picker();
            AdminFramework.haru_media_init();
        },
        process_post_format: function () {
            var prefix  = 'haru_portfolio';
            var $cbxPostFormats = $( 'input[name=haru_portfolio_media_type]' );
            var $meta_boxes = $('[id^="'+ prefix +'meta_box_post_format_"]').hide();

            $cbxPostFormats.change(function() {
                $meta_boxes.hide();
                $('#' + prefix +  'meta_box_post_format_' + $( this ).val()).show();
            });

            $cbxPostFormats.filter( ':checked' ).trigger( 'change' );

            $( 'body' ).on( 'change', '.checkbox-toggle input', function()
            {
                var $this = $( this ),
                    $toggle = $this.closest( '.checkbox-toggle' ),
                    action;
                if ( !$toggle.hasClass( 'reverse' ) )
                    action = $this.is( ':checked' ) ? 'slideDown' : 'slideUp';
                else
                    action = $this.is( ':checked' ) ? 'slideUp' : 'slideDown';

                $toggle.next()[action]();
            } );
            $( '.checkbox-toggle input' ).trigger( 'change' );
        },
        datetime_picker: function() { // Countdown select time
            if( $('#datetimepicker').length != 0 ) {
                $('#datetimepicker').datetimepicker({
                    format:'Y/m/d H:i',
                    minDate: '0'
                });
            }
        },
        haru_media_init: function(text_selector, button_selector, wrapper_selector) {
            var clicked_button = false;
            var input_text = null;
            if (typeof(wrapper_selector) == 'undefined') {
                input_text = jQuery(text_selector);
            }
            else {
                input_text = jQuery(text_selector, wrapper_selector);
            }

            jQuery(input_text).each(function (i, input) {
                var button = null;
                if (typeof(wrapper_selector) == 'undefined') {
                    button = jQuery(input).next(button_selector);
                }
                else {
                    button = jQuery(button_selector, wrapper_selector);
                }
                button.click(function (event) {
                    event.preventDefault();
                    var selected_img;

                    // check for media manager instance
                    if(wp.media.frames.gk_frame) {
                        wp.media.frames.gk_frame.open();
                        wp.media.frames.gk_frame.clicked_button = jQuery(this);
                        return;
                    }

                    // configuration of the media manager new instance
                    wp.media.frames.gk_frame = wp.media({
                        title: 'Select image',
                        multiple: false,
                        library: {
                            type: 'image'
                        },
                        button: {
                            text: 'Use selected image'
                        }
                    });
                    wp.media.frames.gk_frame.clicked_button = jQuery(this);
                    // Function used for the image selection and media manager closing
                    var gk_media_set_image = function() {
                        var selection = wp.media.frames.gk_frame.state().get('selection');

                        // no selection
                        if (!selection) {
                            return;
                        }

                        // iterate through selected elements
                        selection.each(function(attachment) {
                            var url = attachment.attributes.url;
                            wp.media.frames.gk_frame.clicked_button.prev(input_text).val(url);
                        });
                    };

                    // closing event for media manger
                    //wp.media.frames.gk_frame.on('close', gk_media_set_image);
                    // image selection event
                    wp.media.frames.gk_frame.on('select', gk_media_set_image);
                    // showing media manager
                    wp.media.frames.gk_frame.open();
                });
            });

        }
    };
    $(document).ready(function() {
        AdminFramework.initialize();
    });
})(jQuery);