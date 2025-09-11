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
$link      = vc_build_link( $link );

?>
<div class="banner-shortcode-wrap <?php echo $layout_type . ' ' . $el_class; ?>">
    <div class="banner-content-wrap">
        <?php if ( $link['url'] != '' ) : ?>
            <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr( ($link['target'] != '') ? $link['target'] : '_self' ); ?>">
        <?php endif; ?>
            <?php if ( $image_src != '' ) : ?>
                <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($title); ?>">
            <?php endif; ?>
            <div class="banner-content-inner">
                <div class="banner-content">
                    <?php if ( $title != '' ) : ?>
                        <h6 class="banner-title"><?php echo esc_html( $title ); ?></h6>
                    <?php endif; ?>
                    <?php if ( $description != '' ) : ?>
                        <p class="banner-description"><?php echo esc_html( $description ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php if ( $link['url'] != '' ) : ?>
            </a>
        <?php endif; ?>
    </div>
</div>