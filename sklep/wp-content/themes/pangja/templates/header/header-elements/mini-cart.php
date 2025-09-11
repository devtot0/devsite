<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/
if ( false == haru_check_woocommerce_status() ) return;
?>
<div class="header-elements-item mini-cart-wrap no-price">
    <div class="widget_shopping_cart_content">
        <?php get_template_part('woocommerce/cart/mini-cart'); ?>
    </div>
</div>