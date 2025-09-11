<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/
extract( $atts );
// Enqueue assets

?>
<div class="process-step <?php echo esc_attr( $layout_type . ' ' . $el_class); ?>">
    <div class="process-step__top">
    	<div class="process-step__number process-step__<?php echo esc_attr( $step_style ); ?>">
            <?php echo esc_html($number); ?>
        </div>
        <?php if($step_style == 'odd') : ?>
            <img src="<?php echo esc_url(get_theme_root_uri() . '/pangja/assets/images/odd-step-arrow.png'); ?>" class="process-step__image process-step__image-odd">
        <?php endif; ?>
        <?php if($step_style == 'even') : ?>
            <img src="<?php echo esc_url(get_theme_root_uri() . '/pangja/assets/images/even-step-arrow.png'); ?>" class="process-step__image process-step__image-even">
        <?php endif; ?>
    </div>
    <h6 class="process-step__title"><?php echo esc_html($title); ?></h6>
    <p class="process-step__description">
        <?php echo wp_kses_post($description); ?>
    </p>
</div>