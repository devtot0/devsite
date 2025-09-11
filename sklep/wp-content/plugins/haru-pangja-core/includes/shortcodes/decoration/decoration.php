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

if ( ! class_exists('Haru_Framework_Shortcode_Decoration') ) {
    class Haru_Framework_Shortcode_Decoration {
        function __construct() {
            add_shortcode( 'haru_decoration', array($this, 'haru_decoration_shortcode') );
            add_action( 'vc_before_init', array($this, 'haru_decoration_vc_map') );
        }

        function haru_decoration_shortcode($atts, $content) {
            $atts  = vc_map_get_attributes( 'haru_decoration', $atts );
            $layout_type = $title = $description = $image = $css = $el_class = $haru_animation = $css_animation = $duration = $delay =  '';
            extract(shortcode_atts(array(
                'layout_type'   => 'style_1',
                'title'         => '',
                'description'         => '',
                'image'     => '',
                'css'           => '',
                'el_class'      => '',
                'css_animation' => '',
                'duration'      => '',
                'delay'         => '',
            ), $atts));

            $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'haru_decoration', $atts );

            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();
            
            ?>
            <?php if( $layout_type != '' ) : ?>
            <div class="<?php echo esc_attr($css_class . ' ' . $haru_animation . ' ' . $styles_animation); ?>">
                <?php echo haru_get_template('decoration/'. $layout_type . '.php', array('atts' => $atts), '', '' ); ?>
            </div>
            <?php else : ?>
                <div class="decoration-not-select"><?php echo esc_html__( 'Please select Layout Type!', 'haru-pangja' ); ?></div>
            <?php endif; ?>
        <?php
            $content =  ob_get_clean();
            return $content;         
        }

        function haru_decoration_vc_map() {
            vc_map(
                array(
                    'name'        => esc_html__('Haru Decoration', 'haru-pangja'),
                    'base'        => 'haru_decoration',
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'icon'        => 'fa fa-header haru-vc-icon',
                    'description' => esc_html__( 'Display Decoration', 'haru-pangja' ),
                    'params'      =>  array(
                        array(
                            'param_name'  => 'layout_type',
                            'heading'     => esc_html__( 'Style', 'haru-pangja' ),
                            'description' => 'Select style for text label.',
                            'type'        => 'dropdown',
                            'value'       => array(
                                esc_html__( 'Style 1 (Home 4)', 'haru-pangja' )     =>  'style_1',
                            ),
                            'admin_label' => true,
                        ),
                        array(
                            'param_name'  => 'title',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Title', 'haru-pangja' ),
                            'description' => esc_html__( 'Enter title of Decoration.', 'haru-pangja' ),
                            'admin_label' => true,
                        ),
                        array(
                            'param_name'  => 'description',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Description', 'haru-pangja' ),
                            'description' => esc_html__( 'Enter Description of Decoration.', 'haru-pangja' ),
                            'admin_label' => true,
                        ),
                        array(
                            'type'        => 'attach_image',
                            'heading'     => esc_html__( 'Decoration\'s Image', 'haru-pangja' ),
                            'param_name'  => 'image',
                            'admin_label' => true,
                            'dependency'  => array(
                                'element' => 'layout_type',
                                'value'   => array('style_1'),
                            ),
                        ),
                        array(
                            'param_name' => 'css',
                            'type'       => 'css_editor',
                            'heading'    => esc_html__( 'CSS box', 'haru-pangja' ),
                            'group'      => esc_html__( 'Design Options', 'haru-pangja' ),
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

    new Haru_Framework_Shortcode_Decoration();
}
?>