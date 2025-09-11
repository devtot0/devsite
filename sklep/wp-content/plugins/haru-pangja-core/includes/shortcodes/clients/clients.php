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

if ( ! class_exists('Haru_Framework_Shortcode_Clients') ) {
    class Haru_Framework_Shortcode_Clients {
        function __construct() {
            add_shortcode( 'haru_clients', array( $this, 'haru_clients_shortcode' ) );
            add_action( 'vc_before_init', array($this, 'haru_clients_vc_map') );
        }

        function haru_clients_shortcode($atts) {
            $atts    = vc_map_get_attributes( 'haru_clients', $atts );
            $clients = $autoplay = $slide_duration = $columns = $rows = $layout_type = $hover_style = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'clients'        => '',
                'autoplay'       => 'true',
                'slide_duration' => '6000',
                'layout_type'    => 'carousel',
                'hover_style'    => 'style_1',
                'columns'        => 1,
                'rows'           => 1,
                'el_class'       => '',
                'css_animation'  => '',
                'duration'       => '',
                'delay'          => '',
            ), $atts));

            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();

            ?>
            <?php if ( $clients != '' ) : ?>
            <div class="<?php echo esc_attr($haru_animation . ' ' . $styles_animation); ?>">
                <?php echo haru_get_template('clients/'. $layout_type . '.php', array('atts' => $atts), '', '' ); ?>
            </div>
            <?php else : ?>
                <div class="clients-not-select"><?php echo esc_html__( 'Please select clients!', 'haru-pangja' ); ?></div>
            <?php endif; ?>
        <?php
            $content =  ob_get_clean();
            return $content;         
        }

        function haru_clients_vc_map() {
            vc_map(
                array(
                    'name'        => esc_html__( 'Haru Clients', 'haru-pangja' ),
                    'base'        => 'haru_clients',
                    'icon'        => 'fa fa-users haru-vc-icon',
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'description' => esc_html__( 'Display client logos', 'haru-pangja' ),
                    'params'      => array(
                        array(
                            'type'        => 'param_group',
                            'heading'     => esc_html__( 'Clients', 'haru-pangja' ),
                            'param_name'  => 'clients',
                            'description' => esc_html__( 'Enter values for client - name, image and url.', 'haru-pangja' ),
                            'value'       => urlencode( json_encode( array(
                                array(
                                    'name' => esc_html__( 'Themeforest', 'haru-pangja' ),
                                    'logo' => '',
                                    'link' => '',
                                ),
                                array(
                                    'name'  => esc_html__( 'Codecanyon', 'haru-pangja' ),
                                    'value' => '',
                                    'link'  => '',
                                ),
                                array(
                                    'name'  => esc_html__( 'Photodune', 'haru-pangja' ),
                                    'value' => '',
                                    'link'  => '',
                                ),
                            ) ) ),
                            'params' => array(
                                array(
                                    'type'        => 'textfield',
                                    'heading'     => esc_html__( 'Name', 'haru-pangja' ),
                                    'param_name'  => 'name',
                                    'description' => esc_html__( 'Enter name of client.', 'haru-pangja' ),
                                    'admin_label' => true,
                                ),
                                array(
                                    'type'        => 'attach_image',
                                    'heading'     => esc_html__( 'Image', 'haru-pangja' ),
                                    'param_name'  => 'logo',
                                    'description' => esc_html__( 'Please select client\' logo.', 'haru-pangja' ),
                                    'admin_label' => true,
                                ),
                                array(
                                    'param_name'  => 'link',
                                    'type'        => 'vc_link',
                                    'heading'     => esc_html__( 'Link', 'haru-pangja' ),
                                    'description' => esc_html__( 'Please insert client\' link.', 'haru-pangja' ),
                                    'admin_label' => false,
                                ),
                            ),
                        ),
                        array(
                            'param_name'  => 'layout_type',
                            'heading'     => esc_html__( 'Choose layout', 'haru-pangja' ),
                            'description' => '',
                            'type'        => 'dropdown',
                            'value'       => array(
                                esc_html__( 'Carousel', 'haru-pangja' )   => 'carousel',
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'hover_style',
                            'heading'     => esc_html__( 'Choose Hover style', 'haru-pangja' ),
                            'description' => '',
                            'type'        => 'dropdown',
                            'value'       => array(
                                esc_html__( 'Carousel (Image Opacity)', 'haru-pangja' )   => 'carousel',
                                esc_html__( 'Style 2 (Image Scale)', 'haru-pangja' ) => 'style_2',
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'columns',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Columns', 'haru-pangja' ),
                            'description' => esc_html__( 'Select columns.', 'haru-pangja'),
                            'admin_label' => true,
                            'value'       => array( 1, 2, 3, 4, 5, 6 ),
                            'std'           => 1
                        ),
                        array(
                            'param_name'  => 'rows',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Rows', 'haru-pangja' ),
                            'description' => esc_html__( 'Select rows.', 'haru-pangja'),
                            'admin_label' => true,
                            'value'       => array( 1, 2, 3, 4, 5, 6 ),
                            'std'           => 1
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
                        ),
                        array(
                            'type'             => 'textfield',
                            'heading'          => esc_html__( 'Slide Duration (ms)', 'haru-pangja' ),
                            'param_name'       => 'slide_duration',
                            'std'              => '6000',
                            'admin_label'      => true,
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        Haru_PangjaCore_Shortcodes::add_css_animation(),
                        Haru_PangjaCore_Shortcodes::add_duration_animation(),
                        Haru_PangjaCore_Shortcodes::add_delay_animation(),
                        Haru_PangjaCore_Shortcodes::add_el_class()
                    ),
                )
            );
        }
    }

    new Haru_Framework_Shortcode_Clients();
}