<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/
extract( $atts );
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );
$iconClass = isset( ${'icon_' . $type} ) ? esc_attr( ${'icon_' . $type} ) : 'fa fa-adjust';
$icon_color = $color;
if( 'custom' === $color ) {
    $icon_color = esc_attr( $custom_color );
}
// Enqueue assets
wp_enqueue_script( 'appear', plugins_url() . '/haru-pangja-core/includes/shortcodes/counter/assets/js/jquery.appear.js', false, true );
wp_enqueue_script( 'countto', plugins_url() . '/haru-pangja-core/includes/shortcodes/counter/assets/js/jquery.countTo.js', false, true );

?>
<div class="counter-shortcode-wrap <?php echo esc_attr( $layout_type . ' ' . $el_class); ?>">
    <div class="gr-counter gr-animated">
        <div class="content-inner">
            <div class="icon-wrap" style="color:<?php echo $icon_color; ?>">
                <span class="<?php echo $iconClass; ?>"></span>
            </div>
            <div data-from="0" data-to="<?php echo esc_attr($number); ?>" class="gr-number-counter">
                <?php echo esc_html($number); ?>
            </div>
            <div class="gr-text-default"><?php echo wp_kses_post($title); ?></div>
        </div>
    </div>
</div>