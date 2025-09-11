<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/
global $woocommerce, $paged;

extract( $atts );

// Get products
$product_ids_on_sale = wc_get_product_ids_on_sale();

$ordering_args = WC()->query->get_catalog_ordering_args($orderby, $order);
$meta_query    = WC()->query->get_meta_query();

$args = array(
    'post_type'           => 'product',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
    'orderby'             => $ordering_args['orderby'], // meta_value_num
    'order'               => $ordering_args['order'],
    'posts_per_page'      => $products_per_page,
    'meta_query'          => $meta_query,
    'post__in'            => array_merge( array( 0 ), $product_ids_on_sale )
);
$products = new WP_Query($args);
// Enqueue assets
wp_enqueue_script( 'countdown-number', plugins_url() . '/haru-pangja-core/includes/shortcodes/countdown/assets/js/jquery.countdown.js', false, true );
            
if( $layout_type == 'carousel' ) {
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/libraries/owl-carousel/assets/owl.carousel.min.css', array(),false );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/libraries/owl-carousel/owl.carousel.min.js', false, true );
}
// Product style
if ( $layout_type == 'carousel_1' ) {
    $sale_style = 'top_product';
} elseif ( $layout_type == 'carousel_2' ) {
    $sale_style = 'sale_style_1';
} else {
    $sale_style = 'top_product';               
}
?>
<?php if ( $products->have_posts() ) : ?>
    <div class="products-top-sale-shortcode-wrap <?php echo esc_attr($layout_type . ' ' .$el_class) ?>">
        <?php if ( $title ) : ?>
        <h5 class="products-title"><?php echo esc_html($title); ?></h5>
        <?php endif; ?>
        <div class="haru-carousel products owl-carousel owl-theme"
            data-items="<?php echo esc_attr($columns); ?>"
            data-items-tablet="1"
            data-items-mobile="1"
            data-margin="20"
            data-autoplay="<?php echo esc_attr($autoplay); ?>"
            data-slide-duration="<?php echo esc_attr($slide_duration); ?>"
        >
        <?php 
        $i = 1;
        while ( $products->have_posts() ) : $products->the_post(); ?>
            <?php if ( ($i == 1) || ( ($i%$rows) == 1) || ($rows == 1)) : ?>
            <ul class="item-carousel">
            <?php endif; ?>
                <?php echo haru_get_template('products/product-style/'. $sale_style .'.php', '', '', '' ); ?>
            <?php if ( (($i%$rows) == 0)  || ($rows == 1) ) : ?>
            </ul>
            <?php endif; ?>

        <?php $i++; endwhile; // end of the loop. ?>
        </div>
    </div>
<?php else : ?>
    <div class="item-not-found"><?php echo esc_html__( 'No item found', 'haru-pangja' ) ?></div>
<?php endif; ?>