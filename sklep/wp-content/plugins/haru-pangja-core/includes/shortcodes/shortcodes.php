<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

if (!class_exists('Haru_PangjaCore_Shortcodes')) {
    class Haru_PangjaCore_Shortcodes {
        private static $instance;

        public static function init() {
            if (!isset(self::$instance)) {
                self::$instance = new Haru_PangjaCore_Shortcodes;
                add_action('init', array(self::$instance, 'includes'), 0);
            }
            return self::$instance;
        }

        public function includes() {
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
            if (!is_plugin_active('js_composer/js_composer.php')) {
                return;
            }

            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/functions.php' ); // Include functions for fields type

            if (class_exists('WooCommerce')) {
                include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/single-product/single-product.php' );
                include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/products/product-masonry.php' );
                include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/products/product-slider.php' );
                // include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/products/product-list.php' );
                include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/products/product-recent-viewed.php' );
                include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/products/product-top-rated.php' );
                include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/products/product-top-sale.php' );
                include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/products/product-top-seller.php' );
                // Products creative
                // include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/products-creative/products-creative-masonry/products-creative-masonry.php' );
                include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/products-creative/products-ajax-category/products-ajax-category.php' );
                include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/products-creative/products-ajax-creative/products-ajax-creative.php' );
                include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/products-creative/products-ajax-order/products-ajax-order.php' );
            }
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/countdown/countdown.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/banner/banner.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/decoration/decoration.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/banner-creative/banner-creative.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/product-category/product-category.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/clients/clients.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/icon-box/icon-box.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/gmaps/gmaps.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/recent-news/recent-news.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/widget/widget.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/counter/counter.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/images-gallery/images-gallery.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/posts/post-ajax-order.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/posts/post-list.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/blog/blog.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/progress-bar/progress-bar.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/video/video.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/pricing-plan/pricing-plan.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/text-label/text-label.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/accordion/accordion.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/process-step/process-step.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/timeline/timeline.php' );

            // Haru Posttypes Shortcodes
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/posttypes/testimonial/testimonial.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/posttypes/teammember/teammember.php' );

            // Haru Footer Shortcodes
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/footer/footer-contact/footer-contact.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/footer/footer-link/footer-link.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/footer/footer-gallery/footer-gallery.php' );
            include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/shortcodes/footer/footer-social/footer-social.php' );
        }

        /* Functions for custom VC display at front-end */
        public static function haru_get_css_animation($css_animation) {
            $output = '';
            if ( $css_animation != '' ) {
                wp_enqueue_script('vc_waypoints');
                $output = ' wpb_animate_when_almost_visible haru-css-animation ' . $css_animation;
            }
            return $output;
        }

        public static function haru_get_style_animation($duration, $delay) {
            $styles = array();
            if ( $duration != '0' && !empty($duration) ) {
                $duration = (float)trim($duration, "\n\ts");
                $styles[] = "-webkit-animation-duration: {$duration}s";
                $styles[] = "-moz-animation-duration: {$duration}s";
                $styles[] = "-ms-animation-duration: {$duration}s";
                $styles[] = "-o-animation-duration: {$duration}s";
                $styles[] = "animation-duration: {$duration}s";
            }
            if ( $delay != '0' && !empty($delay) ) {
                $delay = (float)trim($delay, "\n\ts");
                $styles[] = "opacity: 0";
                $styles[] = "-webkit-animation-delay: {$delay}s";
                $styles[] = "-moz-animation-delay: {$delay}s";
                $styles[] = "-ms-animation-delay: {$delay}s";
                $styles[] = "-o-animation-delay: {$delay}s";
                $styles[] = "animation-delay: {$delay}s";
            }
            if ( count($styles) > 1 ) {
                return 'style="' . implode(';', $styles) . '"';
            }
            return implode(';', $styles);
        }

        /* Functions for add shortcode param */
        public static function add_css_animation() {
            $add_css_animation = array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'CSS Animation', 'haru-pangja' ),
                'param_name' => 'css_animation',
                'value'      => array(
                    esc_html__( 'No', 'haru-pangja' )                   => '', 
                    esc_html__( 'Fade In', 'haru-pangja' )              => 'wpb_fadeIn', 
                    esc_html__( 'Fade Top to Bottom', 'haru-pangja' )   => 'wpb_fadeInDown', 
                    esc_html__( 'Fade Bottom to Top', 'haru-pangja' )   => 'wpb_fadeInUp', 
                    esc_html__( 'Fade Left to Right', 'haru-pangja' )   => 'wpb_fadeInLeft', 
                    esc_html__( 'Fade Right to Left', 'haru-pangja' )   => 'wpb_fadeInRight', 
                    esc_html__( 'Bounce In', 'haru-pangja' )            => 'wpb_bounceIn', 
                    esc_html__( 'Bounce Top to Bottom', 'haru-pangja' ) => 'wpb_bounceInDown', 
                    esc_html__( 'Bounce Bottom to Top', 'haru-pangja' ) => 'wpb_bounceInUp', 
                    esc_html__( 'Bounce Left to Right', 'haru-pangja' ) => 'wpb_bounceInLeft', 
                    esc_html__( 'Bounce Right to Left', 'haru-pangja' ) => 'wpb_bounceInRight', 
                    esc_html__( 'Zoom In', 'haru-pangja' )              => 'wpb_zoomIn', 
                    esc_html__( 'Flip Vertical', 'haru-pangja' )        => 'wpb_flipInX', 
                    esc_html__( 'Flip Horizontal', 'haru-pangja' )      => 'wpb_flipInY', 
                    esc_html__( 'Bounce', 'haru-pangja' )               => 'wpb_bounce', 
                    esc_html__( 'Flash', 'haru-pangja' )                => 'wpb_flash', 
                    esc_html__( 'Shake', 'haru-pangja' )                => 'wpb_shake', 
                    esc_html__( 'Pulse', 'haru-pangja' )                => 'wpb_pulse', 
                    esc_html__( 'Swing', 'haru-pangja' )                => 'wpb_swing', 
                    esc_html__( 'Rubber band', 'haru-pangja' )          => 'wpb_rubberBand', 
                    esc_html__( 'Wobble', 'haru-pangja' )               => 'wpb_wobble', 
                    esc_html__( 'Tada', 'haru-pangja' )                 => 'wpb_tada'),
                'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'haru-pangja' ),
                'group'       => esc_html__( 'Animation Settings', 'haru-pangja' )
            );
            return $add_css_animation;
        }

        public static function add_duration_animation() {
            $add_duration_animation = array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Animation Duration', 'haru-pangja' ),
                'param_name'  => 'duration',
                'value'       => '',
                'description' => esc_html__( 'Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'haru-pangja' ),
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
                'group'      => esc_html__( 'Animation Settings', 'haru-pangja' )
            );
            return $add_duration_animation;
        }

        public static function add_delay_animation() {
            $add_delay_animation = array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Animation Delay', 'haru-pangja' ),
                'param_name'  => 'delay',
                'value'       => '',
                'description' => esc_html__( 'Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'haru-pangja' ),
                'dependency'  => array(
                    'element' => 'css_animation', 
                    'value' => array(
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
                'group'       => esc_html__( 'Animation Settings', 'haru-pangja' )
            );
            return $add_delay_animation;
        }

        public static function add_el_class() {
            $add_el_class = array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Extra class name', 'haru-pangja' ),
                'param_name'  => 'el_class',
                'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'haru-pangja' ),
            );
            return $add_el_class;
        }

    }

    if ( ! function_exists('init_haru_framework_shortcodes') ) {
        function init_haru_framework_shortcodes() {
            return Haru_PangjaCore_Shortcodes::init();
        }

        init_haru_framework_shortcodes();
    }
}