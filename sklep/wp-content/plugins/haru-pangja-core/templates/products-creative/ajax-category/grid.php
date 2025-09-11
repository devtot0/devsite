<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/
extract( $atts );

$atts = compact('product_cats', 'layout_type','product_style', 'product_type', 'per_page', 'columns', 'show_general_tab', 'show_nav', 'auto_play', 'slide_duration');

$classes   = array();
$classes[] = 'haru-woo-shortcodes-products-ajax-category';
$classes[] = $product_type;
$classes[] = $product_style;
$classes[] = $layout_type;
$classes[] = $el_class;

$shortcode_id = uniqid();
$rand_id  = 'haru-product-ajax-category-' . rand();
$selector = '#' . $rand_id;

$args = array(
    'post_type'           => 'product',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
    'meta_query'          => array(
        
    )
);

$products = new WP_Query( $args );

if ( empty($product_cats) ) {
    $sub_cats = get_terms( 'product_cat', array('parent' => $parent_cat, 'fields' => 'ids', 'orderby' => 'none') );
    if ( is_array($sub_cats) && !empty($sub_cats) ) {
        $product_cats = implode(',', $sub_cats);
    } else {
        return;
    }
    $see_more_link = get_term_link( (int)$parent_cat, 'product_cat' );
    if ( is_wp_error($see_more_link) ) {
        $see_more_link = '#';
    }
} else {
    $see_more_link = get_permalink( wc_get_page_id('shop') );
}
// Enqueue assets
wp_enqueue_script( array('imagesloaded') );
wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/libraries/isotope/isotope.pkgd.min.js', false, true );
?>
<?php if ( $products->have_posts() ) : ?>
    <div class="<?php echo esc_attr( implode(' ', $classes) ); ?>" id="<?php echo esc_attr($rand_id) ?>" data-atts="<?php echo htmlentities( json_encode($atts) ); ?>">
        
        <div id="product-ajax-category-<?php echo esc_attr($shortcode_id); ?>">
            <ul class="products-tabs <?php echo esc_attr($filter_position); ?> clearfix">
                <?php if ( $show_general_tab == 1 ) : ?>
                    <li class="tab-item all-tab" data-product_cat="<?php echo esc_attr($product_cats) ?>" data-link="<?php echo esc_url($see_more_link) ?>"><span><?php echo esc_html__( 'All', 'haru-pangja' ); ?></span></li>
                <?php endif; ?>

                <?php
                    if ( !empty($product_cats) ) : 
                        $category_arr = array_filter(explode(',', $product_cats));
                        foreach( $category_arr as $cat ) : 
                            $category = get_term_by('slug', $cat, 'product_cat');
                ?>
                    <li class="tab-item" data-product_cat="<?php echo esc_attr($category->slug); ?>" data-link="<?php echo esc_url( get_term_link((int) $category->term_id, 'product_cat') ) ?>">
                        <span><?php echo esc_html($category->name); ?></span>
                    </li>
                <?php
                        endforeach;
                    endif; 
                ?>
            </ul>
        
            <div class="products-content <?php echo $layout_type; ?>">
            </div>

            <!-- See more button (not loadmore) -->
            <div class="see-more-wrapper">
                <a class="button see-more-button" href="<?php echo esc_url($see_more_link) ?>"><?php echo esc_html__( 'View More', 'haru-pangja' ); ?></a>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="item-not-found"><?php echo esc_html__( 'No item found', 'haru-pangja' ) ?></div>
<?php endif; ?>