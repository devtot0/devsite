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

$image_src = wp_get_attachment_url($video_image);
// Enqueue assets
?>
<div class="video-shortcode-wrap <?php echo esc_attr( $layout_type . ' ' . $el_class ); ?>">
    <div class="video-shortcode-content">
        <div class="video-button">
            <a class="video-popup-link" title="" href="<?php echo esc_url( $video_url ); ?>"><i class="simpline icon-control-play"></i><?php echo esc_html( $title ); ?></a>
        </div>
    </div>
</div>