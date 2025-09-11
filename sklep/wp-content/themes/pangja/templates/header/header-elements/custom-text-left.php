<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

$header_elements_text = '';

$enable_header_elements = get_post_meta( get_the_ID(), 'haru_enable_header_elements_left', true );
if ($enable_header_elements == '1') {
    $header_elements_text = get_post_meta( get_the_ID(), 'haru_header_elements_left_text', true );
} else {
    if ( haru_get_option('haru-option-header-elements-left') == '1' ) {
        $header_elements_text = haru_get_option('haru_header_elements_left_text');
    } else {
        return;
    }
}

?>
<?php if ( !empty($header_elements_text) ) : ?>
    <div class="header-elements-item custom-text-wrap">
        <?php echo wp_kses_post($header_elements_text); ?>
    </div>
<?php endif;?>