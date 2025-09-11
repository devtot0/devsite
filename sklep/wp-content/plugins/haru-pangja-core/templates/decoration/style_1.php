<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/
extract( $atts );
$image_src = wp_get_attachment_url($image);
?>
<div class="decoration-shortcode-wrap <?php echo esc_attr( $layout_type . ' ' . $el_class); ?>">
   <div class="decoration-content">
       <div class="description-info">
           <div class="decoration-title">
               <span><?php echo esc_html( $title ); ?></span>
               <span><?php echo esc_html( $description ); ?></span>
           </div>
       </div>
        <?php if ( $image_src != '' ) : ?>
            <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($title); ?>">
        <?php endif; ?>
    </div>
</div>