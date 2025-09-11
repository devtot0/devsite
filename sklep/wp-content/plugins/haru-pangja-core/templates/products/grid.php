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

// if (isset($ordering_args['meta_key'])) {
//     $args['meta_key'] = $ordering_args['meta_key'];
// }

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
wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/assets/libraries/imagesloaded/imagesloaded.min.js', array( 'jquery' ), '', true );
wp_enqueue_script( 'infinitescroll', get_template_directory_uri() . '/assets/libraries/infinitescroll/jquery.infinitescroll.min.js', array( 'jquery' ), '', true );
wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/libraries/isotope/isotope.pkgd.min.js', array( 'jquery' ), '', true );
?>
<?php if ( $products->have_posts() ) : ?>
    <div class="products-shortcode-wrap <?php echo esc_attr($layout_type . ' ' . $el_class); ?>">

        <?php if ( $filter_style != '' && $data_source != 'product_list_id' ) : ?>
        <div class="product-filters">
            <ul data-option-key="filter" class="filter-<?php echo esc_attr($filter_align); ?> <?php echo esc_attr($filter_style); ?>">
                <!-- All products -->
                <li>
                    <a class="selected" href="#" data-option-value="*"><?php echo esc_html__( 'All', 'haru-pangja' ) ?></a>
                </li>

                <?php
                if ( ! empty($category) ) {
                    $category_arr = array_filter(explode(',', $category));
                    foreach ( (array)$category_arr as $cat ) :
                        $category = get_term_by('slug', $cat, 'product_cat');
                        ?>
                        <li>
                            <a href="#" data-option-value=".<?php echo 'product_cat-' . $category->slug ?>"><?php echo esc_html($category->name); ?></a>
                        </li>
                        <?php
                    endforeach;
                } else {
                    if ( $product_categories = get_terms('product_cat') ) {

                        foreach ((array)$product_categories as $product_category) {
                            ?>
                            <li>
                                <a href="#"
                                   data-option-value=".<?php echo 'product_cat-' . $product_category->slug ?>"><?php echo esc_html($product_category->name); ?></a>
                            </li>
                            <?php
                        }
                    }
                }
                ?>
            </ul>
        </div>
        <?php endif; ?>

        <ul class="products shortcode-product-columns-<?php echo $columns; ?>">
            <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                <?php wc_get_template_part( 'content', 'product' ); ?>
            <?php endwhile; // end of the loop. ?>
        </ul>

        <?php 
            if ( $products->max_num_pages > 1 ) : 
                $products_paging_class   = array('products-shortcode-paging-wrap');
                $products_paging_class[] = 'paging-' . $paging_style;
                $products_paging_class[] = 'text-' . $paging_align;
        ?>
        <div class="<?php echo join(' ', $products_paging_class); ?>">
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

    </div>
<?php else : ?>
    <div class="item-not-found"><?php echo esc_html__( 'No item found', 'haru-pangja' ) ?></div>
<?php endif; ?>