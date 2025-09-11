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

$link      = vc_build_link( $link );
?>
<?php if ( $svg_class != '' ) : ?>
    <div class="icon-box-shortcode-wrap <?php echo esc_attr( $layout_type . ' ' . $el_class); ?>">
        <div class="icon-box-container">
            <div class="icon-wrap">
                <span class="icon-svg <?php echo esc_attr($svg_class); ?>"></span>
            </div>    
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
                <?php if ( $link['url'] != '' ) : ?>
                    <a class="icon-box-link" href="<?php echo esc_attr( $link['url'] ) ?>" title="<?php echo esc_attr( $link['title'] ); ?>" target="<?php echo ( strlen( $link['target'] ) > 0 ? esc_attr( $link['target'] ) : '_self' ) ?>"><?php echo esc_html__( 'View More', 'haru-pangja' ); ?><i class="fa fa-chevron-right"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="icon-box-not-select"><?php echo esc_html__( 'Please set Icon Box!', 'haru-pangja' ); ?></div>
<?php endif; ?>