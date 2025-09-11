<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
 ** 
 * Add param to exits shortcode
 * 1. vc_row
 * 2. vc_row_inner
 * 3. vc_column
 */

function haru_add_vc_param() {
    if (function_exists('vc_add_param')) {
        $add_css_animation = array(
            'type'        => 'dropdown',
            'heading'     => esc_html__( 'CSS Animation', 'pangja' ),
            'param_name'  => 'css_animation',
            'value'       => array(
                esc_html__( 'No', 'pangja' )                   => '', 
                esc_html__( 'Fade In', 'pangja')               => 'wpb_fadeIn', 
                esc_html__( 'Fade Top to Bottom', 'pangja' )   => 'wpb_fadeInDown', 
                esc_html__( 'Fade Bottom to Top', 'pangja' )   => 'wpb_fadeInUp', 
                esc_html__( 'Fade Left to Right', 'pangja' )   => 'wpb_fadeInLeft', 
                esc_html__( 'Fade Right to Left', 'pangja' )   => 'wpb_fadeInRight', 
                esc_html__( 'Bounce In', 'pangja')             => 'wpb_bounceIn', 
                esc_html__( 'Bounce Top to Bottom', 'pangja' ) => 'wpb_bounceInDown', 
                esc_html__( 'Bounce Bottom to Top', 'pangja' ) => 'wpb_bounceInUp', 
                esc_html__( 'Bounce Left to Right', 'pangja' ) => 'wpb_bounceInLeft', 
                esc_html__( 'Bounce Right to Left', 'pangja' ) => 'wpb_bounceInRight', 
                esc_html__( 'Zoom In', 'pangja' )              => 'wpb_zoomIn', 
                esc_html__( 'Flip Vertical', 'pangja' )        => 'wpb_flipInX', 
                esc_html__( 'Flip Horizontal', 'pangja' )      => 'wpb_flipInY', 
                esc_html__( 'Bounce', 'pangja' )               => 'wpb_bounce', 
                esc_html__( 'Flash', 'pangja' )                => 'wpb_flash', 
                esc_html__( 'Shake', 'pangja' )                => 'wpb_shake', 
                esc_html__('Pulse', 'pangja' )                 => 'wpb_pulse', 
                esc_html__( 'Swing', 'pangja')                 => 'wpb_swing', 
                esc_html__( 'Rubber band', 'pangja' )          => 'wpb_rubberBand', 
                esc_html__( 'Wobble', 'pangja' )               => 'wpb_wobble', 
                esc_html__( 'Tada', 'pangja' )                 => 'wpb_tada'
            ),
            'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'pangja' ),
            'group'       => esc_html__( 'Haru Options', 'pangja' )
        );

        $add_duration_animation = array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Animation Duration', 'pangja' ),
            'param_name'  => 'duration',
            'value'       => '',
            'description' => esc_html__( 'Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'pangja' ),
            'dependency'  => array(
                'element' => 'css_animation', 
                'value'   => array(
                    'wpb_fadeIn', 
                    'wpb_fadeInDown', 
                    'wpb_fadeInUp', 
                    'wpb_fadeInLeft', 
                    'wpb_fadeInRight', 
                    'wpb_bounceIn', 
                    'wpb_bounceInDown', 
                    'wpb_bounceInUp', 
                    'wpb_bounceInLeft', 
                    'wpb_bounceInRight', 
                    'wpb_zoomIn', 
                    'wpb_flipInX', 
                    'wpb_flipInY', 
                    'wpb_bounce', 
                    'wpb_flash', 
                    'wpb_shake', 
                    'wpb_pulse', 
                    'wpb_swing', 
                    'wpb_rubberBand',
                    'wpb_wobble', 
                    'wpb_tada'
                )
            ),
            'group'       => esc_html__( 'Haru Options', 'pangja' )
        );

        $add_delay_animation = array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Animation Delay', 'pangja' ),
            'param_name'  => 'delay',
            'value'       => '',
            'description' => esc_html__( 'Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'pangja' ),
            'dependency'  => array(
                'element' => 'css_animation', 
                'value'   => array(
                    'wpb_fadeIn', 
                    'wpb_fadeInDown', 
                    'wpb_fadeInUp',
                    'wpb_fadeInLeft',
                    'wpb_fadeInRight', 
                    'wpb_bounceIn', 
                    'wpb_bounceInDown', 
                    'wpb_bounceInUp', 
                    'wpb_bounceInLeft', 
                    'wpb_bounceInRight', 
                    'wpb_zoomIn', 
                    'wpb_flipInX', 
                    'wpb_flipInY', 
                    'wpb_bounce', 
                    'wpb_flash', 
                    'wpb_shake', 
                    'wpb_pulse', 
                    'wpb_swing', 
                    'wpb_rubberBand', 
                    'wpb_wobble', 
                    'wpb_tada'
                )
            ),
            'group'       => esc_html__( 'Haru Options', 'pangja' )
        );

        $add_params_row = array(
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Row background overlay', 'pangja' ),
                'param_name'  => 'overlay_set',
                'description' => esc_html__( 'Hide or Show overlay on row background image.', 'pangja' ),
                'value'       => array(
                    esc_html__( 'Hide', 'pangja' )               => 'hide_overlay',
                    esc_html__( 'Show Overlay Color', 'pangja' ) => 'show_overlay_color',
                ),
                'group'       => esc_html__( 'Haru Options', 'pangja' )
            ),
            array(
                'type'        => 'colorpicker',
                'heading'     => esc_html__( 'Overlay color', 'pangja' ),
                'param_name'  => 'overlay_color',
                'description' => esc_html__( 'Select color for background overlay.', 'pangja' ),
                'value'       => '',
                'dependency'  => array(
                    'element' => 'overlay_set', 
                    'value'   => array('show_overlay_color')
                ),
                'group'       => esc_html__( 'Haru Options', 'pangja' )
            ),
            array(
                'type'        => 'number',
                'class'       => '',
                'heading'     => esc_html__( 'Overlay opacity', 'pangja' ),
                'param_name'  => 'overlay_opacity',
                'value'       => '50',
                'min'         => '1',
                'max'         => '100',
                'suffix'      => '%',
                'description' => esc_html__( 'Select opacity for overlay.', 'pangja' ),
                'dependency'  => array(
                    'element' => 'overlay_set', 
                    'value'   => array( 'show_overlay_color', 'show_overlay_image' )
                ),
                'group'       => esc_html__( 'Haru Options', 'pangja' )
            ),
            $add_css_animation,
            $add_duration_animation,
            $add_delay_animation,
        );

        $add_params_row_inner = array(
            $add_css_animation,
            $add_duration_animation,
            $add_delay_animation,
        );

        $add_params_column = array(
            $add_css_animation,
            $add_duration_animation,
            $add_delay_animation,
        );

        $add_params_heading = array(
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Heading Style', 'pangja' ),
                'param_name'  => 'heading_style',
                'description' => esc_html__( 'Choose Pre-made Heading style.', 'pangja' ),
                'value'       => array(
                    esc_html__( 'Default', 'pangja' )                                        => 'default',
                    esc_html__( 'Heading Style 1 (50px - Heading Color)', 'pangja' )         => 'heading_style_1',
                    esc_html__( 'Heading Style 2 (20px - Heading Color)', 'pangja' )         => 'heading_style_2',
                    esc_html__( 'Heading Style 3 (30px - Heading Color)', 'pangja' )         => 'heading_style_3',
                    esc_html__( 'Heading Style 4 (40px - Heading Color)', 'pangja' )         => 'heading_style_4',
                    esc_html__( 'Heading Style 5 (Sub Heading & Hightlight)', 'pangja' )     => 'heading_style_5',
                    esc_html__( 'Heading Style 6 (Contact)', 'pangja' )                      => 'heading_style_6',
                    esc_html__( 'Heading Style 7 (50px - Heading Color)', 'pangja' )         => 'heading_style_7',
                    esc_html__( 'Heading Style 8 (80px - Primary Color)', 'pangja' )         => 'heading_style_8',
                    esc_html__( 'Sub Heading Style 1 (20px - Primary Color)', 'pangja' )     => 'sub_heading_style_1',
                    esc_html__( 'Sub Heading Style 2 (Bold Italic)', 'pangja' )              => 'sub_heading_style_2',
                    esc_html__( 'Sub Heading Style 3 (Bold, 15px, Uppercase)', 'pangja' )    => 'sub_heading_style_3',
                    esc_html__( 'Footer Heading 1 (Footer 2)', 'pangja' )                    => 'footer_style_1',
                    esc_html__( 'Footer Heading 2 (Footer 4)', 'pangja' )                    => 'footer_style_2',
                ),
                'weight' => 1, //  default 0 - unsorted and appended to bottom, 1 - appended to top
            ),
            array(
                'param_name'  => 'sub_heading',
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Sub Title', 'pangja' ),
                'description' => esc_html__( 'Enter sub title.', 'pangja' ),
                'admin_label' => true,
                'dependency' => array(
                    'element' => 'heading_style',
                    'value'   => array('heading_style_1', 'heading_style_5'),
                ),
                'weight' => 1, //  default 0 - unsorted and appended to bottom, 1 - appended to top
            ),
            array(
                'param_name'  => 'hightlight_heading',
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Hightlight Title', 'pangja' ),
                'description' => esc_html__( 'Enter Hightlight title.', 'pangja' ),
                'admin_label' => true,
                'dependency' => array(
                    'element' => 'heading_style',
                    'value'   => array('heading_style_5'),
                ),
                'weight' => 1, //  default 0 - unsorted and appended to bottom, 1 - appended to top
            ),
        );

        $add_params_button = array(
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Button Style', 'pangja' ),
                'param_name'  => 'button_style',
                'description' => esc_html__( 'Choose Pre-made Button style.', 'pangja' ),
                'value'       => array(
                    esc_html__( 'Default', 'pangja' )                    => 'default',
                    esc_html__( 'Button Style 1 (Background Primary)', 'pangja' )             => 'button_style_1',
                    esc_html__( 'Button Style 2 (Background White)', 'pangja' )             => 'button_style_2',
                    esc_html__( 'Button Style 3 (Background Primary - Icon)', 'pangja' ) => 'button_style_3',
                    esc_html__( 'Button Style 4 (Gradient Color)', 'pangja' )     => 'button_style_4',
                    esc_html__( 'Button Style 5 (Border Gradient Color)', 'pangja' )     => 'button_style_5',
                ),
                'weight' => 1, //  default 0 - unsorted and appended to bottom, 1 - appended to top
            ),
        );

        // 1. Add new parameters for row
        foreach( $add_params_row as $param_row ) {
            vc_add_param( 'vc_row', $param_row );
        }
        // 2. Add new parameters for row_inner
        foreach( $add_params_row_inner as $param_row_inner ) {
            vc_add_param( 'vc_row_inner', $param_row_inner );
        }

        // 3. Add new parameters for column
        foreach( $add_params_column as $param_column ) {
            vc_add_param( 'vc_column', $param_column );
        }
        
        // 4. Add new parameters for custom heading
        foreach( $add_params_heading as $param_heading ) {
            vc_add_param( 'vc_custom_heading', $param_heading );
        }

        // 5. Add new parameters for button
        foreach( $add_params_button as $param_button ) {
            vc_add_param( 'vc_btn', $param_button );
        }
    }
}

haru_add_vc_param();