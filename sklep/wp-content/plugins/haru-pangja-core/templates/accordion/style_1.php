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

$accordions_arr    = (array)vc_param_group_parse_atts( $accordion );
$rand_id = wp_rand();
// Enqueue assets

?>
<div class="accordion-shortcode-wrap <?php echo esc_attr( $layout_type . ' ' . $el_class ); ?>">
    <div class="accordion-shortcode-content">
        <div class="panel-group" id="accordion-<?php echo esc_attr( $rand_id ); ?>">
            <?php foreach( $accordions_arr as $key => $accordion ) : ?>
            <div class="panel <?php if ( $key == 0 ) echo esc_attr( 'active' ); ?>">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" class="<?php if ( $key == 0 ) echo esc_attr( 'in' ); ?>" data-parent="#accordion-<?php echo esc_attr( $rand_id ); ?>" href="#<?php echo sanitize_title( $accordion['title'] ); ?>"><?php echo esc_html( $accordion['title'] );  ?></a>
                    </h4>
                </div>
                <div id="<?php echo sanitize_title( $accordion['title'] ); ?>" class="panel-collapse collapse <?php if ( $key == 0 ) echo esc_attr( 'in' ); ?>">
                    <div class="panel-body">
                        <?php echo wp_kses_post( $accordion['description'] ); ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>