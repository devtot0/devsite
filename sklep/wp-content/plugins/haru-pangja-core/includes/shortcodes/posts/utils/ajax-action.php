<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

add_action( 'wp_ajax_haru_get_post_content_in_order_tab', 'haru_get_post_content_in_order_tab' );
add_action( 'wp_ajax_nopriv_haru_get_post_content_in_order_tab', 'haru_get_post_content_in_order_tab' );

if( !function_exists('haru_get_post_content_in_order_tab') ) {
	function haru_get_post_content_in_order_tab( $atts ) {
		if( empty($_POST['atts']) || empty($_POST['post_order']) ) {
			die('0');
		}

		$atts        		= $_POST['atts'];
		$post_order 	= $_POST['post_order'];

		ob_start();
		extract($atts);

		$args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $per_page,
		);
		// Query Order
		if ( $post_order == 'date' ) {
			$args['orderby'] = 'date';
			$args['order'] = 'desc';
		} elseif ( $post_order == 'comment_count' ) {
			$args['orderby'] = 'comment_count';
			$args['order'] = 'desc';
		} elseif ( $post_order == 'views' ) {
			$args['meta_key'] 		= 'post_views_count';
			$args['orderby'] 			= 'meta_value_num';
			$args['order'] = 'desc';
		} elseif ( $post_order == 'rand' ) {
			$args['orderby'] = 'rand';
		} else {
			$args['orderby'] = 'date';
			$args['order'] = 'desc';
		}
		
		$posts = new WP_Query( $args );

		echo '<ul class="posts-list clearfix ">';

		if ( $posts->have_posts() ) {	
			$plugin_path = untrailingslashit(plugin_dir_path(__FILE__));
      // Post style
      $post_special_template_path = $plugin_path . '/post-style/style_1.php';
      $post_template_path = $plugin_path . '/post-style/style_2.php';
      // Process
      $i = 1;
			while( $posts->have_posts() ) { 
				$posts->the_post();

				// Post item
        if ( $i == 1 ) {
          include($post_special_template_path);
        } else {
          include($post_template_path);
        }
        $i++;
			}

		} else {
			echo '<div class="item-not-found">' . esc_html__( 'No item found', 'haru-pangja' ) . '</div>';
		}

		echo '</ul>';

		wp_reset_postdata();
		
		die(ob_get_clean());
	}
}