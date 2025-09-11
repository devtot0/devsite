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

if ( ! class_exists('Haru_Framework_Shortcode_Countdown') ) {
    class Haru_Framework_Shortcode_Countdown {
        function __construct() {
            add_shortcode( 'haru_countdown', array($this, 'haru_countdown_shortcode') );
            add_action( 'vc_before_init', array($this, 'haru_countdown_vc_map') );
        }

        function haru_countdown_shortcode($atts) {
            $atts        = vc_map_get_attributes( 'haru_countdown', $atts );
            $layout_type =  $datetime = $align = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'layout_type'   => '',
                'datetime'      => '',
                'align'      => '',
                'el_class'      => '',
                'css_animation' => '',
                'duration'      => '',
                'delay'         => '',
            ), $atts));
	           
            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();

            ?>
            <?php if( $datetime != '' ) : ?>
            <div class="<?php echo esc_attr($haru_animation . ' ' . $styles_animation); ?>">
                <?php echo haru_get_template('countdown/'. $layout_type . '.php', array('atts' => $atts), '', '' ); ?>
            </div>
            <?php else : ?>
                <div class="datetime-not-select"><?php echo esc_html__( 'Please select datetime!', 'haru-pangja' ); ?></div>
            <?php endif; ?>
        <?php
            $content = ob_get_clean();
            return $content;         
        }

        function haru_countdown_vc_map() {
            vc_map(
                array(
                    'name'        => esc_html__( 'Haru Countdown', 'haru-pangja' ),
                    'base'        => 'haru_countdown',
                    'icon'        => 'fa fa-clock-o haru-vc-icon',
                    'description' => esc_html__( 'Display Countdown timer', 'haru-pangja' ),
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'params'      => array(
                        array(
                            'param_name'  => 'datetime',
                            'type'        => 'haru_datetime',
                            'heading'     => esc_html__( 'Select Datetime', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => ''
                        ),
                        array(
                            'param_name'  => 'layout_type',
                            'heading'     => esc_html__( 'Choose layout', 'haru-pangja' ),
                            'description' => '',
                            'type'        => 'dropdown',
                            'value'       => array(
                                esc_html__( 'Number', 'haru-pangja' )   => 'number',
                                esc_html__( 'Pangja', 'haru-pangja' )   => 'circle'
                            )
                        ),
                        array(
                            'param_name'  => 'align',
                            'heading'     => esc_html__( 'Choose layout', 'haru-pangja' ),
                            'description' => '',
                            'type'        => 'dropdown',
                            'value'       => array(
                                esc_html__( 'Center', 'haru-pangja' )   => 'text-center',
                                esc_html__( 'Left', 'haru-pangja' )   => 'text-left',
                                esc_html__( 'Right', 'haru-pangja' )   => 'text-right'
                            ),
                            'dependency'  => array(
                                'element' => 'layout_type', 
                                'value'   => array('number')
                            ),
                        ),
                        Haru_PangjaCore_Shortcodes::add_css_animation(),
                        Haru_PangjaCore_Shortcodes::add_duration_animation(),
                        Haru_PangjaCore_Shortcodes::add_delay_animation(),
                        Haru_PangjaCore_Shortcodes::add_el_class()
                    )
                )
            );
        }
    }

    new Haru_Framework_Shortcode_Countdown();
}