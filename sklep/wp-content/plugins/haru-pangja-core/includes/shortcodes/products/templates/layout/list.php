<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

?>
<div class="products-shortcode-wrapper list woocommerce"> <!-- Add woocommerce class to make css work -->
    <ul class="products list">
    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
        <?php include($product_path); // From product-list.php file to override woocommerce ?>
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