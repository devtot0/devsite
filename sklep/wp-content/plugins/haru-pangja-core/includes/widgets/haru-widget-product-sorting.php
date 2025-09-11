<?php
/**
 *	Haru Widget: Product Sorting List
 *
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Haru_WC_Widget_Product_Sorting extends Haru_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    	= 'haru_widget haru_widget_product_sorting woocommerce';
		$this->widget_description	= esc_html__( 'Display a product sorting list.', 'haru-pangja' );
		$this->widget_id          	= 'haru_woocommerce_widget_product_sorting';
		$this->widget_name        	= esc_html__( 'Haru WooCommerce Product Sorting', 'haru-pangja' );
		$this->settings           	= array(
			'title'  => array(
				'type'  => 'text',
				'std'   => esc_html__( 'Sort By', 'haru-pangja' ),
				'label'	=> esc_html__( 'Title', 'haru-pangja' )
			)
		);
		
		parent::__construct();
	}

	/**
	 * Widget function
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	public function widget( $args, $instance ) {
		global $wp_query;
		
		extract( $args );
		
		$title = ( ! empty( $instance['title'] ) ) ? $before_title . $instance['title'] . $after_title : '';
		
		$output = '';
		
		if ( 1 != $wp_query->found_posts || woocommerce_products_will_display() ) {
			$output .= '<ul id="haru-product-sorting" class="haru-product-sorting">';
			
			$orderby = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
			$orderby == ( $orderby ===  'title' ) ? 'menu_order' : $orderby; // Fixed: 'title' is default before WooCommerce settings are saved
			
			$catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
				'menu_order'	=> esc_html__( 'Default', 'haru-pangja' ),
				'popularity' 	=> esc_html__( 'Popularity', 'haru-pangja' ),
				'rating'     	=> esc_html__( 'Average rating', 'haru-pangja' ),
				'date'       	=> esc_html__( 'Newest', 'haru-pangja' ),
				'price'      	=> esc_html__( 'Price: Low to High', 'haru-pangja' ),
				'price-desc'	=> esc_html__( 'Price: High to Low', 'haru-pangja' )
			) );
	
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
				unset( $catalog_orderby_options['rating'] );
			}
			
			/* Build entire current page URL (including query strings) */
			global $wp;
			$link = home_url( $wp->request ); // Base page URL
					
			// Unset query strings used for Ajax shop filters
			unset( $_GET['shop_load'] );
			unset( $_GET['_'] );
			
			$qs_count = count( $_GET );
			
			// Any query strings to add?
			if ( $qs_count > 0 ) {
				$i = 0;
				$link .= '?';
				
				// Build query string
				foreach ( $_GET as $key => $value ) {
					$i++;
					$link .= $key . '=' . $value;
					if ( $i != $qs_count ) {
						$link .= '&';
					}
				}
			}
			
      foreach ( $catalog_orderby_options as $id => $name ) {
				if ( $orderby == $id ) {
					$output .= '<li class="active">' . esc_attr( $name ) . '</li>';
				} else {
					// Add 'orderby' URL query string
					$link = add_query_arg( 'orderby', $id, $link );
					$output .= '<li><a href="' . esc_url( $link ) . '">' . esc_attr( $name ) . '</a></li>';
				}
      }
			       
    	$output .= '</ul>';
		}
		
		echo $before_widget . $title . $output . $after_widget;
	}
	
}
if ( ! function_exists('haru_register_product_sorting') ) {
	function haru_register_product_sorting() {
		register_widget('Haru_WC_Widget_Product_Sorting');
	}

	add_action('widgets_init', 'haru_register_product_sorting', 1);
}
