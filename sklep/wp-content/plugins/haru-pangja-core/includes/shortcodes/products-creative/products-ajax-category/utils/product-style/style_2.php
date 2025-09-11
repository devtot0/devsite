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
?>
<li <?php post_class(); ?>>
    <div class="product-wrap">
        <?php
        echo '<div class="product-thumbnail">';

        /**
         * woocommerce_before_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action( 'woocommerce_before_shop_loop_item' );

        /**
         * woocommerce_before_shop_loop_item_title hook.
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */

        add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );
        do_action( 'woocommerce_before_shop_loop_item_title' );
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );

        echo '<div class="product-actions">';
        // Custom for style 2
        remove_action( 'milo_ws_woocommerce_product_actions', 'milo_ws_wishlist_button', 15 );
        do_action( 'milo_ws_woocommerce_product_actions' );
        add_action( 'milo_ws_woocommerce_product_actions', 'milo_ws_wishlist_button', 15 );
        echo '</div>';

        echo '</div>'; // Close product-thumbnail

        echo '<div class="product-content">'; // Open product-content
        /**
         * woocommerce_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_product_title - 10
         */
        echo '<div class="product-title">';
        remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
        add_action( 'woocommerce_shop_loop_item_title', 'milo_ws_woocommerce_template_loop_product_title', 10 );
        add_action( 'woocommerce_shop_loop_item_title', 'milo_ws_wishlist_button', 15 );
        do_action( 'woocommerce_shop_loop_item_title' );
        remove_action( 'woocommerce_shop_loop_item_title', 'milo_ws_wishlist_button', 15 );
        remove_action( 'woocommerce_shop_loop_item_title', 'milo_ws_woocommerce_template_loop_product_title', 10 );
        add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
        echo '</div>';
        /**
         * woocommerce_after_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_rating - 5
         * @hooked woocommerce_template_loop_price - 10
         */
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
        add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
        add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );

        echo '<div class="product-price">';
        do_action( 'woocommerce_after_shop_loop_item_title' );
        echo '</div>';

        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );
        add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );
        add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

        /**
         * woocommerce_after_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_close - 5
         * @hooked woocommerce_template_loop_add_to_cart - 10
         */
        // Remove add button and note about validate HTML
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        do_action( 'woocommerce_after_shop_loop_item' );
        add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
        add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

        echo '</div>'; // Close product-content
        ?>
    </div>
</li>
