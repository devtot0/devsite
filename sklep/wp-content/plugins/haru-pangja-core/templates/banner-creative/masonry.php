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

$images_arr   = (array)vc_param_group_parse_atts( $images );
$image_class  = 'image-col-' . $columns;
$padding      = 'padding-10';
// Equeue assets
wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/libraries/isotope/isotope.pkgd.min.js', array( 'jquery' ), '', true );
wp_enqueue_script( 'isotope-packery-mode', get_template_directory_uri() . '/assets/libraries/isotope/packery-mode.pkgd.min.js', false, true );
wp_enqueue_script( array('imagesloaded') ); // From WordPress core
?>
<div class="banner-creative-shortcode-wrap <?php echo $layout_type . ' ' . $el_class; ?>" 
    data-padding="<?php echo preg_replace('/\D/', '', $padding); ?>"
    data-columns="<?php echo esc_attr($columns); ?>">
    <div class="banner-content-wrap banner-list">
        <?php
            foreach( $images_arr as $banner ) : 
                $link = '';
                if ( isset($banner['link']) ) {
                    $link = vc_build_link( $banner['link'] );
                }
                $image_src = wp_get_attachment_url($banner['image']);
        ?>

        <div class="banner-item <?php echo esc_attr($banner['size'] . ' ' . $banner['hover_style'] . ' ' . $image_class . ' ' . $padding); ?>">
            <div class="banner-item-wrap">
                <?php if ( $image_src != '' ) : ?>
                    <img src="<?php echo esc_url($image_src); ?>" alt="">
                <?php endif; ?>
                <div class="banner-content-inner">
                    <div class="banner-content">
                        <?php if ( array_key_exists( 'title', $banner ) ) : ?>
                            <?php if ( $banner['title'] != '' ) : ?>
                                <h6 class="banner-title">
                                    <?php if ( $link != '' ) : ?>
                                        <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr( ($link['target'] != '') ? $link['target'] : '_self' ); ?>">
                                    <?php endif; ?>
                                    <?php echo esc_html( $banner['title'] ); ?>
                                    <?php if ( $link != '' ) : ?>
                                        </a>
                                    <?php endif; ?>
                                </h6>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if ( array_key_exists( 'sub_title', $banner ) ) : ?>
                            <h6 class="banner-sub-title"><?php echo esc_html( $banner['sub_title'] ); ?></h6>
                        <?php endif; ?>

                        <?php if ( array_key_exists( 'description', $banner ) ) : ?>
                            <p class="banner-description"><?php echo esc_html( $banner['description'] ); ?></p>
                        <?php endif; ?>

                        <?php if ( array_key_exists( 'sub_description', $banner ) ) : ?>
                            <p class="banner-sub-description"><?php echo esc_html( $banner['sub_description'] ); ?></p>
                        <?php endif; ?>

                        <?php if ( array_key_exists( 'hover_style', $banner ) && ($banner['hover_style'] == 'style_4' || $banner['hover_style'] == 'style_7') ) : ?>
                            <?php if ( $link != '' ) : ?>
                                <a href="<?php echo esc_url($link['url']); ?>" class="banner-button" target="<?php echo esc_attr( ($link['target'] != '') ? $link['target'] : '_self' ); ?>">
                                    <?php 
                                        if ( array_key_exists( 'button_text', $banner ) ) :
                                            echo esc_html( $banner['button_text'] ); 
                                        endif; 
                                    ?>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

        <?php endforeach; ?>
    </div>
</div>