<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

add_action( 'wp_ajax_haru_get_product_content_creative', 'haru_get_product_content_creative' );
add_action( 'wp_ajax_nopriv_haru_get_product_content_creative', 'haru_get_product_content_creative' );

if( !function_exists('haru_get_product_content_creative') ) {
	function haru_get_product_content_creative( $atts ) {
		if( empty($_POST['atts']) || empty($_POST['product_cat']) ) {
			die('0');
		}
		$atts        = $_POST['atts'];
		$product_cat = $_POST['product_cat'];
		$is_all_tab  = (isset($_POST['is_all_tab']) && $_POST['is_all_tab']) ? true : false;

		ob_start();
		extract($atts);

		$args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $per_page,
			'orderby'             => 'date',
			'order'               => 'desc',
			'meta_query'          => array(
				
			)
		);			
		
		$args['tax_query'] = array(
								array(
									'taxonomy' => 'product_cat',
									'terms'    => array_map('sanitize_title', explode(',', $product_cat)),
									'field'    => 'slug',
									'operator' => 'IN'
								)
							);
		
		$products = new WP_Query( $args );

		if ( $product_type == 'top_rated' ) {
			remove_filter('posts_clauses', array(WC()->query, 'order_by_rating_post_clauses'));
		}

		// Add class if layout_type is carousel
		$slider_class = '';
		if ( $atts['layout_type'] == 'slider' ) {
			$slider_class = ' owl-carousel owl-theme';
		}

		echo '<ul class="products columns-4' . $slider_class .' clearfix ">';

		if ( $products->have_posts() ) {	
			if ( isset($products->found_posts, $products->post_count) && $products->found_posts == $products->post_count ) {
				// echo '<div class="hidden hide-see-more"></div>';
			}

            $plugin_path = untrailingslashit(plugin_dir_path(__FILE__));
            // Product style
            switch ($product_style) {
                case 'style_1':
                    $product_template_path = $plugin_path . '/product-style/style_1.php';
                    break;
                case 'style_2':
                    $product_template_path = $plugin_path . '/product-style/style_2.php';
                    break;
                default:
                    $product_template_path = $plugin_path . '/product-style/style_1.php';
            }

			while( $products->have_posts() ) { 
				$products->the_post();
                if ( $product_style == 'default' ) {
                    wc_get_template_part( 'content', 'product' ); 
                } else {
                    include($product_template_path);
                }
			}
		}

		echo '</ul>';

		wp_reset_postdata();
		
		die(ob_get_clean());
	}
}