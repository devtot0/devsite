<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

if ( ! defined( 'ABSPATH' ) ) die( '-1' );

if ( ! class_exists('Haru_Framework_Shortcode_Widget') ) {
    class Haru_Framework_Shortcode_Widget {
        function __construct() {
            add_shortcode( 'haru_widget', array($this, 'haru_widget_shortcode') );
            add_action( 'vc_before_init', array($this, 'haru_widget_vc_map') );
        }

        function haru_widget_shortcode($atts) {
            $atts       = vc_map_get_attributes( 'haru_widget', $atts );
            $sidebar_id = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'sidebar_id'    => '',
                'el_class'      => '',
                'css_animation' => '',
                'duration'      => '',
                'delay'         => '',
            ), $atts));
	           
            $haru_animation   .= $el_class;
            $haru_animation   .= HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();

            ?>
            <?php if( $sidebar_id != '' ) : ?>
            <div class="<?php echo esc_attr($haru_animation . ' ' . $styles_animation); ?>">
                <?php echo haru_get_template('widget/widget.php', array('atts' => $atts), '', '' ); ?>
            </div>
            <?php else : ?>
                <div class="widget-not-select"><?php echo esc_html__( 'Please select Widget!', 'haru-pangja' ); ?></div>
            <?php endif; ?>
        <?php
            $content =  ob_get_clean();
            return $content;         
        }

        function haru_widget_vc_map() {
            vc_map(
                array(
                    'name'        => esc_html__( 'Haru Widget', 'haru-pangja' ),
                    'base'        => 'haru_widget',
                    'class'       => 'haru_widget',
                    'icon'        => 'fa fa-align-justify haru-vc-icon',
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'description' => esc_html__( 'Display widgets.', 'haru-pangja' ),
                    'params'      => array(
                        array(
                            'type'        => 'widgetised_sidebars',
                            'heading'     => esc_html__( 'Sidebar', 'haru-pangja' ),
                            'param_name'  => 'sidebar_id',
                            'description' => esc_html__( 'Select widget area to display.', 'haru-pangja' ),
                            'admin_label' => true,
                        ),
                        Haru_PangjaCore_Shortcodes::add_css_animation(),
                        Haru_PangjaCore_Shortcodes::add_duration_animation(),
                        Haru_PangjaCore_Shortcodes::add_delay_animation(),
                        Haru_PangjaCore_Shortcodes::add_el_class()
                    ),
                )
            );
        }
    }

    new Haru_Framework_Shortcode_Widget();
}