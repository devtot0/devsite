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
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );
$iconClass = isset( ${'icon_' . $type} ) ? esc_attr( ${'icon_' . $type} ) : 'fa fa-adjust';
$icon_color = $color;
if( 'custom' === $color ) {
    $icon_color = esc_attr( $custom_color );
}

$link      = vc_build_link( $link );
?>
<?php if ( $iconClass != '' ) : ?>
    <div class="icon-box-shortcode-wrap <?php echo esc_attr( $layout_type . ' ' . $el_class); ?>">
        <div class="icon-box-container">
        <?php if ( $link['url'] != '' ) : ?>
            <a href="<?php echo esc_attr( $link['url'] ); ?>" title="<?php echo esc_attr( $link['title'] ); ?>" target="<?php echo ( strlen( $link['target'] ) > 0 ? esc_attr( $link['target'] ) : '_self' ) ?>">
        <?php endif; ?>
            <div class="icon-wrap" style="color:<?php echo $icon_color; ?>">
                <span class="<?php echo $iconClass; ?>"></span>
            </div>    
        <?php if ( $link['url'] != '' ) : ?>
            </a>
        <?php endif; ?>
            <div class="icon-content">
                <h5 class="icon-title">
                    <?php if ( $link['url'] != '' ) : ?>
                        <a href="<?php echo esc_attr( $link['url'] ) ?>" title="<?php echo esc_attr( $link['title'] ); ?>" target="<?php echo ( strlen( $link['target'] ) > 0 ? esc_attr( $link['target'] ) : '_self' ) ?>">
                    <?php endif; ?>
                    <?php echo esc_html( $title ); ?>
                    <?php if ( $link['url'] != '' ) : ?>
                        </a>
                    <?php endif; ?>
                </h5>
                <p class="icon-description"><?php echo wp_kses_post( $description ); ?></p>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="icon-box-not-select"><?php echo esc_html__( 'Please select Icon Box!', 'haru-pangja' ); ?></div>
<?php endif; ?>