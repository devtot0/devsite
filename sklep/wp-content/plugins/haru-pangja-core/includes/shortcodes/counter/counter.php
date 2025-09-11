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

if ( ! class_exists('Haru_Framework_Shortcode_Counter') ) {
    class Haru_Framework_Shortcode_Counter {
        function __construct() {
            add_shortcode( 'haru_counter', array( $this, 'haru_counter_shortcode' ) );
            add_action( 'vc_before_init', array($this, 'haru_counter_vc_map') );
        }

        function haru_counter_shortcode( $atts ) {
            $atts        = vc_map_get_attributes( 'haru_counter', $atts );
            $layout_type = $type = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_simpleline
                  = $color = $custom_color = $title = $icon_image = $number = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'layout_type'      => 'style_1',
                'type'             => '',
                'icon_fontawesome' => '',
                'icon_openiconic'  => '',
                'icon_typicons'    => '',
                'icon_entypo'      => '',
                'icon_linecons'    => '',
                'icon_simpleline'  => '',
                'color'            => '',
                'custom_color'     => '', // End icon params
                'title'            => 'This is title.',
                'icon_image'       => '',
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
                <?php echo haru_get_template('counter/'. $layout_type . '.php', array('atts' => $atts), '', '' ); ?>
            </div>
        <?php else : ?>
            <div class="item-not-found"><?php echo esc_html__( 'Please insert counter number!', 'haru-pangja' ) ?></div>
        <?php endif; ?>
        <?php
            $content =  ob_get_clean();
            return $content;
        }

        function haru_counter_vc_map() {
            vc_map(
                array(
                    'name'        => esc_html__('Haru Counter', 'haru-pangja'),
                    'base'        => 'haru_counter',
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'icon'        => 'fa fa-tachometer haru-vc-icon',
                    'description' => esc_html__( 'Display Counter Statistical', 'haru-pangja' ),
                    'params'      =>  array(
                        array(
                            'param_name'  => 'layout_type',
                            'heading'     => esc_html__( 'Style', 'haru-pangja' ),
                            'description' => 'Select style for display statistical.',
                            'type'        => 'dropdown',
                            'admin_label' => true,
                            'value'       => array(
                                esc_html__( 'Style 1 ( Icon Image)', 'haru-pangja' ) =>  'style_1',
                                esc_html__( 'Style 2 ( No Icon)', 'haru-pangja' ) =>  'style_2',
                                esc_html__( 'Style 3 ( Icon Font - Home 1)', 'haru-pangja' ) =>  'style_3',
                                esc_html__( 'Style 4 ( Icon Font - Home 3)', 'haru-pangja' ) =>  'style_4',
                            )
                        ),
                        array(
                            'type'    => 'dropdown',
                            'heading' => esc_html__( 'Icon library', 'haru-pangja' ),
                            'value'   => array(
                                esc_html__( 'Font Awesome', 'haru-pangja' ) => 'fontawesome',
                                esc_html__( 'Open Iconic', 'haru-pangja' )  => 'openiconic',
                                esc_html__( 'Typicons', 'haru-pangja' )     => 'typicons',
                                esc_html__( 'Entypo', 'haru-pangja' )       => 'entypo',
                                esc_html__( 'Linecons', 'haru-pangja' )     => 'linecons',
                                esc_html__( 'Simple Line Icons', 'haru-pangja' )      => 'simpleline',
                            ),
                            'admin_label' => true,
                            'param_name'  => 'type',
                            'description' => esc_html__( 'Select icon library.', 'haru-pangja' ),
                            'dependency' => array(
                                'element' => 'layout_type',
                                'value'   => array('style_3', 'style_4')
                            ),
                        ),
                        array(
                            'type'       => 'iconpicker',
                            'heading'    => esc_html__( 'Icon', 'haru-pangja' ),
                            'param_name' => 'icon_fontawesome',
                            'value'      => 'fa fa-adjust', // default value to backend editor admin_label
                            'settings'   => array(
                                'emptyIcon'    => false,
                                // default true, display an "EMPTY" icon?
                                'iconsPerPage' => 4000,
                                // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                            ),
                            'dependency' => array(
                                'element' => 'type',
                                'value'   => 'fontawesome',
                            ),
                            'description' => esc_html__( 'Select icon from library.', 'haru-pangja' ),
                        ),
                        array(
                            'type'       => 'iconpicker',
                            'heading'    => esc_html__( 'Icon', 'haru-pangja' ),
                            'param_name' => 'icon_openiconic',
                            'value'      => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
                            'settings'   => array(
                                'emptyIcon'    => false, // default true, display an "EMPTY" icon?
                                'type'         => 'openiconic',
                                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                            ),
                            'dependency' => array(
                                'element' => 'type',
                                'value'   => 'openiconic',
                            ),
                            'description' => esc_html__( 'Select icon from library.', 'haru-pangja' ),
                        ),
                        array(
                            'type'       => 'iconpicker',
                            'heading'    => esc_html__( 'Icon', 'haru-pangja' ),
                            'param_name' => 'icon_typicons',
                            'value'      => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
                            'settings'   => array(
                                'emptyIcon'    => false, // default true, display an "EMPTY" icon?
                                'type'         => 'typicons',
                                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                            ),
                            'dependency' => array(
                                'element' => 'type',
                                'value'   => 'typicons',
                            ),
                            'description' => esc_html__( 'Select icon from library.', 'haru-pangja' ),
                        ),
                        array(
                            'type'       => 'iconpicker',
                            'heading'    => esc_html__( 'Icon', 'haru-pangja' ),
                            'param_name' => 'icon_entypo',
                            'value'      => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
                            'settings'   => array(
                                'emptyIcon'    => false, // default true, display an "EMPTY" icon?
                                'type'         => 'entypo',
                                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                            ),
                            'dependency' => array(
                                'element' => 'type',
                                'value'   => 'entypo',
                            ),
                        ),
                        array(
                            'type'       => 'iconpicker',
                            'heading'    => esc_html__( 'Icon', 'haru-pangja' ),
                            'param_name' => 'icon_linecons',
                            'value'      => 'vc_li vc_li-heart', // default value to backend editor admin_label
                            'settings'   => array(
                                'emptyIcon'    => false, // default true, display an "EMPTY" icon?
                                'type'         => 'linecons',
                                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                            ),
                            'dependency' => array(
                                'element' => 'type',
                                'value'   => 'linecons',
                            ),
                            'description' => esc_html__( 'Select icon from library.', 'haru-pangja' ),
                        ),

                        // Add new font: https://themeinjection.ticksy.com/ticket/841239/
                        array(
                            'type'       => 'iconpicker',
                            'heading'    => esc_html__( 'Icon', 'haru-pangja' ),
                            'param_name' => 'icon_simpleline',
                            'value'      => 'icon-magnifier', // default value to backend editor admin_label
                            'settings'   => array(
                                'emptyIcon'    => false, // default true, display an "EMPTY" icon?
                                'type'         => 'simpleline',
                                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                            ),
                            'dependency' => array(
                                'element' => 'type',
                                'value'   => 'simpleline',
                            ),
                            'description' => esc_html__( 'Select icon from library.', 'haru-pangja' ),
                        ),
                        array(
                            'type'               => 'dropdown',
                            'heading'            => esc_html__( 'Icon color', 'haru-pangja' ),
                            'param_name'         => 'color',
                            'value'              => array_merge( getVcShared( 'colors' ), array( esc_html__( 'Custom color', 'haru-pangja' ) => 'custom' ) ),
                            'description'        => esc_html__( 'Select icon color.', 'haru-pangja' ),
                            'param_holder_class' => 'vc_colored-dropdown',
                            'dependency' => array(
                                'element' => 'layout_type',
                                'value'   => array('style_3', 'style_4')
                            ),
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => esc_html__( 'Custom color', 'haru-pangja' ),
                            'param_name'  => 'custom_color',
                            'description' => esc_html__( 'Select custom icon color.', 'haru-pangja' ),
                            'dependency'  => array(
                                'element' => 'color',
                                'value'   => 'custom',
                                'dependency' => array(
                                    'element' => 'layout_type',
                                    'value'   => array('style_3', 'style_4')
                                ),
                            ),
                        ),
                        array(
                            'type'        =>  'textarea',
                            'heading'     =>  esc_html__( 'Title', 'haru-pangja' ),
                            'description' =>  'Enter text for counter title',
                            'param_name'  =>  'title',
                            'value'       =>  'This is title.',
                            'dependency'  => array(
                                'element' => 'layout_type', 
                                'value'   => array('style_1', 'style_2', 'style_3', 'style_4')
                            ),
                        ),
                        // Image icon
                        array(
                            'type'        => 'attach_image',
                            'heading'     => esc_html__( 'Image Icon', 'haru-pangja' ),
                            'param_name'  => 'icon_image',
                            'description' => esc_html__( 'Please select icon box\' image.', 'haru-pangja' ),
                            'admin_label' => true,
                            'dependency' => array(
                                'element' => 'layout_type',
                                'value'   => array('style_1')
                            ),
                        ),
                        array(
                            'type'        =>  'textfield',
                            'heading'     =>  esc_html__( 'Number', 'haru-pangja' ),
                            'description' => 'Enter number of statistical. Example 1466.',
                            'param_name'  =>  'number',
                            'value'       =>  '123',
                            'admin_label' => true,
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

    new Haru_Framework_Shortcode_Counter();
}