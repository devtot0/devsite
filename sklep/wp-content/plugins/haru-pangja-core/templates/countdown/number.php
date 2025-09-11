<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/
extract( $atts );

$time_id = uniqid();
// Enqueue assets
wp_enqueue_script( 'countdown-number', plugins_url() . '/haru-pangja-core/includes/shortcodes/countdown/assets/js/jquery.countdown.js', false, true );

?>
<div class="countdown-shortcode-wrap <?php echo esc_attr( $layout_type . ' ' . $align . ' ' . $el_class ); ?> clearfix">
	<div id="countdown-content-<?php echo esc_attr( $time_id ); ?>" class="countdown-content"></div>
</div>
<script type="text/javascript">
    !function($) {
        $(document).ready(function() {
            // More details here: http://hilios.github.io/jQuery.countdown/
            var days    = "<?php echo esc_html__( 'Days', 'haru-pangja' ); ?>";
            var hours   = "<?php echo esc_html__( 'Hours', 'haru-pangja' ); ?>";
            var minutes = "<?php echo esc_html__( 'Mins', 'haru-pangja' ); ?>";
            var seconds = "<?php echo esc_html__( 'Secs', 'haru-pangja' ); ?>";
            $("#countdown-content-<?php echo $time_id; ?>").countdown("<?php echo $datetime;?>", function(event) {
                $(this).html(
                    event.strftime('<ul class="list-time"><li class="cd-days"><p class="countdown-number">%D</p> <p class="countdown-text">' + days + '</p></li> <li class="cd-hours"><p class="countdown-number">%H</p><p class="countdown-text">' + hours + '</p></li> <li class="cd-minutes"><p class="countdown-number">%M</p><p class="countdown-text">' + minutes + '</p></li> <li  class="cd-seconds"> <p class="countdown-number">%S</p><p class="countdown-text">' + seconds + '</p></li></ul>')
                );
            });
        });
    }(jQuery);
</script>