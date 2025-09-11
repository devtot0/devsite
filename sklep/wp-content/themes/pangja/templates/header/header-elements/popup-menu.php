<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

add_action('haru_after_page_main','haru_add_popup_menu_template', '10');

function haru_add_popup_menu_template() {
    if (has_nav_menu('popup')) : ?>
    <div id="haru-menu-popup" class="white-popup-block mfp-hide mfp-with-anim" >
        <div id="primary-menu" class="menu-wrapper">
            <?php
                $arg_menu = array(
                    'menu_id'        => 'main-menu',
                    'container'      => '',
                    'theme_location' => 'popup',
                    'menu_class'     => 'haru-nav-popup-menu',
                    'fallback_cb'    => 'haru_please_set_menu',
                    'walker'         => new HARU_MegaMenu_Walker()
                );
                wp_nav_menu( $arg_menu );
            ?>
        </div>
    </div>
<?php endif;
} 
?>
<a href="javascript:;" id="popup-menu-button" data-effect="menu-popup-bg mfp-zoom-in" data-delay="500"></a>