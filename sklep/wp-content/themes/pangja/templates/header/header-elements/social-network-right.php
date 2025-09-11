<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

$enable_header_elements = get_post_meta( get_the_ID(), 'haru_enable_header_elements_right', true );
$header_social_network = array();
if ($enable_header_elements == '1') {
    $header_social_network = get_post_meta( get_the_ID(), 'haru_header_elements_right_social_network', false );
} else {
    if ( haru_get_option('haru-option-header-elements-right') == '1' ) {
        $header_social_network = haru_get_option('haru_header_elements_right_social_network');
    } else {
        return;
    }
}

$twitter = '';
$twitter_url = haru_get_option('haru_twitter_url');
if ( isset($twitter_url) ) {
    $twitter = $twitter_url;
}

$facebook = '';
$facebook_url = haru_get_option('haru_facebook_url');
if ( isset($facebook_url) ) {
    $facebook = $facebook_url;
}

$vimeo = '';
$vimeo_url = haru_get_option('haru_vimeo_url');
if ( isset($vimeo_url) ) {
    $vimeo = $vimeo_url;
}

$linkedin = '';
$linkedin_url = haru_get_option('haru_linkedin_url');
if ( isset($linkedin_url) ) {
    $linkedin = $linkedin_url;
}

$googleplus = '';
$googleplus_url = haru_get_option('haru_googleplus_url');
if ( isset($googleplus_url) ) {
    $googleplus = $googleplus_url;
}

$flickr = '';
$flickr_url = haru_get_option('haru_flickr_url');
if ( isset($flickr_url) ) {
    $flickr = $flickr_url;
}

$youtube = '';
$youtube_url = haru_get_option('haru_youtube_url');
if ( isset($youtube_url) ) {
    $youtube = $youtube_url;
}

$pinterest = '';
$pinterest_url = haru_get_option('haru_pinterest_url');
if ( isset($pinterest_url) ) {
    $pinterest = $pinterest_url;
}

$instagram = '';
$instagram_url = haru_get_option('haru_instagram_url');
if ( isset($instagram_url) ) {
    $instagram = $instagram_url;
}

$behance = '';
$behance_url = haru_get_option('haru_behance_url');
if ( isset($behance_url) ) {
    $behance = $behance_url;
}

$social_icons = '';

if ( ($header_social_network == array()) || (empty( $header_social_network )) ) {
    if ( $twitter ) {
        $social_icons .= '<li><a href="' . esc_url( $twitter ) . '" target="_blank"><i class="header-icon fa fa-twitter"></i></a></li>' . "\n";
    }
    if ( $facebook ) {
        $social_icons .= '<li><a href="' . esc_url( $facebook ) . '" target="_blank"><i class="header-icon fa fa-facebook"></i></a></li>' . "\n";
    }
    if ( $youtube ) {
        $social_icons .= '<li><a href="' . esc_url( $youtube ) . '" target="_blank"><i class="header-icon fa fa-youtube"></i></a></li>' . "\n";
    }
    if ( $vimeo ) {
        $social_icons .= '<li><a href="' . esc_url( $vimeo ) . '" target="_blank"><i class="header-icon fa fa-vimeo"></i></a></li>' . "\n";
    }
    if ( $linkedin ) {
        $social_icons .= '<li><a href="' . esc_url( $linkedin ) . '" target="_blank"><i class="header-icon fa fa-linkedin"></i></a></li>' . "\n";
    }
    if ( $googleplus ) {
        $social_icons .= '<li><a href="' . esc_url( $googleplus ) . '" target="_blank"><i class="header-icon fa fa-google"></i></a></li>' . "\n";
    }
    if ( $flickr ) {
        $social_icons .= '<li><a href="' . esc_url( $flickr ) . '" target="_blank"><i class="header-icon fa fa-flickr"></i></a></li>' . "\n";
    }
    if ( $pinterest ) {
        $social_icons .= '<li><a href="' . esc_url( $pinterest ) . '" target="_blank"><i class="header-icon fa fa-pinterest"></i></a></li>' . "\n";
    }
    if ( $instagram ) {
        $social_icons .= '<li><a href="' . esc_url( $instagram ) . '" target="_blank"><i class="header-icon fa fa-instagram"></i></a></li>' . "\n";
    }
    if ( $behance ) {
        $social_icons .= '<li><a href="' . esc_url( $behance ) . '" target="_blank"><i class="header-icon fa fa-github"></i></a></li>' . "\n";
    }
} else {
    if (empty($twitter)) { $twitter = '#'; }
    if (empty($facebook)) { $facebook = '#'; }
    if (empty($youtube)) { $youtube = '#'; }
    if (empty($vimeo)) { $vimeo = '#'; }
    if (empty($linkedin)) { $linkedin = '#'; }
    if (empty($googleplus)) { $googleplus = '#'; }
    if (empty($flickr)) { $flickr = '#'; }
    if (empty($pinterest)) { $pinterest = '#'; }
    if (empty($instagram)) { $instagram = '#'; }
    if (empty($behance)) { $behance = '#'; }

    foreach ( $header_social_network as $id ) {
        if ( ( $id == 'twitter' ) && $twitter ) {
            $social_icons .= '<li><a href="' . esc_url( $twitter ) . '" target="_blank"><i class="header-icon fa fa-twitter"></i></a></li>' . "\n";
        }
        if ( ( $id == 'facebook' ) && $facebook ) {
            $social_icons .= '<li><a href="' . esc_url( $facebook ) . '" target="_blank"><i class="header-icon fa fa-facebook"></i></a></li>' . "\n";
        }
        if ( ( $id == 'youtube' ) && $youtube ) {
            $social_icons .= '<li><a href="' . esc_url( $youtube ) . '" target="_blank"><i class="header-icon fa fa-youtube"></i></a></li>' . "\n";
        }
        if ( ( $id == 'vimeo' ) && $vimeo ) {
            $social_icons .= '<li><a href="' . esc_url( $vimeo ) . '" target="_blank"><i class="header-icon fa fa-vimeo"></i></a></li>' . "\n";
        }
        if ( ( $id == 'linkedin' ) && $linkedin ) {
            $social_icons .= '<li><a href="' . esc_url( $linkedin ) . '" target="_blank"><i class="header-icon fa fa-linkedin"></i></a></li>' . "\n";
        }
        if ( ( $id == 'googleplus' ) && $googleplus ) {
            $social_icons .= '<li><a href="' . esc_url( $googleplus ) . '" target="_blank"><i class="header-icon fa fa-google"></i></a></li>' . "\n";
        }
        if ( ( $id == 'flickr' ) && $flickr ) {
            $social_icons .= '<li><a href="' . esc_url( $flickr ) . '" target="_blank"><i class="header-icon fa fa-flickr"></i></a></li>' . "\n";
        }
        if ( ( $id == 'pinterest' ) && $pinterest ) {
            $social_icons .= '<li><a href="' . esc_url( $pinterest ) . '" target="_blank"><i class="header-icon fa fa-pinterest"></i></a></li>' . "\n";
        }
        if ( ( $id == 'instagram' ) && $instagram ) {
            $social_icons .= '<li><a href="' . esc_url( $instagram ) . '" target="_blank"><i class="header-icon fa fa-instagram"></i></a></li>' . "\n";
        }
        if ( ( $id == 'behance' ) && $behance ) {
            $social_icons .= '<li><a href="' . esc_url( $behance ) . '" target="_blank"><i class="header-icon fa fa-github"></i></a></li>' . "\n";
        }
    }
}
if ( empty($social_icons) ) {
    return;
}
?>
<ul class="header-elements-item header-social-network-wrap">
    <?php echo wp_kses_post( $social_icons ); ?>
</ul>