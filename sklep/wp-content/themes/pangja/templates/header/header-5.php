<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

$header_class = array('haru-main-header', 'header-5');
// Header Over Slideshow
$header_layout_over_slideshow = get_post_meta( get_the_ID(), 'haru_' . 'header_layout_over_slideshow', true );
if ( ($header_layout_over_slideshow == '') || ($header_layout_over_slideshow == '-1') ) {
    $header_layout_over_slideshow = haru_get_option('haru_header_layout_over_slideshow');
}
if ($header_layout_over_slideshow == '1') {
    $header_class[] = 'header-over-slideshow';
    // Header Over Slideshow Menu Color
    $header_navigation_skin = get_post_meta( get_the_ID(), 'haru_' . 'header_navigation_skin', true );
    if ( ($header_navigation_skin == '') || ($header_navigation_skin == '-1') ) {
        $header_navigation_skin = haru_get_option('haru_header_navigation_skin');
    }
    $header_class[] = $header_navigation_skin;

    // Hover Header On Slideshow
    $header_over_slideshow_hover = get_post_meta( get_the_ID(), 'haru_' . 'header_over_slideshow_hover', true );
    if ( ($header_over_slideshow_hover == '') || ($header_over_slideshow_hover == '-1') ) {
        $header_over_slideshow_hover = haru_get_option('haru_header_over_slideshow_hover');
    }
    if ($header_over_slideshow_hover == '1') {
        $header_class[] = 'header-hover-on';
    }
}

// Maybe use Header under slideshow option
$header_layout_under_slideshow = get_post_meta( get_the_ID(), 'haru_' . 'header_layout_under_slideshow', true );
if ( ($header_layout_under_slideshow == '') || ($header_layout_under_slideshow == '-1') ) {
    $header_layout_under_slideshow = haru_get_option('haru_header_layout_under_slideshow');
}
if ( $header_layout_under_slideshow == '1' ) {
    $header_class[] = 'header-under-slideshow';
}

// Header Sticky
$header_sticky = get_post_meta( get_the_ID(), 'haru_' . 'header_sticky', true );
if ( ($header_sticky == '') || ($header_sticky == '-1') ) {
    $header_sticky = haru_get_option('haru_header_sticky');
}
if ( $header_sticky == '1' ) {
    $header_class[] = 'header-sticky';
}
// Sticky Skin
$header_sticky_skin = get_post_meta( get_the_ID(), 'haru_' . 'header_sticky_skin', true );
if ( ($header_sticky_skin == '') || ($header_sticky_skin == '-1') ) {
    $header_sticky_skin = haru_get_option('haru_header_sticky_skin');
}
$header_class[] = $header_sticky_skin;

// Header navigation layout
$header_nav_layout = get_post_meta( get_the_ID(), 'haru_' . 'header_nav_layout', true );
if ( ($header_nav_layout == '') || ($header_nav_layout == '-1') ) {
    $header_nav_layout = haru_get_option('haru_header_nav_layout');
}
// Set Default
if ( isset($header_nav_layout) ) {
    $header_nav_layout = 'container';
}

?>
<header id="haru-header" class="<?php echo esc_attr( join(' ', $header_class) ); ?>">
    <div class="haru-header-nav-wrap">
        <div class="row header-nav-above d-flex justify-content-between">
            <div class="col-md-4 header-left header-elements align-self-center">
                <?php get_template_part('templates/header/header-logo' ); ?>
            </div>
            <div class="col-md-4 header-center align-self-center">
                
            </div>
            <div class="col-md-4 header-right header-elements align-self-center">
                <?php get_template_part('templates/header/header-elements', 'right' ); ?>
                <?php if (has_nav_menu('popup')) : ?>
                    <?php get_template_part('templates/header/header-elements/popup-menu' ); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>