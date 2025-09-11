<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

$haru_header_layout = haru_get_header_layout();

/* Process logo */
$logo = get_post_meta( get_the_ID(), 'haru_'.'logo', true );
if ( $logo ) {
    $logo_url = wp_get_attachment_url( $logo );
} else {
    $logo = haru_get_option('haru_logo');
    if ( isset($logo) && isset($logo['url']) ) {
        $logo_url = $logo['url'];
    }
    // Set default
    if ( empty($logo_url) ) {
        $logo_url = get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo.png';
    }
}

/* Process logo Black */
$logo_black = get_post_meta( get_the_ID(), 'haru_'.'logo_black', true );
if ( $logo_black ) {
    $logo_black_url = wp_get_attachment_url( $logo_black );
} else {
    $logo_black = haru_get_option('haru_logo_black');
    if ( isset($logo_black) && isset($logo_black['url']) ) {
        $logo_black_url = $logo_black['url'];
    }
    // Set default
    if ( empty($logo_black_url) ) {
        $logo_black_url = get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo-black.png';
    }
}

// Retina Logo
$logo_retina = get_post_meta( get_the_ID(), 'haru_'.'logo_retina', true );
if ( $logo_retina ) {
    $logo_retina_url = wp_get_attachment_url( $logo_retina );
} else {
    $logo_retina = haru_get_option('haru_logo_retina');
    if ( isset($logo_retina) && isset($logo_retina['url']) ) {
        $logo_retina_url = $logo_retina['url'];
    }
    // Set default
    if ( empty($logo_retina_url) ) {
        $logo_retina_url = get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo@2x.png';
    }
}

/* Process sticky logo */
$logo_sticky = get_post_meta( get_the_ID(), 'haru_'.'sticky_logo', true );
if ( $logo_sticky ) {
    $logo_sticky_url = wp_get_attachment_url( $logo_sticky );
} else {
    $logo_sticky = haru_get_option('haru_sticky_logo');
    if ( isset($logo_sticky) && isset($logo_sticky['url']) ) {
        $logo_sticky_url = $logo_sticky['url'];
    }
    // Set default
    if ( empty($logo_sticky_url) ) {
        $logo_sticky_url = get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo-white.png';
    }
}

$header_logo_class = array('header-logo');
if ( !empty($logo_sticky) && ($logo_sticky != $logo_url) ) {
    $header_logo_class[] = 'has-logo-sticky';
}

?>

<div class="<?php echo esc_attr( join(' ', $header_logo_class) ); ?>">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-default" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
        <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
    </a>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-black" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
        <img src="<?php echo esc_url($logo_black_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
    </a>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-retina" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
        <img src="<?php echo esc_url($logo_retina_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
    </a>
    <?php if ( !empty($logo_sticky_url) ) : // Doesn't need check ($logo_sticky != $logo_url) ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-sticky" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>">
        <img src="<?php echo esc_url($logo_sticky_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
    </a>
    <?php endif;?>
</div>