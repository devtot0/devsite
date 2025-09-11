<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

add_action( 'wp_ajax_haru_get_product_content_in_order_tab', 'haru_get_product_content_in_order_tab' );
add_action( 'wp_ajax_nopriv_haru_get_product_content_in_order_tab', 'haru_get_product_content_in_order_tab' );

if( !function_exists('haru_get_product_content_in_order_tab') ) {
	function haru_get_product_content_in_order_tab( $atts ) {
		if( empty($_POST['atts']) || empty($_POST['product_order']) ) {
			die('0');
		}

		$atts        		= $_POST['atts'];
		$product_order 	= $_POST['product_order'];

		ob_start();
		extract($atts);

		$args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $per_page,
		);
		// Query Order
		if ( $product_order == 'recent' ) {
			$args['orderby'] = 'date';
			$args['order'] = 'desc';
		} elseif ( $product_order == 'best_selling' ) {
			$args['meta_key'] = 'total_sales';
			$args['orderby'] = 'meta_value_num';
		} elseif ( $product_order == 'top_rated' ) {
			$ordering_args = WC()->query->get_catalog_ordering_args('date', 'desc');
			$meta_query    = WC()->query->get_meta_query();

			$args['meta_key'] 	= '_wc_average_rating';
			$args['orderby'] 		= $ordering_args['orderby'];
			$args['order'] 			= $ordering_args['order'];
			$args['meta_query'] = $meta_query;
		} elseif ( $product_order == 'sale' ) {
			$product_ids_on_sale = wc_get_product_ids_on_sale();
			$ordering_args = WC()->query->get_catalog_ordering_args('date', 'desc');
			$meta_query    = WC()->query->get_meta_query();

			$args['orderby'] 		= $ordering_args['orderby'];
			$args['order'] 			= $ordering_args['order'];
			$args['meta_query'] = $meta_query;
			$args['post__in'] 	= array_merge( array( 0 ), $product_ids_on_sale );
		} elseif ( $product_order == 'featured' ) {
			$meta_query  = WC()->query->get_meta_query();
    	$args['orderby'] = 'date';
			$args['order'] = 'desc';
    	$args['meta_query'] = $meta_query;
		} elseif ( $product_order == 'mixed_order' ) {
			$args['orderby'] = 'rand';
		} else {
			$args['orderby'] = 'date';
			$args['order'] = 'desc';
		}
		
		// Featured product is special
		if ( $product_order == 'featured' ) {
			$tax_query   = WC()->query->get_tax_query();
			$tax_query[] = array(
        'taxonomy' => 'product_visibility',
        'field'    => 'name',
        'terms'    => 'featured',
        'operator' => 'IN',
    	);
    	$tax_query[] = array(
        'taxonomy' => 'product_cat',
				'terms'    => array_map('sanitize_title', explode(',', $product_cats)),
				'field'    => 'slug',
				'operator' => 'IN'
    	);
    	$args['tax_query']  = $tax_query;
		} else {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'product_cat',
					'terms'    => array_map('sanitize_title', explode(',', $product_cats)),
					'field'    => 'slug',
					'operator' => 'IN'
				)
			);
		}
		
		$products = new WP_Query( $args );

		// Add class if layout_type is carousel
		$slider_class = '';
		if ( $atts['layout_type'] == 'slider' ) {
			$slider_class = ' owl-carousel owl-theme';
		}

		echo '<ul class="products columns-'. $atts['columns'] . $slider_class .' clearfix ">';

		if ( $products->have_posts() ) {	
      $plugin_path = untrailingslashit(plugin_dir_path(__FILE__));
      // Product style
      switch ($product_style) {
        case 'style_1':
          $product_template_path = $plugin_path . '/product-style/style_1.php';
          break;
        default:
          $product_template_path = $plugin_path . '/product-style/style_1.php';
      }
      // Process
      $i = 1;
			while( $products->have_posts() ) { 
				$products->the_post();
				// Slider row
				if ( $atts['layout_type'] == 'slider' ) {
					if ( ($i == 1) || ( ($i%$rows) == 1) || ($rows == 1) ) {
						echo '<div class="item-carousel">';
					}
				}
				// Product item
        if ( $product_style == 'default' ) {
          wc_get_template_part( 'content', 'product' ); 
        } else {
          include($product_template_path);
        }
        // End Slider row
        if ( $atts['layout_type'] == 'slider' ) {
        	if ( (($i%$rows) == 0)  || ($rows == 1) ) {
						echo '</div>';
					}
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