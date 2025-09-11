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

if ( ! class_exists('Haru_Framework_Shortcode_Testimonial') ) {
    class Haru_Framework_Shortcode_Testimonial {
        function __construct() {
            add_shortcode( 'haru_testimonial', array( $this, 'haru_testimonial_shortcode' ) );
            add_action( 'vc_before_init', array($this, 'haru_testimonial_vc_map') );
        }

        function haru_testimonial_shortcode($atts) {
            $atts        = vc_map_get_attributes( 'haru_testimonial', $atts );
            $layout_type = $data_source = $category = $testimonial_ids = $testimonial_title = $testimonial_desc = $image = $order = $columns = $autoplay = $slide_duration = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'layout_type'       => 'carousel',
                'data_source'       => '',
                'category'          => '',
                'testimonial_ids'   => '',
                'testimonial_title' => '',
                'testimonial_desc'  => '',
                'image'             => '',
                'order'           => 'DESC',
                'columns'         => '1',
                'autoplay'        => 'true',
                'slide_duration'  => '6000',
                'el_class'        => '',
                'css_animation'   => '',
                'duration'        => '',
                'delay'           => '',
                'excerpt_length'  => '',
            ), $atts));

            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();
        ?>
        
        <div class="<?php echo esc_attr($haru_animation . ' ' . $styles_animation); ?>">
            <?php echo haru_get_template('posttypes/testimonial/'. $layout_type . '.php', array('atts' => $atts), '', '' ); ?>
        </div>  
        
        <?php
            wp_reset_postdata();
            $content =  ob_get_clean();
            return $content;
        }

        function haru_testimonial_vc_map() {
            vc_map(
                array(
                    'name'        => esc_html__( 'Haru Testimonial', 'haru-pangja' ),
                    'base'        => 'haru_testimonial',
                    'icon'        => 'fa fa-comments haru-vc-icon',
                    'description' => esc_html__( 'Display client testimonials', 'haru-pangja' ),
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'params'      => array(
                        array(
                            'param_name' => 'layout_type',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Layout Style', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'Carousel (Home 5)', 'haru-pangja' )                => 'carousel',
                                esc_html__( 'Carousel 2 (Home 6)', 'haru-pangja' )              => 'carousel_2',
                                esc_html__( 'Carousel 3 (Background White)', 'haru-pangja' )    => 'carousel_3',
                                esc_html__( 'Carousel 4', 'haru-pangja' )                       => 'carousel_4',
                                esc_html__( 'Slick Slider', 'haru-pangja' )                     => 'slick',
                                esc_html__( 'Slick Slider 2', 'haru-pangja' )                   => 'slick_2'
                            ),
                        ),
                        array(
                            'param_name'  => 'data_source',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Source', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => array(
                                esc_html__( 'From Category', 'haru-pangja' )        => '',
                                esc_html__( 'From Testimonial IDs', 'haru-pangja' ) => 'list_id'
                            )
                        ),
                        array(
                            'param_name'  => 'category',
                            'type'        => 'haru_testimonial_categories',
                            'heading'     => esc_html__( 'Testimonial Category', 'haru-pangja' ),
                            'admin_label' => true,
                            'dependency'  => array(
                                'element' => 'data_source', 
                                'value'   => array('')
                            ),
                        ),
                        array(
                            'param_name' => 'testimonial_ids',
                            'type'       => 'haru_testimonial_list',
                            'heading'    => esc_html__( 'Select Testimonial', 'haru-pangja' ),
                            'dependency' => array(
                                'element' => 'data_source', 
                                'value'   => array('list_id')
                            )
                        ),
                        array(
                            'param_name'       => 'testimonial_title',
                            'type'             => 'textfield',
                            'heading'          => esc_html__( 'Testimonial title', 'haru-pangja' ),
                            'std'              => '',
                            'dependency'  => array(
                                'element' => 'layout_type', 
                                'value'   => array('carousel', 'slick', 'slick_2')
                            ),
                        ),
                        array(
                            'param_name'       => 'testimonial_desc',
                            'type'             => 'textarea',
                            'heading'          => esc_html__( 'Testimonial Description', 'haru-pangja' ),
                            'std'              => '',
                            'dependency'  => array(
                                'element' => 'layout_type', 
                                'value'   => array('carousel', 'slick', 'slick_2')
                            ),
                        ),
                        array(
                            'type'        => 'attach_image',
                            'heading'     => esc_html__( 'Testimonial background\'s Image', 'haru-pangja' ),
                            'param_name'  => 'image',
                            'admin_label' => true,
                            'dependency'  => array(
                                'element' => 'layout_type',
                                'value'   => array('slick_2'),
                            ),
                        ),
                        array(
                            'param_name' => 'order',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Order Post Date By', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'Descending', 'haru-pangja' ) => 'DESC', 
                                esc_html__( 'Ascending', 'haru-pangja' )  => 'ASC'
                            )
                        ),
                        array(
                            'param_name'       => 'excerpt_length',
                            'type'             => 'textfield',
                            'heading'          => esc_html__( 'Excerpt length', 'haru-pangja' ),
                            'std'              => '20'
                        ),
                        array(
                            'param_name'  => 'columns', 
                            'heading'     => esc_html__( 'Number of Columns', 'haru-pangja' ), 
                            'type'        => 'dropdown', 
                            'admin_label' => true, 
                            'value'       => array(
                                esc_html__( '1', 'haru_pangja' ) => '1',
                                esc_html__( '2', 'haru-pangja' ) => '2',
                                esc_html__( '3', 'haru-pangja' ) => '3', 
                                esc_html__( '4', 'haru-pangja' ) => '4', 
                                esc_html__( '5', 'haru-pangja' ) => '5', 
                            ),
                            'group'       => esc_html__( 'Slide Settings', 'haru-pangja' ),
                        ),
                        array(
                            'param_name' => 'autoplay',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'AutoPlay', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'Yes', 'haru-pangja') => 'true', 
                                esc_html__( 'No', 'haru-pangja')  => 'false'
                            ),
                            'group'       => esc_html__( 'Slide Settings', 'haru-pangja' ), 
                        ),
                        array(
                            'param_name'       => 'slide_duration',
                            'type'             => 'textfield',
                            'heading'          => esc_html__( 'Slide Duration (ms)', 'haru-pangja' ),
                            'std'             => '6000',
                            'admin_label'      => true,
                            'group'       => esc_html__( 'Slide Settings', 'haru-pangja' ),
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

    new Haru_Framework_Shortcode_Testimonial();
}