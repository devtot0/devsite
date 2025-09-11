<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

$header_class = array('haru-main-header', 'header-2');
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
            <div class="col-lg-2 col-md-2 header-left header-elements align-self-center">
                <?php get_template_part('templates/header/header-elements', 'left' ); ?>
            </div>
            <div class="col-lg-8 col-md-8 header-center d-flex align-self-center align-items-center">
                <!-- Menu Left -->
                <div class="menu-left header-navigation navbar navbar-toggleable-md" role="navigation">
                    <div id="left-menu-primary" class="menu-wrap">
                        <?php
                            $arg_menu = array(
                                'menu_id'        => 'left-menu',
                                'container'      => '',
                                'theme_location' => 'left',
                                'menu_class'     => 'haru-main-menu nav-collapse navbar-nav nav-separate',
                                'fallback_cb'    => 'haru_please_set_menu',
                                'walker'         => new HARU_MegaMenu_Walker()
                            );
                            wp_nav_menu( $arg_menu );
                        ?>
                    </div>
                </div>
                <!-- Logo -->
                <div class="header-logo-wrap">
                    <?php get_template_part('templates/header/header-logo' ); ?>
                </div>
                <!-- Right Menu -->
                <div class="menu-right header-navigation navbar navbar-toggleable-md" role="navigation">
                    <div id="right-menu-primary" class="menu-wrap">
                        <?php
                            $arg_menu = array(
                                'menu_id'        => 'right-menu',
                                'container'      => '',
                                'theme_location' => 'right',
                                'menu_class'     => 'haru-main-menu nav-collapse navbar-nav nav-separate',
                                'fallback_cb'    => 'haru_please_set_menu',
                                'walker'         => new HARU_MegaMenu_Walker()
                            );
                            wp_nav_menu( $arg_menu );
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 header-right header-elements align-self-center">
                <?php get_template_part('templates/header/header-elements', 'right' ); ?>
            </div>
        </div>
    </div>
</header>