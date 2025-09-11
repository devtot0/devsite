<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

?>
<?php if ( !$product->is_in_stock() ) : ?>
	<div class="add-to-cart-wrapper">
		<a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->get_id() ) ); ?>" class="product_type_soldout btn_add_to_cart" title="<?php echo esc_attr__('Sold out','pangja'); ?>"><i class="icon-bag"></i><span class="haru-tooltip button-tooltip"><?php echo esc_html__('Sold out','pangja'); ?></span></a>
	</div>
<?php else : ?>
<?php
	$icon_class = '';
	$product_type = apply_filters( 'woocommerce_add_to_cart_handler', $product->get_type(), $product );
	switch ($product_type) {
		case 'variable':
			$icon_class = 'icon-bag';
			break;
		case 'grouped':
			$icon_class = 'icon-bag';
			break;
		case 'external':
			$icon_class = 'icon-bag';
			break;
		default:
			if ( $product->is_purchasable() && $product->is_type( 'booking' ) ) {
				$icon_class = 'icon-basket';
			} else {
				$icon_class = 'icon-basket';
			}
			break;
	}

	echo apply_filters( 'woocommerce_loop_add_to_cart_link',
		sprintf( '<div class="add-to-cart-wrapper"><a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s product_type_%s %s"><i class="%s"></i><span class="haru-tooltip button-tooltip">%s</span></a></div>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
			esc_attr( $product->get_id() ),
			esc_attr( $product->get_sku() ),
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '', // added by GDragon
			esc_attr( $product->get_type() ), // added by GDragon
			esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
			$icon_class, // added by GDragon
			esc_html( $product->add_to_cart_text() )
		),
	$product );
?>
<?php endif; ?>