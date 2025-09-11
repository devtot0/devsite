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

global $haru_options, $product;

$classes                = array();
$classes[]              = 'product-item-wrap';
$action_disable_array   = explode(',', $action_disable);
$product_button_tooltip = $haru_options['product_button_tooltip'];
$image_width            = $product_img_width;
$image_height           = $product_img_height;

if ( ($product_button_tooltip == "1" && $action_tooltip == 'true') || ($action_tooltip == 'true') ) {
    $classes[] = 'button-has-tooltip';
} else {
    $classes[] = 'button-no-tooltip';
}

$post_attachment_id__    = has_post_thumbnail() ?  get_post_thumbnail_id(): 0;
$haru_img_resize         = matthewruddy_image_resize_id($post_attachment_id__, $image_width, $image_height);

$haru_product_width      = '';
$ratio_width             = $image_width;
$ratio_height            = $image_height;
$classes['ratio_height'] = 'haru_product_y1';
foreach ( $style_each_pr_2 as $key => $val ) {
    if ( $val[0] == $order_product ) {
        $ratio              = explode('x', $val[1]);
        $haru_product_width = 'haru_product_x'.(int)$ratio[0];
        $classes['ratio_height']          = 'haru_product_y'.(int)$ratio[1];
        $ratio_width        = $image_width*(int)$ratio[0];
        if ( $ratio[0] == 2 ) {
            $ratio_width    = $image_width*(int)$ratio[0];
        }
        $ratio_height       = $image_height*(float)$ratio[1];
        if ( $ratio[1] == 2 ) {
            $ratio_height   = $image_height*(float)$ratio[1];
        }
        $haru_img_resize             = matthewruddy_image_resize_id($post_attachment_id__, $ratio_width, $ratio_height);
    }
}

$classes[] = $haru_product_width;
$classes[] = 'haru-columns-' . $columns;

?>
<div <?php post_class( $classes ); ?>>

    <div class="product-item-inner">
        <div class="product-thumb">
            <a href="<?php echo esc_url(get_the_permalink()); ?>">
                <img class="attachment-shop_catalog wp-post-image" width="<?php echo esc_attr($ratio_width) ?>" height="<?php echo esc_attr($ratio_height) ?>" alt="" src="<?php echo esc_url($haru_img_resize) ?>">
            </a>
            <div class="product-actions">
                <?php
                /**
                 * haru_woocommerce_product_action hook
                 *
                 * @hooked haru_woocomerce_template_loop_wishlist - 5
                 * @hooked haru_woocomerce_template_loop_compare - 10
                 * @hooked woocommerce_template_loop_add_to_cart - 20
                 * @hooked haru_woocomerce_template_loop_quick_view - 25
                 */
                // Disable action button by remove action
                foreach($action_disable_array as $key=>$value ) {
                    switch($value) {
                        case 'wishlist': 
                            remove_action( 'haru_woocommerce_product_actions', 'haru_woocomerce_template_loop_wishlist', 5 );
                            break;
                        case 'compare': 
                            remove_action( 'haru_woocommerce_product_actions', 'haru_woocomerce_template_loop_compare', 10 );
                            break;
                        case 'addtocart': 
                            remove_action( 'haru_woocommerce_product_actions', 'woocommerce_template_loop_add_to_cart', 20 );
                            break;
                        case 'quickview': 
                            remove_action( 'haru_woocommerce_product_actions', 'haru_woocomerce_template_loop_quick_view', 25 );
                            break;
                        default:
                            break;
                    }
                }
                do_action( 'haru_woocommerce_product_actions' );
                // Return to default action
                add_action( 'haru_woocommerce_product_actions', 'haru_woocomerce_template_loop_wishlist', 5 );
                add_action( 'haru_woocommerce_product_actions', 'haru_woocomerce_template_loop_compare', 10 );
                add_action( 'haru_woocommerce_product_actions', 'woocommerce_template_loop_add_to_cart', 20 );
                add_action( 'haru_woocommerce_product_actions', 'haru_woocomerce_template_loop_quick_view', 25 );

                ?>
            </div>
        </div>

        <div class="product-info">
            <?php
            /**
             * woocommerce_after_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             * @hooked woocommerce_template_loop_product_title - 15
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
        </div>

    </div>
</div>