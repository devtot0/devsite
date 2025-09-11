<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@HaruTheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://HaruTheme.com
*/

/* Required functions for VC */
function haru_vcSetAsTheme() {
    vc_set_as_theme();
}
add_action( 'vc_before_init', 'haru_vcSetAsTheme' );

/* Set new directory for vc templates */ 
vc_set_shortcodes_templates_dir( get_template_directory() . '/framework/vc_extension/templates');

/* Functions for custom VC display at front-end */
function haru_get_css_animation( $css_animation ) {
    $output = '';
    if ( $css_animation != '' ) {
        wp_enqueue_script( 'vc_waypoints' );
        $output = ' wpb_animate_when_almost_visible haru-css-animation ' . $css_animation;
    }
    return $output;
}

function haru_get_style_animation( $duration, $delay ) {
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

function haru_convert_hex_to_rgba( $hex, $opacity = 1 ) {
    $hex = str_replace("#", "", $hex);
    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgba = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';
    return $rgba;
}

// Add new font icon
/**
 * Register Backend and Frontend CSS Styles
 */
add_action( 'vc_base_register_front_css', 'haru_vc_iconpicker_base_register_css' );
add_action( 'vc_base_register_admin_css', 'haru_vc_iconpicker_base_register_css' );
function haru_vc_iconpicker_base_register_css(){
    wp_register_style('simpleline', get_template_directory_uri() . '/assets/libraries/simpleline/css/simple-line-icons.css');
}
/**
 * Enqueue Backend and Frontend CSS Styles
 */
add_action( 'vc_backend_editor_enqueue_js_css', 'haru_vc_iconpicker_editor_jscss' );
add_action( 'vc_frontend_editor_enqueue_js_css', 'haru_vc_iconpicker_editor_jscss' );
function haru_vc_iconpicker_editor_jscss(){
    wp_enqueue_style( 'simpleline' );
}
/**
 * Define the Icons for VC Iconpicker
 */
add_filter( 'vc_iconpicker-type-simpleline', 'vc_iconpicker_type_simpleline' );
function vc_iconpicker_type_simpleline( $icons ) {
    $simpleline_icons = array(
        // Icon Box
        array('simpline icon-rocket'            => 'icon-rocket'),
        array('simpline icon-earphones-alt'     => 'icon-earphones-alt'),
        array('simpline icon-diamond'           => 'icon-diamond'),
        array('simpline icon-plane'             => 'icon-plane'),
        array('simpline icon-user'              => 'icon-user'),
        array('simpline icon-emotsmile'         => 'icon-emotsmile'),
        array('simpline icon-heart'             => 'icon-heart'),
    );

    return array_merge( $icons, $simpleline_icons );
}