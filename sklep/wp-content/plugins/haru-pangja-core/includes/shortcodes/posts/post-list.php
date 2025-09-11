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

if ( ! class_exists('Haru_Framework_Shortcode_Post_List') ) {
    class Haru_Framework_Shortcode_Post_List {
        function __construct() {
            add_shortcode( 'haru_post_list', array( $this, 'haru_post_list_shortcode' ));
            add_action( 'vc_before_init', array($this, 'haru_post_list_vc_map') );
        }

        function haru_post_list_shortcode($atts) {
            $atts        = vc_map_get_attributes( 'haru_post_list', $atts );
            $layout_type = $data_source = $category = $post_ids = $excerpt_length = $posts_per_page = $orderby = $order = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array( 
                'layout_type'    => 'list',
                'data_source'    => '',
                'category'       => '',
                'post_ids'      => '',
                'excerpt_length' => '20',
                'posts_per_page' => '6',
                'orderby'        => 'date',
                'order'          => 'DESC',
                'el_class'       => '',
                'css_animation'  => '',
                'duration'       => '',
                'delay'          => '',
            ), $atts));

            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();
            
        ?>  
        <div class="<?php echo esc_attr($haru_animation . ' ' . $styles_animation); ?>">
            <?php echo haru_get_template('posts/list/'. $layout_type . '.php', array('atts' => $atts), '', '' ); ?>
        </div>
        <?php
            wp_reset_postdata();
            $content =  ob_get_clean();

            return $content;
        }

        function haru_post_list_vc_map() {
            vc_map(
                array(
                    'name'        => esc_html__( 'Haru Post List', 'haru-pangja' ),
                    'base'        => 'haru_post_list',
                    'icon'        => 'fa fa-bookmark haru-vc-icon',
                    'description' => esc_html__( 'Display list post or selected post', 'haru-pangja' ),
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'params'      => array(
                        array(
                            'param_name'  => 'layout_type',
                            'heading'     => esc_html__( 'Choose layout', 'haru-pangja' ),
                            'description' => '',
                            'type'        => 'dropdown',
                            'admin_label' => true,
                            'value'       => array(
                                esc_html__( 'List', 'haru-pangja' ) => 'list',
                            )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Source', 'haru-pangja' ),
                            'param_name'  => 'data_source',
                            'admin_label' => true,
                            'value'       => array(
                                esc_html__( 'From Category', 'haru-pangja' ) => '',
                                esc_html__( 'From Post IDs', 'haru-pangja' ) => 'list_id'
                            )
                        ),
                        array(
                            'type'        => 'haru_post_categories',
                            'heading'     => esc_html__( 'Select Categories', 'haru-pangja' ),
                            'param_name'  => 'category',
                            'admin_label' => true,
                            'dependency'  => array(
                                'element' => 'data_source', 
                                'value'   => array('')
                            ),
                        ),
                        array(
                            'type'       => 'haru_post_list',
                            'heading'    => esc_html__( 'Select Post', 'haru-pangja' ),
                            'param_name' => 'post_ids',
                            'dependency' => array(
                                'element' => 'data_source', 
                                'value'   => array('list_id')
                            )
                        ),
                        array( 
                            'param_name'  => 'posts_per_page', 
                            'heading'     => esc_html__( 'Posts per page', 'haru-pangja' ), 
                            'type'        => 'textfield',
                            'admin_label' => true,
                            'std'              => '6',
                        ),
                        array(
                            'param_name'  => 'excerpt_length',
                            'heading'     => esc_html__( 'Excerpt Length', 'haru-pangja' ),
                            'description' => esc_html__( 'Insert number of words to show in excerpt.', 'haru-pangja' ),
                            'type'        => 'textfield',
                            'value'       => '',
                            'admin_label' => true,
                        ),
                        // Data settings  
                        array(
                            'param_name' => 'orderby',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Order by', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'Date', 'haru-pangja' )                  => 'date',
                                esc_html__( 'Order by post ID', 'haru-pangja' )      => 'ID',
                                esc_html__( 'Author', 'haru-pangja' )                => 'author',
                                esc_html__( 'Title', 'haru-pangja' )                 => 'title',
                                esc_html__( 'Last modified date', 'haru-pangja' )    => 'modified',
                                esc_html__( 'Post/page parent ID', 'haru-pangja' )   => 'parent',
                                esc_html__( 'Number of comments', 'haru-pangja' )    => 'comment_count',
                                esc_html__( 'Random order', 'haru-pangja' )          => 'rand',
                            ),
                            'description'        => esc_html__( 'Select order type.', 'haru-pangja' ),
                        ),

                        array(
                            'param_name' => 'order',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Sort Order', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'Descending', 'haru-pangja' ) => 'DESC',
                                esc_html__( 'Ascending', 'haru-pangja' )  => 'ASC',
                            ),
                            'description'        => esc_html__( 'Select sorting order.', 'haru-pangja' ),
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

    new Haru_Framework_Shortcode_Post_List();
}