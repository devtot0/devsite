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
    <div class="banner-content-wrap clearfix <?php echo esc_attr($banner_position); ?>">
        <?php if ( $image_src != '' ) : ?>
            <div class="banner-image">
                <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($title); ?>">
            </div>
        <?php endif; ?>
        <div class="banner-content-inner">
            <div class="banner-content">
                <?php if ( $svg_class != '' ) : ?>
                <div class="icon-wrap">
                    <span class="icon-svg <?php echo esc_attr($svg_class); ?>"></span>
                </div>
                <?php endif; ?> 
                <?php if ( $title != '' ) : ?>
                    <h6 class="banner-title"><?php echo esc_html( $title ); ?><span class="banner-sub-title"><?php echo esc_html( $sub_title ); ?></span></h6>
                <?php endif; ?>
                <?php if ( $description != '' ) : ?>
                    <p class="banner-description"><?php echo esc_html( $description ); ?></p>
                <?php endif; ?>
                <?php if ( $link['url'] != '' ) : ?>
                    <a href="<?php echo esc_url($link['url']); ?>" class="banner-link" target="<?php echo esc_attr( ($link['target'] != '') ? $link['target'] : '_self' ); ?>">
                        <?php echo esc_html__( 'Hire Us Now', 'haru-pangja' ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>