<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

// Widget helper
include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/widgets/widget-custom-class.php' );
// Widgets
include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/widgets/haru-widget.php' );
include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/widgets/haru-acf-widget.php' );
include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/widgets/haru-post-thumbnail.php' );
include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/widgets/haru-social-profile-widget.php' );
include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/widgets/haru-my-account.php' );
include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/widgets/haru-banner.php' );
include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/widgets/haru-vertical-menu.php' );
include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/widgets/haru-widget-product-sorting.php' );
include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/widgets/haru-widget-price-filter.php' );
include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/widgets/haru-widget-color-filter.php' );
// include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/widgets/haru-product-search.php' );
// include_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/widgets/twitter.php' );

// Functions display social icon
if ( !function_exists('haru_get_social_icon') ) {
	function haru_get_social_icon( $icons, $class = '' ) {
		$twitter = '';
		if ( NULL !== haru_get_option('haru_twitter_url') ) {
			$twitter = haru_get_option('haru_twitter_url');
		}

		$facebook = '';
		if ( NULL !== haru_get_option('haru_facebook_url') ) {
			$facebook = haru_get_option('haru_facebook_url');
		}

		$vimeo = '';
		if ( NULL !== haru_get_option('haru_vimeo_url') ) {
			$vimeo = haru_get_option('haru_vimeo_url');
		}

		$linkedin = '';
		if ( NULL !== haru_get_option('haru_linkedin_url') ) {
			$linkedin = haru_get_option('haru_linkedin_url');
		}

		$googleplus = '';
		if ( NULL !== haru_get_option('haru_googleplus_url') ) {
			$googleplus = haru_get_option('haru_googleplus_url');
		}

		$flickr = '';
		if ( NULL !== haru_get_option('haru_flickr_url') ) {
			$flickr = haru_get_option('haru_flickr_url');
		}

		$youtube = '';
		if ( NULL !== haru_get_option('haru_youtube_url') ) {
			$youtube = haru_get_option('haru_youtube_url');
		}

		$pinterest = '';
		if ( NULL !== haru_get_option('haru_pinterest_url') ) {
			$pinterest = haru_get_option('haru_pinterest_url');
		}

		$instagram = '';
		if ( NULL !== haru_get_option('haru_instagram_url') ) {
			$instagram = haru_get_option('haru_instagram_url');
		}

		$behance = '';
		if ( NULL !== haru_get_option('haru_behance_url') ) {
			$behance = haru_get_option('haru_behance_url');
		}

		$social_icons = '<ul class="'. $class .'">';

		if ( empty( $icons ) ) {
			if ( $twitter ) {
				$social_icons .= '<li><a title="'. esc_html__('Twitter','haru-pangja') .'" href="' . esc_url( $twitter ) . '" target="_blank"><i class="fa fa-twitter"></i>'. esc_html__('Twitter','haru-pangja') .'</a></li>' . "\n";
			}
			if ( $facebook ) {
				$social_icons .= '<li><a title="'. esc_html__('Facebook','haru-pangja') .'" href="' . esc_url( $facebook ) . '" target="_blank"><i class="fa fa-facebook"></i>'. esc_html__('Facebook','haru-pangja') .'</a></li>' . "\n";
			}
			if ( $youtube ) {
				$social_icons .= '<li><a title="'. esc_html__('Youtube','haru-pangja') .'" href="' . esc_url( $youtube ) . '" target="_blank"><i class="fa fa-youtube"></i>'. esc_html__('Youtube','haru-pangja') .'</a></li>' . "\n";
			}
			if ( $vimeo ) {
				$social_icons .= '<li><a title="'. esc_html__('Vimeo','haru-pangja') .'" href="' . esc_url( $vimeo ) . '" target="_blank"><i class="fa fa-vimeo-square"></i>'. esc_html__('Vimeo','haru-pangja') .'</a></li>' . "\n";
			}
			if ( $linkedin ) {
				$social_icons .= '<li><a title="'. esc_html__('Linkedin','haru-pangja') .'" href="' . esc_url( $linkedin ) . '" target="_blank"><i class="fa fa-linkedin"></i>'. esc_html__('Linkedin','haru-pangja') .'</a></li>' . "\n";
			}
			if ( $googleplus ) {
				$social_icons .= '<li><a title="'. esc_html__('GooglePlus','haru-pangja') .'" href="' . esc_url( $googleplus ) . '" target="_blank"><i class="fa fa-google-plus"></i>'. esc_html__('GooglePlus','haru-pangja') .'</a></li>' . "\n";
			}
			if ( $flickr ) {
				$social_icons .= '<li><a title="'. esc_html__('Flickr','haru-pangja') .'" href="' . esc_url( $flickr ) . '" target="_blank"><i class="fa fa-flickr"></i>'. esc_html__('Flickr','haru-pangja') .'</a></li>' . "\n";
			}
			if ( $pinterest ) {
				$social_icons .= '<li><a title="'. esc_html__('Pinterest','haru-pangja') .'" href="' . esc_url( $pinterest ) . '" target="_blank"><i class="fa fa-pinterest"></i>'. esc_html__('Pinterest','haru-pangja') .'</a></li>' . "\n";
			}
			if ( $instagram ) {
				$social_icons .= '<li><a title="'. esc_html__('Instagram','haru-pangja') .'" href="' . esc_url( $instagram ) . '" target="_blank"><i class="fa fa-instagram"></i>'. esc_html__('Instagram','haru-pangja') .'</a></li>' . "\n";
			}
			if ( $behance ) {
				$social_icons .= '<li><a title="'. esc_html__('Behance','haru-pangja') .'" href="' . esc_url( $behance ) . '" target="_blank"><i class="fa fa-behance"></i>'. esc_html__('Behance','haru-pangja') .'</a></li>' . "\n";
			}
		} else {

			$social_type = explode( '||', $icons );
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

			foreach ( $social_type as $id ) {
				if ( ( $id == 'twitter' ) && $twitter ) {
					$social_icons .= '<li><a title="'. esc_html__('Twitter','haru-pangja') .'" href="' . esc_url( $twitter ) . '" target="_blank"><i class="fa fa-twitter"></i>'. esc_html__('Twitter','haru-pangja') .'</a></li>' . "\n";
				}
				if ( ( $id == 'facebook' ) && $facebook ) {
					$social_icons .= '<li><a title="'. esc_html__('Facebook','haru-pangja') .'" href="' . esc_url( $facebook ) . '" target="_blank"><i class="fa fa-facebook"></i>'. esc_html__('Facebook','haru-pangja') .'</a></li>' . "\n";
				}
				if ( ( $id == 'youtube' ) && $youtube ) {
					$social_icons .= '<li><a title="'. esc_html__('Youtube','haru-pangja') .'" href="' . esc_url( $youtube ) . '" target="_blank"><i class="fa fa-youtube"></i>'. esc_html__('Youtube','haru-pangja') .'</a></li>' . "\n";
				}
				if ( ( $id == 'vimeo' ) && $vimeo ) {
					$social_icons .= '<li><a title="'. esc_html__('Vimeo','haru-pangja') .'" href="' . esc_url( $vimeo ) . '" target="_blank"><i class="fa fa-vimeo-square"></i>'. esc_html__('Vimeo','haru-pangja') .'</a></li>' . "\n";
				}
				if ( ( $id == 'linkedin' ) && $linkedin ) {
					$social_icons .= '<li><a title="'. esc_html__('Linkedin','haru-pangja') .'" href="' . esc_url( $linkedin ) . '" target="_blank"><i class="fa fa-linkedin"></i>'. esc_html__('Linkedin','haru-pangja') .'</a></li>' . "\n";
				}
				if ( ( $id == 'googleplus' ) && $googleplus ) {
					$social_icons .= '<li><a title="'. esc_html__('GooglePlus','haru-pangja') .'" href="' . esc_url( $googleplus ) . '" target="_blank"><i class="fa fa-google-plus"></i>'. esc_html__('GooglePlus','haru-pangja') .'</a></li>' . "\n";
				}
				if ( ( $id == 'flickr' ) && $flickr ) {
					$social_icons .= '<li><a title="'. esc_html__('Flickr','haru-pangja') .'" href="' . esc_url( $flickr ) . '" target="_blank"><i class="fa fa-flickr"></i>'. esc_html__('Flickr','haru-pangja') .'</a></li>' . "\n";
				}
				if ( ( $id == 'pinterest' ) && $pinterest ) {
					$social_icons .= '<li><a title="'. esc_html__('Pinterest','haru-pangja') .'" href="' . esc_url( $pinterest ) . '" target="_blank"><i class="fa fa-pinterest"></i>'. esc_html__('Pinterest','haru-pangja') .'</a></li>' . "\n";
				}
				if ( ( $id == 'instagram' ) && $instagram ) {
					$social_icons .= '<li><a title="'. esc_html__('Instagram','haru-pangja') .'" href="' . esc_url( $instagram ) . '" target="_blank"><i class="fa fa-instagram"></i>'. esc_html__('Instagram','haru-pangja') .'</a></li>' . "\n";
				}
				if ( ( $id == 'behance' ) && $behance ) {
					$social_icons .= '<li><a title="'. esc_html__('Behance','haru-pangja') .'" href="' . esc_url( $behance ) . '" target="_blank"><i class="fa fa-behance"></i>'. esc_html__('Behance','haru-pangja') .'</a></li>' . "\n";
				}
			}
		}

		$social_icons .= '</ul>';

		return $social_icons;
	}
}
