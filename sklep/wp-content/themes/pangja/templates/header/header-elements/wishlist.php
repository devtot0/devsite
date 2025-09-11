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
<div class="header-elements-item my-wishlist">
    <div class="widget_shopping_wishlist_content">
        <?php if ( class_exists('YITH_WCWL') ) : ?>
        <div class="my-wishlist-wrap"><?php echo haru_woocommerce_wishlist(); ?></div>
        <?php endif; ?>
    </div>
</div>