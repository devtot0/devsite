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

if ( ! class_exists('Haru_Framework_Shortcode_Blog') ) {
    class Haru_Framework_Shortcode_Blog {
        function __construct() {
            add_shortcode( 'haru_blog', array( $this, 'haru_blog_shortcode' ) );
            add_action( 'vc_before_init', array($this, 'haru_blog_vc_map') );
            $this->haru_includes();
        }

        private function haru_includes() {
            include_once( 'utils/functions.php' );
        }

        function haru_blog_shortcode($atts) {
            $atts = vc_map_get_attributes( 'haru_blog', $atts );
            $layout_type = $columns = $category = $post_ids = $posts_per_page = $excerpt_length = $paging_style = $orderby = $order = $meta_key = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'layout_type'    => 'grid',
                'columns'        => '2',
                'category'       => '',
                'post_ids'      => '',
                'posts_per_page' => '',
                'excerpt_length' => '15',
                'paging_style'   => 'default',
                'paging_align'   => 'left',
                'orderby'        => 'date',
                'order'          => 'DESC',
                'el_class'       => '',
                'css_animation'  => '',
                'duration'       => '',
                'delay'          => ''
            ), $atts));

            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();
            ?>
            <div class="<?php echo esc_attr($haru_animation . ' ' . $styles_animation); ?>">
                <?php echo haru_get_template('blog/'. $layout_type . '.php', array('atts' => $atts), '', '' ); ?>
            </div>
            <?php
            wp_reset_postdata();
            $content =  ob_get_clean();

            return $content;
        }

        function haru_blog_vc_map() {
            vc_map(
                array(
                    'name'        => esc_html__( 'Haru Blog', 'haru-pangja' ),
                    'base'        => 'haru_blog',
                    'icon'        => 'fa fa-file-text haru-vc-icon',
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'description' => esc_html__( 'Display post as grid', 'haru-pangja' ),
                    'params'      => array(
                        array(
                            'param_name' => 'layout_type',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Layout Style', 'haru-pangja' ),
                            'description'=> esc_html__( 'Choose layout style from drop down list styles.', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'Masonry', 'haru-pangja' )                => 'masonry',
                            ),
                            'admin_label' => true,
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name' => 'columns',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Columns', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( '2 columns', 'haru-pangja' ) => '2',
                                esc_html__( '3 columns', 'haru-pangja' ) => '3',
                                esc_html__( '4 columns', 'haru-pangja' ) => '4',
                                esc_html__( '5 columns', 'haru-pangja' ) => '5',
                            ),
                            'dependency'  => array(
                                'element' => 'type',
                                'value'   => array('grid', 'masonry')
                            ),
                            'admin_label' => true,
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name' => 'category',
                            'type'       => 'haru_post_categories',
                            'heading'    => esc_html__( 'Select Categories', 'haru-pangja' ),
                            'description'=> esc_html__( 'Select categories to display post on your page.', 'haru-pangja' ),
                            'admin_label' => true,
                        ),
                        array(
                            'type'       => 'haru_post_list_single',
                            'heading'    => esc_html__( 'Featured Post', 'haru-pangja' ),
                            'param_name' => 'post_id',
                            'admin_label' => true,
                        ),
                        array( 
                            'param_name'  => 'posts_per_page', 
                            'heading'     => esc_html__( 'Posts per page', 'haru-pangja' ), 
                            'type'        => 'textfield',
                            'admin_label' => true
                        ),
                        array(
                            'param_name'  => 'excerpt_length',
                            'heading'     => esc_html__( 'Excerpt Length', 'haru-pangja' ),
                            'description' => esc_html__( 'Insert number of words to show in excerpt.', 'haru-pangja' ),
                            'type'        => 'textfield',
                            'value'       => '',
                            'admin_label' => true,
                        ),

                        array(
                            'param_name' => 'paging_style',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Paging Style', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'Default', 'haru-pangja' )         => 'default',
                                esc_html__( 'Load More', 'haru-pangja' )       => 'load-more',
                                esc_html__( 'Infinity Scroll', 'haru-pangja' ) => 'infinity-scroll',
                            ),
                            'std'              => 'default'
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

    new Haru_Framework_Shortcode_Blog();
}