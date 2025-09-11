<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

$is_show_top_header = get_post_meta( get_the_ID(), 'haru_' . 'top_header', true ); // @TODO: need fix shop page
if ( ($is_show_top_header == '') || ($is_show_top_header == '-1') ) {
    $is_show_top_header = haru_get_option('haru_top_header');
}

if ( !$is_show_top_header ) {
    return; // DO NOT SHOW TOP BAR
}

$top_header_layout_width = get_post_meta( get_the_ID(), 'haru_' . 'top_header_layout_width', true );
if ( ($top_header_layout_width == '') || ($top_header_layout_width == '-1') ) {
    $top_header_layout_width = haru_get_option('haru_top_header_layout_width');
}

$top_header_layout = get_post_meta( get_the_ID(), 'haru_' . 'top_header_layout', true );
if ( ($top_header_layout == '') || ($top_header_layout == '-1') ) {
    $top_header_layout = haru_get_option('haru_top_header_layout');
}

// Left sidebar
$top_header_left_sidebar = get_post_meta( get_the_ID(), 'haru_' . 'top_header_left_sidebar', true );
if ( ($top_header_left_sidebar == '') || ($top_header_left_sidebar == '-1') ) {
    $top_header_left_sidebar = haru_get_option('haru_top_header_left_sidebar');
}
// Right sidebar
$top_header_right_sidebar = get_post_meta( get_the_ID(), 'haru_' . 'top_header_right_sidebar', true );
if ( ($top_header_right_sidebar == '') || ($top_header_right_sidebar == '-1') ) {
    $top_header_right_sidebar = haru_get_option('haru_top_header_right_sidebar');
}

$top_header_class = array('haru-top-header');
if ( haru_get_option('haru_mobile_header_top_header') == '0' ) {
    $top_header_class[] = 'mobile-top-header-hide';
}

$col_top_header_left   = '';
$col_top_header_right  = '';

if ( ($top_header_layout == 'top-header-1' ) && is_active_sidebar($top_header_left_sidebar) && is_active_sidebar($top_header_right_sidebar) ) {
    $col_top_header_left  = 'col-md-6';
    $col_top_header_right = 'col-md-6';
} elseif ( ($top_header_layout == 'top-header-2' ) && is_active_sidebar($top_header_left_sidebar) ) {
    $col_top_header_left  = 'col-md-12';
}

if (empty($col_top_header_left)) {
    return; // DO NOT SHOW TOP BAR
}

?>
<div class="<?php echo esc_attr( join(' ', $top_header_class) ); ?>">
    <div class="<?php echo esc_attr( $top_header_layout_width ); ?>">
        <div class="row">
            <?php if ( is_active_sidebar($top_header_left_sidebar) ) : ?>
                <div class="top-sidebar top-header-left <?php echo esc_attr($col_top_header_left) ?> col-sm-12 col-xs-12">
                    <?php dynamic_sidebar( $top_header_left_sidebar );?>
                </div>
            <?php endif; ?>
            <?php if ( is_active_sidebar($top_header_right_sidebar) && ($top_header_layout != 'top-header-2') ) : ?>
                <div class="top-sidebar top-header-right <?php echo esc_attr($col_top_header_right) ?> col-sm-12 col-xs-12">
                    <?php dynamic_sidebar( $top_header_right_sidebar );?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>