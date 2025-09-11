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

if ( ! class_exists('Haru_Framework_Shortcode_Teammember') ) {
    class Haru_Framework_Shortcode_Teammember {
        function __construct() {
            add_shortcode('haru_teammember', array($this, 'haru_teammember_shortcode' ));
            add_action( 'vc_before_init', array($this, 'haru_teammember_vc_map') );
            $this->haru_includes();
        }

        private function haru_includes() {
            include_once( 'utils/functions.php' );
        }

        function haru_teammember_shortcode($atts) {
            $atts        = vc_map_get_attributes( 'haru_teammember', $atts );
            $data_source = $category = $member_ids = $layout_type = $columns = $posts_per_page = $filter = $filter_style = $filter_align = $paging_style = $css = $orderby = $order = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'data_source'    => '',
                'category'       => '',
                'member_ids'     => '',
                'layout_type'    => 'carousel',
                'columns'        => '2',
                'posts_per_page' => '5',
                'filter'         => 'show',
                'filter_style'   => 'style_1',
                'filter_align'   => 'align_left',
                'autoplay'       => 'true',
                'slide_duration' => '6000',
                'order'          => 'DESC',
                'orderby'        => 'date',
                'paging_style'   => 'none',
                'css'            => '',
                'el_class'       => '',
                'css_animation'  => '',
                'duration'       => '',
                'delay'          => '',
            ), $atts));

            $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'haru_accordion', $atts );
            
            $haru_animation   .= HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();

        ?>  
        
        <div class="<?php echo esc_attr( $css_class . ' ' . $haru_animation . ' ' . $styles_animation ); ?>">
            <?php echo haru_get_template('posttypes/teammember/'. $layout_type . '.php', array('atts' => $atts), '', '' ); ?>
        </div>  
        
        <?php
            wp_reset_postdata();
            $content =  ob_get_clean();
            return $content;
        }

        function haru_teammember_vc_map() {
            vc_map(
                array(
                    'base'        => 'haru_teammember',
                    'name'        => esc_html__( 'Haru Team Member', 'haru-pangja' ),
                    'icon'        => 'fa fa-users haru-vc-icon',
                    'description' => esc_html__( 'Display our team member', 'haru-pangja' ),
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'params'      => array(
                        array(
                            'param_name'  => 'data_source',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Source', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => array(
                                esc_html__( 'From Category', 'haru-pangja' )   => '',
                                esc_html__( 'From Member IDs', 'haru-pangja' ) => 'list_id'
                            )
                        ),
                        array(
                            'param_name'  => 'category',
                            'type'        => 'haru_teammember_categories',
                            'heading'     => esc_html__( 'Teammember Category', 'haru-pangja' ),
                            'admin_label' => true,
                            'dependency'  => array(
                                'element' => 'data_source', 
                                'value'   => array('')
                            ),
                        ),
                        array(
                            'param_name' => 'member_ids',
                            'type'       => 'haru_teammember_list',
                            'heading'    => esc_html__( 'Select Teammember', 'haru-pangja' ),
                            'dependency' => array(
                                'element' => 'data_source', 
                                'value'   => array('list_id')
                            )
                        ),
                        array(
                            'param_name'       => 'layout_type',
                            'type'             => 'dropdown',
                            'heading'          => esc_html__( 'Layout Style', 'haru-pangja' ),
                            'value'            => array(
                                esc_html__( 'Carousel', 'haru-pangja' ) => 'carousel',
                                esc_html__( 'Grid', 'haru-pangja' ) => 'grid',
                            ),
                            'admin_label' => true,
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'columns',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Columns', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => array(
                                '2 Columns' => '2',
                                '3 Columns' => '3',
                                '4 Columns' => '4',
                                '5 Columns' => '5',
                                '6 Columns' => '6',
                            ),
                            'description'      => esc_html__( 'Number of Columns', 'haru-pangja' ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                            'dependency'       => array(
                                'element' => 'layout_type', 
                                'value'   => array('carousel', 'grid')
                            )
                        ),
                        array(
                            'param_name'       => 'filter',
                            'type'             => 'dropdown',
                            'heading'          => esc_html__( 'Filter Display', 'haru-pangja' ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                            'admin_label'      => true,
                            'value'            => array(
                                esc_html__( 'Show', 'haru-pangja' ) => 'show',
                                esc_html__( 'Hide', 'haru-pangja' ) => 'hide'
                            ),
                            'dependency' => array(
                                'element' => 'layout_type', 
                                'value'   => array('grid')
                            )
                        ),
                        array(
                            'param_name'       => 'filter_style',
                            'type'             => 'dropdown',
                            'heading'          => esc_html__( 'Filter Style', 'haru-pangja' ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                            'admin_label'      => true,
                            'value'            => array(
                                esc_html__( 'Style 1', 'haru-pangja' )  => 'style_1',
                            ),
                            'dependency' => array(
                                'element' => 'filter', 
                                'value'   => array('show')
                            )
                        ),
                        array(
                            'param_name'       => 'filter_align',
                            'type'             => 'dropdown',
                            'heading'          => esc_html__( 'Filter Align', 'haru-pangja' ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                            'admin_label'      => true,
                            'value'            => array(
                                esc_html__( 'Left', 'haru-pangja' )   => 'align_left',
                                esc_html__( 'Center', 'haru-pangja' ) => 'align_center',
                                esc_html__( 'Right', 'haru-pangja' )  => 'align_right'
                            ),
                            'dependency' => array(
                                'element' => 'filter', 
                                'value'   => array('show')
                            )
                        ),
                        array( 
                            'param_name'  => 'posts_per_page', 
                            'heading'     => esc_html__( 'Posts per page', 'haru-pangja' ), 
                            'type'        => 'textfield', 
                            'admin_label' => true,
                            'description' => esc_html__( 'Number of member to show', 'haru-pangja' ),
                            'dependency'  => array(
                                'element' => 'layout_type', 
                                'value'   => array('carousel', 'grid')
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name' => 'paging_style',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Pagination', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'None', 'haru-pangja' )               => 'none',
                                esc_html__( 'Page Number', 'haru-pangja' )        => 'default',
                                esc_html__( 'Load More Button', 'haru-pangja' )   => 'load-more',
                                esc_html__( 'Infinite Scrolling', 'haru-pangja' ) => 'infinity-scroll',
                            ),
                            'description'      => esc_html__( 'Choose pagination type.', 'haru-pangja' ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                            'dependency'  => array(
                                'element' => 'layout_type',
                                'value'   => array('grid')
                            )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'AutoPlay', 'haru-pangja' ),
                            'param_name' => 'autoplay',
                            'value'      => array(
                                esc_html__( 'Yes', 'haru-pangja') => 'true', 
                                esc_html__( 'No', 'haru-pangja')  => 'false'
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                            'dependency'  => array(
                                'element' => 'layout_type', 
                                'value'   => array('carousel')
                            )
                        ),
                        array(
                            'type'             => 'textfield',
                            'heading'          => esc_html__( 'Slide Duration (ms)', 'haru-pangja' ),
                            'param_name'       => 'slide_duration',
                            'std'              => '6000',
                            'admin_label'      => true,
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                            'dependency'  => array(
                                'element' => 'layout_type', 
                                'value'   => array('carousel')
                            )
                        ),
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
                            'heading'    => esc_html__( 'Order Post Date By', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'Descending', 'haru-pangja' ) => 'DESC', 
                                esc_html__( 'Ascending', 'haru-pangja' )  => 'ASC'
                            )
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

    new Haru_Framework_Shortcode_Teammember();
}