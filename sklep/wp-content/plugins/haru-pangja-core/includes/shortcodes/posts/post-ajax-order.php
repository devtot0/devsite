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

if ( ! class_exists('Haru_Post_Ajax_Order') ) {
    class Haru_Post_Ajax_Order {
        function __construct() {
            add_shortcode('haru_post_ajax_order', array($this, 'haru_post_ajax_order_shortcode' ));
            add_action( 'vc_before_init', array($this, 'haru_post_ajax_order_vc_map') );

            $this->includes();
        }

        private function includes() {
            include_once( 'utils/ajax-action.php' );
        }

        function haru_post_ajax_order_shortcode($atts) {
            $atts  = vc_map_get_attributes( 'haru_post_ajax_order', $atts );
            $post_tabs = $latest_title = $popular_title = $view_title = $random_title = $category = $layout_type = $tab_align = $per_page = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'post_tabs'     => '',
                'latest_title'     => '',
                'popular_title'     => '',
                'view_title'     => '',
                'random_title'     => '',
                'category'     => '',
                'layout_type'      => 'list',
                'tab_align'  => 'align_left',
                'per_page'         => 6,
                'el_class'         => '',
                'css_animation'    => '',
                'duration'         => '',
                'delay'            => '',
            ), $atts));

            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            if ( !class_exists('WooCommerce') ) {
                return;
            }

            ob_start();

        ?>  
        <div class="<?php echo esc_attr( $haru_animation . ' ' . $styles_animation ); ?>">
            <?php echo haru_get_template('posts/ajax-order/' . $layout_type .'.php', array('atts' => $atts), '', '' ); ?>
        </div>
        <?php
            wp_reset_postdata();
            $content =  ob_get_clean();

            return $content;
        }

        function haru_post_ajax_order_vc_map() {
            vc_map( 
                array(
                    'base'        => 'haru_post_ajax_order',
                    'name'        => esc_html__( 'Haru Post Ajax Order', 'haru-pangja' ),
                    'class'       => '',
                    'icon'        => 'fa fa-bookmark haru-vc-icon',
                    'description' => esc_html__( 'Display posts by order via ajax load', 'haru-pangja' ),
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'params'      => array(
                        array(
                            'param_name'  => 'post_tabs',
                            'type'        => 'checkbox',
                            'multiple'        => true,
                            'heading'     => esc_html__( 'Post order tabs', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => array(
                                'Latest'       => 'date',
                                'Popular' => 'comment_count',
                                'Most View'     => 'views',
                                'Random'       => 'rand'
                            ),
                            'description'  => esc_html__( 'Select post order tabs to display', 'haru-pangja' )
                        ),
                        array(
                            'param_name'  => 'date_title',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Latest Tab title', 'haru-pangja' ),
                            'admin_label' => false,
                            'dependency'  => array(
                                'element' => 'post_tabs', 
                                'value'   => array('date')
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'comment_count_title',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Popular Tab title', 'haru-pangja' ),
                            'admin_label' => false,
                            'dependency'  => array(
                                'element' => 'post_tabs', 
                                'value'   => array('comment_count')
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'views_title',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Most View Tab title', 'haru-pangja' ),
                            'admin_label' => false,
                            'dependency'  => array(
                                'element' => 'post_tabs', 
                                'value'   => array('views')
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'rand_title',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Random Tab title', 'haru-pangja' ),
                            'admin_label' => false,
                            'dependency'  => array(
                                'element' => 'post_tabs', 
                                'value'   => array('rand')
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'category',
                            'type'        => 'haru_post_categories',
                            'heading'     => esc_html__( 'Product Categories', 'haru-pangja' ),
                            'admin_label' => true,
                        ),
                        array(
                            'param_name'  => 'layout_type',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Layout type', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => array(
                                'List'   => 'list',
                                // 'Grid'   => 'grid',
                                // 'Slider' => 'slider'
                            ),
                            'description'  => '',
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        // Tab
                        array(
                            'param_name'  => 'tab_align',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Tab Align', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => array(
                                esc_html__( 'Left', 'haru-pangja' )  => 'align_left',
                                esc_html__( 'Right', 'haru-pangja' ) => 'align_right',
                                esc_html__( 'Center', 'haru-pangja' )   => 'align_center'
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'per_page',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Number of Post', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => 6,
                            'description' => esc_html__( 'Number of Post to show', 'haru-pangja' )
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

    new Haru_Post_Ajax_Order();
}