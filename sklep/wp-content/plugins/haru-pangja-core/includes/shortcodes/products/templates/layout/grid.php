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
<div class="products-shortcode-wrapper <?php echo $layout_type; ?>">

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

    <?php if ( $products->max_num_pages > 1 ) : ?>
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