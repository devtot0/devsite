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
$args = array(
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'meta_key'       => 'total_sales',
    'orderby'        => 'meta_value_num',
    'posts_per_page' => $products_per_page,
);
$products = new WP_Query($args);
// Enqueue assets
if( $layout_type == 'carousel' ) {
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/libraries/owl-carousel/assets/owl.carousel.min.css', array(),false );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/libraries/owl-carousel/owl.carousel.min.js', false, true );
}

?>
<?php if ( $products->have_posts() ) : ?>
    <div class="products-top-seller-shortcode-wrap <?php echo esc_attr($layout_type . ' ' .$el_class) ?>">
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
                <?php echo haru_get_template('products/product-style/top_product.php', '', '', '' ); ?>
            <?php if ( (($i%$rows) == 0)  || ($rows == 1) ) : ?>
            </ul>
            <?php endif; ?>

        <?php $i++; endwhile; // end of the loop. ?>
        </div>
    </div>
<?php else : ?>
    <div class="item-not-found"><?php echo esc_html__( 'No item found', 'haru-pangja' ) ?></div>
<?php endif; ?>