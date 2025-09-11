<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

$login_url     = '';
$register_url  = '';
$account_url   = '';
if ( class_exists( 'WooCommerce' ) ) {
    global $woocommerce;
    $myaccount_page_id = wc_get_page_id('myaccount');
    if ( $myaccount_page_id > 0 ) {
        $login_url    = get_permalink( $myaccount_page_id );
        $register_url = get_permalink( $myaccount_page_id );
        $account_url  = get_permalink( $myaccount_page_id );
    }
    else {
        $login_url    = wp_login_url( get_permalink() );
        $register_url = wp_registration_url();
        $account_url  = get_edit_user_link();
    }
}
else {
    $login_url    = wp_login_url( get_permalink() );
    $register_url = wp_registration_url();
    $account_url  = get_edit_user_link();
}

?>
<div class="header-elements-item user-account-wrap">
    <?php
        if ( is_user_logged_in() ) :
            $orders  = get_option( 'woocommerce_myaccount_orders_endpoint', 'orders' );
            $account = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
            if ( $orders ) {
                $account .= '/' . $orders;
            }

            $user_id = get_current_user_id();
    ?>
        <div class="user-account-content logged-in">
            <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" class="header-icon">
                <?php echo get_avatar( get_the_author_meta( 'ID', $user_id ), 45 ); ?>
            </a>
            <ul class="user-account-menu">
                <?php
                    $current_user = wp_get_current_user(); 
                ?>
                <li>
                    <?php echo esc_html__( 'Howdy ', 'pangja' ) . esc_html( $current_user->user_login ); ?>
                </li>
                <?php
                    $wishlist = '';
                    if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) :
                ?>
                <li>
                    <a href="<?php echo esc_url( get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) ); ?>"><?php echo esc_html__( 'My Wishlist', 'pangja' ); ?></a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><?php echo esc_html__( 'My Account', 'pangja' ); ?></a>
                </li>
                <li>
                    <a href="<?php echo esc_url( $account ); ?>"><?php echo esc_html__( 'My Orders', 'pangja' ); ?></a>
                </li>
                <li>
                    <a href="<?php echo esc_url( wp_logout_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) ); ?>"><?php echo esc_html__( 'Logout', 'pangja' ); ?></a>
                </li>
            </ul>
        </div>
    <?php else : ?>
        <div class="user-account-content logged-out">
            <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" class="login-popup-link" id="login-popup-link"><i class="header-icon icon-user"></i></a>
        </div>
    <?php endif; ?>
</div>