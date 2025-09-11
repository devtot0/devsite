<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/
global $woocommerce;

extract( $atts );

$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
$viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );

if ( empty( $viewed_products ) ) :
?>
<!-- <div class="products-recent-viewed-not-found"><?php echo esc_html__( 'No recent item viewed', 'haru-pangja' ) ?></div> -->
<?php
    endif;
?>
<?php
$query_args = array(
    'posts_per_page' => $per_page,
    'no_found_rows'  => 1,
    'post_status'    => 'publish',
    'post_type'      => 'product',
    'post__in'       => $viewed_products,
    'orderby'        => 'post__in',
);
if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
    $query_args['tax_query'] = array(
        array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'outofstock',
            'operator' => 'NOT IN',
        ),
    );
}
$products = new WP_Query( apply_filters( 'woocommerce_recently_viewed_products_widget_query_args', $query_args ) );

// Enqueue assets
wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/libraries/owl-carousel/assets/owl.carousel.min.css', array(),false );
wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/libraries/owl-carousel/owl.carousel.min.js', false, true );
?>
<?php if ( $products->have_posts() ) : ?>
    <div class="products-recent-viewed-shortcode-wrap <?php echo esc_attr($layout_type . ' ' .$el_class) ?>">
        <ul class="haru-carousel products owl-carousel owl-theme"
            data-items="<?php echo esc_attr($products_per_slide); ?>"
            data-items-tablet="3"
            data-items-mobile="2"
            data-margin="20"
            data-loop="false"
            data-autoplay="<?php echo esc_attr($autoplay); ?>"
            data-slide-duration="<?php echo esc_attr($slide_duration); ?>"
        >
        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
            <?php wc_get_template_part( 'content', 'product' ); ?>
        <?php endwhile; // end of the loop. ?>
        </ul>
    </div>
<?php else: ?>
    <div class="products-recent-viewed-not-found"><?php echo esc_html__( 'No recent item viewed', 'haru-pangja' ) ?></div>
<?php endif; ?>