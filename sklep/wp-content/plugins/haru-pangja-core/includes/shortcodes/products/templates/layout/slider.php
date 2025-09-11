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
<div class="products-slider-shortcode-wrapper <?php echo esc_attr($layout_type . ' ' .$el_class) ?>">
    <ul class="haru-carousel products owl-carousel owl-theme"
        data-items="<?php echo esc_attr($products_per_slide); ?>"
        data-items-mobile="2"
        data-margin="20"
        data-autoplay="<?php echo esc_attr($autoplay); ?>"
        data-slide-duration="<?php echo esc_attr($slide_duration); ?>"
    >
    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
        <?php wc_get_template_part( 'content', 'product' ); ?>
    <?php endwhile; // end of the loop. ?>
    </ul>
</div>