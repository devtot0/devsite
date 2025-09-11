<?php
/**
 *  
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/
wp_enqueue_script( 'haru_product_masonry' );
?>
<div class="<?php echo join(' ',$product_wrap_class); ?>">

    <div class="products-creative <?php echo join(' ',$product_class); ?>">
        <div class="product-style-masonry">
            <div class="product-listing-2 <?php echo 'product-' . $product_style;?>">
                <?php
                $style_each_pr_1 = explode(',', trim( $product_width ));
                $style_each_pr_2 = array();
                foreach( $style_each_pr_1 as $key => $val ) {
                    $style_each_pr_2[] = explode(':', trim( $val ));
                }

                if( $products->have_posts() ): $order_product = 1;
                    while( $products->have_posts() ): $products->the_post();
                        ?>
                        <?php include($product_path); // From products.php file ?>
                        <?php
                        $order_product ++;
                    endwhile;
                endif; wp_reset_postdata();
                ?>
            </div>
        </div><!--end product tab-->
    </div>

</div>