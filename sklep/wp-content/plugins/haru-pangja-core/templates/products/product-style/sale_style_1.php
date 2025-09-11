<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
$sale_price_from = ( $date = get_post_meta( $product->get_id(), '_sale_price_dates_from', true ) ) ? date_i18n( 'Y/m/d', $date ) : '';
$sale_price_to = ( $date = get_post_meta( $product->get_id(), '_sale_price_dates_to', true ) ) ? date_i18n( 'Y/m/d', $date ) : '';

?>
<li <?php post_class(); ?>>
    <div class="product-inner">
        <?php
        /**
         * woocommerce_before_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10 (removed in woocommerce-functions.php)
         */
        do_action( 'woocommerce_before_shop_loop_item' );
        ?>
        <div class="product-thumbnail">
            <?php
            /**
             * woocommerce_before_shop_loop_item_title hook.
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
            remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
            add_action( 'woocommerce_before_shop_loop_item_title', 'haru_woocommerce_template_loop_product_thumbnail', 10);
            add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 10 );
            do_action( 'woocommerce_before_shop_loop_item_title' );
            ?>
        </div>
        
        <div class="product-info">
            <?php
            /**
             * woocommerce_shop_loop_item_title hook.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
            add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );
            do_action( 'woocommerce_shop_loop_item_title' );
            ?>
            <p class="excerpt"><?php echo wp_trim_words( get_the_excerpt(), 10, '...' ); ?></p>
            <?php
            /**
             * woocommerce_after_shop_loop_item_title hook.
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */

            do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
            <div class="product-sale-countdown">
                <div class="countdown-time"
                data-days-text="<?php echo esc_html__( 'Days', 'haru-pangja' ); ?>" 
                data-hours-text="<?php echo esc_html__( 'Hours', 'haru-pangja' ); ?>" 
                data-minutes-text="<?php echo esc_html__( 'Mins', 'haru-pangja' ); ?>" 
                data-seconds-text="<?php echo esc_html__( 'Secs', 'haru-pangja' ); ?>" 
                data-sale-to="<?php echo esc_attr($sale_price_to); ?>"
                data-sale-from="<?php echo esc_attr($sale_price_from); ?>">
                </div>
            </div>
        </div>
        <?php
        /**
         * woocommerce_after_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_close - 5 (removed in woocommerce-functions.php)
         * @hooked woocommerce_template_loop_add_to_cart - 10 (removed in woocommerce-functions.php)
         */
        do_action( 'woocommerce_after_shop_loop_item' );
        ?>
    </div>
</li>