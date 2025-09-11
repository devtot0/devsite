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

if (is_front_page()) {
    $paged   = get_query_var( 'page' ) ? intval( get_query_var( 'page' ) ) : 1;
} else {
    $paged   = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
}

// Get products
$ordering_args = $woocommerce->query->get_catalog_ordering_args($orderby, $order);
$meta_query    = $woocommerce->query->get_meta_query();

$args = array(
    'post_type'           => 'product',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
    'orderby'             => $ordering_args['orderby'],
    'order'               => $ordering_args['order'],
    'posts_per_page'      => $per_page,
    'meta_query'          => $meta_query,
    'paged'               => $paged
);

if ( ! empty($category) ) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'product_cat',
            'terms'    => array_map('sanitize_title', explode(',', $category)),
            'field'    => 'slug',
            'operator' => 'IN'
        )
    );
}

if (isset($ordering_args['meta_key'])) {
    $args['meta_key'] = $ordering_args['meta_key'];
}

// If data_source = product_IDs
if ( $data_source == 'product_list_id' ) {
     $args = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'orderby'        => $orderby,
        'order'          => $order,
        'posts_per_page' => $per_page,
        'post__in'       => explode( ',' , $product_ids ),
    );
}

$products = new WP_Query($args);
// Enqueue assets
wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/libraries/owl-carousel/assets/owl.carousel.min.css', array(),false );
wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/libraries/owl-carousel/owl.carousel.min.js', false, true );
?>
<?php if ( $products->have_posts() ) : ?>
    <div class="products-slider-shortcode-wrapper <?php echo esc_attr($layout_type . ' ' .$el_class) ?>">
        <ul class="haru-carousel products owl-carousel owl-theme"
            data-items="<?php echo esc_attr($products_per_slide); ?>"
            data-items-tablet="3"
            data-items-mobile="2"
            data-margin="20"
            data-autoplay="<?php echo esc_attr($autoplay); ?>"
            data-slide-duration="<?php echo esc_attr($slide_duration); ?>"
        >
        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
            <?php wc_get_template_part( 'content', 'product' ); ?>
        <?php endwhile; // end of the loop. ?>
        </ul>
    </div>
<?php else : ?>
    <div class="item-not-found"><?php echo esc_html__( 'No item found', 'haru-pangja' ) ?></div>
<?php endif; ?>