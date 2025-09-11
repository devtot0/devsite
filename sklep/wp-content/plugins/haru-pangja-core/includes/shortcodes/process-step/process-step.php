<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

if ( ! defined( 'ABSPATH' ) ) die( '-1' );

if ( ! class_exists('Haru_Framework_Shortcode_Process_Step') ) {
    class Haru_Framework_Shortcode_Process_Step {
        function __construct() {
            add_shortcode( 'haru_process_step', array( $this, 'haru_process_step_shortcode' ) );
            add_action( 'vc_before_init', array($this, 'haru_process_step_vc_map') );
        }

        function haru_process_step_shortcode( $atts ) {
            $atts        = vc_map_get_attributes( 'haru_process_step', $atts );
            $layout_type = $step_style = $title = $description = $number = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'layout_type'      => 'style_1',
                'step_style'       => 'step_style',
                'title'            => 'This is title.',
                'description'      => '',
                'number'           => '123',
                'el_class'         => '',
                'css_animation'    => '',
                'duration'         => '',
                'delay'            => '',
            ), $atts));

            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();
            
        ?>
        <?php if ( $number != '' ) : ?>
            <div class="<?php echo esc_attr($haru_animation . ' ' . $styles_animation); ?>">
                <?php echo haru_get_template('process-step/'. $layout_type . '.php', array('atts' => $atts), '', '' ); ?>
            </div>
        <?php else : ?>
            <div class="item-not-found"><?php echo esc_html__( 'Please insert step number!', 'haru-pangja' ) ?></div>
        <?php endif; ?>
        <?php
            $content =  ob_get_clean();
            return $content;
        }

        function haru_process_step_vc_map() {
            vc_map(
                array(
                    'name'        => esc_html__('Haru Process Step', 'haru-pangja'),
                    'base'        => 'haru_process_step',
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'icon'        => 'fa fa-tachometer haru-vc-icon',
                    'description' => esc_html__( 'Display Process Step', 'haru-pangja' ),
                    'params'      =>  array(
                        array(
                            'param_name'  => 'layout_type',
                            'heading'     => esc_html__( 'Style', 'haru-pangja' ),
                            'description' => 'Select layout for display step.',
                            'type'        => 'dropdown',
                            'admin_label' => true,
                            'value'       => array(
                                esc_html__( 'Style 1 ( No Icon)', 'haru-pangja' ) =>  'style_1',
                            )
                        ),
                        array(
                            'param_name'  => 'step_style',
                            'heading'     => esc_html__( 'Step Style', 'haru-pangja' ),
                            'description' => 'Select style for display step.',
                            'type'        => 'dropdown',
                            'admin_label' => true,
                            'value'       => array(
                                esc_html__( 'Style 1 (Odd Step)', 'haru-pangja' ) =>  'odd',
                                esc_html__( 'Style 2 (Even Step)', 'haru-pangja' ) =>  'even',
                                esc_html__( 'Style 3 (Last Step)', 'haru-pangja' ) =>  'last',
                            )
                        ),
                        array(
                            'type'        =>  'textfield',
                            'heading'     =>  esc_html__( 'Number of Step', 'haru-pangja' ),
                            'description' => 'Enter number of step. Example 1.',
                            'param_name'  =>  'number',
                            'value'       =>  '123',
                            'admin_label' => true,
                        ),
                        array(
                            'type'        =>  'textfield',
                            'heading'     =>  esc_html__( 'Title', 'haru-pangja' ),
                            'description' =>  'Enter text for step title',
                            'param_name'  =>  'title',
                            'value'       =>  'This is title.',
                            'dependency'  => array(
                                'element' => 'layout_type', 
                                'value'   => array('style_1')
                            ),
                        ),
                        array(
                            'type'        =>  'textarea',
                            'heading'     =>  esc_html__( 'Description', 'haru-pangja' ),
                            'description' =>  'Enter text for step description',
                            'param_name'  =>  'description',
                            'value'       =>  'This is description.',
                            'dependency'  => array(
                                'element' => 'layout_type', 
                                'value'   => array('style_1')
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

    new Haru_Framework_Shortcode_Process_Step();
}