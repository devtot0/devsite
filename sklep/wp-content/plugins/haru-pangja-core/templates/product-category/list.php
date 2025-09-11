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
$padding      = 'padding-0';
$image_src = wp_get_attachment_url($image);
// Equeue assets

?>
<div class="product-category-shortcode-wrap <?php echo $layout_type . ' ' . $el_class; ?>" 
    data-padding="<?php echo preg_replace('/\D/', '', $padding); ?>"
    style="background-image: url('<?php echo esc_url($image_src); ?>');">
    <div class="product-category-content-wrap category-list">
        <?php
            foreach( $images_arr as $category ) : 
                $link = '';
                if ( isset($category['link']) ) {
                    $link = vc_build_link( $category['link'] );
                }
        ?>

        <div class="category-item <?php echo esc_attr($image_class . ' ' . $padding); ?>">
            <div class="category-content-inner">
                <div class="category-content">
                    <?php if ( $category['title'] != '' ) : ?>
                        <h6 class="category-title">
                            <?php if ( $link != '' ) : ?>
                                <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr( ($link['target'] != '') ? $link['target'] : '_self' ); ?>">
                            <?php endif; ?>
                            <?php echo esc_html( $category['title'] ); ?>
                            <?php if ( $link != '' ) : ?>
                                </a>
                            <?php endif; ?>
                        </h6>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php endforeach; ?>
    </div>
</div>