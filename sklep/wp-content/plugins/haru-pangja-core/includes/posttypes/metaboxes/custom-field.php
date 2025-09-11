<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/
?>
<div class="portfolio-custom-field">
    <?php
    while( $mb->have_fields_and_multi('portfolio_custom_fields',array('length' => 1)) ) : ?>
        <?php $mb->the_group_open(); ?>

        <?php $mb->the_field('custom-field-title'); ?>
        <label><?php echo esc_html__( 'Title', 'haru-pangja' ) ; ?></label>
        <input class="form-control" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>

        <?php $mb->the_field('custom-field-description'); ?>
        <label><?php echo esc_html__( 'Description', 'haru-pangja' ); ?></label>
        <textarea name="<?php $mb->the_name(); ?>" class="form-control" rows="3"><?php echo wp_kses_post($mb->the_value()); ?></textarea>
        <a href="#" class="dodelete button"><?php echo esc_html__( 'Remove', 'haru-pangja' ); ?></a>
        <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
    <div style="clear: both;"></div>
    <p>
        <a href="#" class="docopy-portfolio_custom_fields button"><?php echo esc_html__( 'Add custom field', 'haru-pangja' ); ?></a>
        <a href="#" class="dodelete-portfolio_custom_fields button"><?php echo esc_html__( 'Remove All', 'haru-pangja' ); ?></a>
    </p>
</div>