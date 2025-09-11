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

if ( ! class_exists('Haru_Framework_Shortcode_Progress_Bar') ) {
    class Haru_Framework_Shortcode_Progress_Bar {
        function __construct() {
            add_shortcode( 'haru_progress_bar', array($this, 'haru_progress_bar_shortcode') );
            add_action( 'vc_before_init', array($this, 'haru_progress_bar_vc_map') );
        }

        function haru_progress_bar_shortcode($atts) {
            $atts = vc_map_get_attributes( 'haru_progress_bar', $atts );
            $values = $layout_type = $units = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'values'        => '',
                'layout_type'   => 'style_1',
                'units'         => '%',
                'el_class'      => '',
                'css_animation' => '',
                'duration'      => '',
                'delay'         => '',
            ), $atts));

            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();

            ?>
            <div class="<?php echo esc_attr($haru_animation . ' ' . $styles_animation); ?>">
                <?php echo haru_get_template('progress-bar/'. $layout_type . '.php', array('atts' => $atts), '', '' ); ?>
            </div>
        <?php
            $content =  ob_get_clean();
            return $content;         
        }

        function haru_progress_bar_vc_map() {
            vc_map(
                array(
                    'name'        => esc_html__( 'Haru Progress Bar', 'haru-pangja' ),
                    'base'        => 'haru_progress_bar',
                    'icon'        => 'fa fa-info haru-vc-icon',
                    'description' => esc_html__( 'Display Progress Bar', 'haru-pangja' ),
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'params'      => array(
                        array(
                            'type'        => 'param_group',
                            'heading'     => esc_html__( 'Values', 'haru-pangja' ),
                            'param_name'  => 'values',
                            'description' => esc_html__( 'Enter values for bars.', 'haru-pangja' ),
                            'value'       => urlencode( json_encode( array(
                                array(
                                    'name' => esc_html__( 'Themeforest', 'haru-pangja' ),
                                    'value' => '',
                                ),
                                array(
                                    'name'  => esc_html__( 'Codecanyon', 'haru-pangja' ),
                                    'value' => '',
                                ),
                                array(
                                    'name'  => esc_html__( 'Photodune', 'haru-pangja' ),
                                    'value' => '',
                                ),
                            ) ) ),
                            'params' => array(
                                array(
                                    'type'        => 'textfield',
                                    'heading'     => esc_html__( 'Label', 'haru-pangja' ),
                                    'param_name'  => 'name',
                                    'description' => esc_html__( 'Enter label of bar.', 'haru-pangja' ),
                                    'admin_label' => true,
                                ),
                                array(
                                    'type'        => 'textfield',
                                    'heading'     => esc_html__( 'Value', 'haru-pangja' ),
                                    'param_name'  => 'value',
                                    'description' => esc_html__( 'Enter value of bar.', 'haru-pangja' ),
                                    'admin_label' => true,
                                ),
                            ),
                        ),
                        array(
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Layout Style', 'haru-pangja' ),
                            'param_name' => 'layout_type',
                            'value'      => array(
                                esc_html__( 'Style 1 (Line)', 'haru-pangja' ) => 'style_1',
                                esc_html__( 'Style 2 (Circle)', 'haru-pangja' ) => 'style_2',
                            ),
                            'admin_label' => true,
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array( 
                            'param_name'  => 'units', 
                            'heading'     => esc_html__( 'Units', 'haru-pangja' ), 
                            'type'        => 'textfield',
                            'value'       => '%',
                            'admin_label' => true,
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
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

    new Haru_Framework_Shortcode_Progress_Bar();
}