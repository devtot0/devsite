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
<div class="products-top-rated-shortcode-wrap <?php echo esc_attr($layout_type . ' ' .$el_class) ?>">
    <h2 class="products-title"><?php echo esc_html($title); ?></h2>
    <div class="haru-carousel products owl-carousel owl-theme"
        data-items="<?php echo esc_attr($columns); ?>"
        data-items-tablet="1"
        data-items-mobile="1"
        data-margin="20"
        data-autoplay="<?php echo esc_attr($autoplay); ?>"
        data-slide-duration="<?php echo esc_attr($slide_duration); ?>"
    >
    <?php 
    $i = 1;
    while ( $products->have_posts() ) : $products->the_post(); ?>
        <?php if ( ($i == 1) || ( ($i%$rows) == 1) || ($rows == 1)) : ?>
        <ul class="item-carousel">
        <?php endif; ?>
            <?php include($product_template_path); ?>
        <?php if ( (($i%$rows) == 0)  || ($rows == 1) ) : ?>
        </ul>
        <?php endif; ?>

    <?php $i++; endwhile; // end of the loop. ?>
    </div>
</div>