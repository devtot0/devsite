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

$product_paging_class            = array('products-shortcode-paging-wrapper');
$product_paging_class[]          = 'paging-'.$paging_style;
$product_paging_class[]          = 'text-' . $paging_align;

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

?>
<?php if ( $products->have_posts() ) : ?>
    <div class="products-shortcode-wrapper list woocommerce <?php echo esc_attr($el_class); ?>"> <!-- Add woocommerce class to make css work -->
        <ul class="products list">
        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
            <?php echo haru_get_template('products/product-style/list_style.php', '', '', '' ); ?>
        <?php endwhile; // end of the loop. ?>
        </ul>
    </div>
    <?php if ( $products->max_num_pages > 1 ) : ?>
    <div class="<?php echo join(' ', $product_paging_class); ?>">
        <?php
        switch ( $paging_style ) {
            case 'load-more':
                haru_paging_load_more_product($products);
                break;
            case 'infinity-scroll':
                haru_paging_infinitescroll_product($products);
                break;
            default:
                echo haru_paging_nav_product($products);
                break;
        }
        ?>
    </div>
    <?php endif; ?>
<?php else : ?>
    <div class="item-not-found"><?php echo esc_html__( 'No item found', 'haru-pangja' ) ?></div>
<?php endif; ?>