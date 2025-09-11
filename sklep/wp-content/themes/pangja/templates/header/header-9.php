<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

$header_class = array('haru-main-header', 'header-sidebar', 'header-desktop-wrap', 'header-light'); // Add class for dark and light skin

?>
<header id="haru-header" class="<?php echo esc_attr( join(' ', $header_class) ); ?>">
    <div class="header-navigation navbar" role="navigation">
        <div class="vertical-header-wrap">
            <div class="header-top">
                <?php get_template_part('templates/header/header-logo' ); ?>
                <div class="header-elements-top">
                    <?php get_template_part('templates/header/header-elements-left' ); ?>
                </div>
            </div>
            <div class="header-bottom">
                <div class="header-primary-menu">
                    <div id="primary-menu" class="menu-wrap">
                        <?php
                            $arg_menu = array(
                                'menu_id'        => 'main-menu',
                                'container'      => '',
                                'theme_location' => 'primary-menu',
                                'menu_class'     => 'haru-main-menu nav-collapse navbar-nav vertical-megamenu',
                                'fallback_cb'    => 'haru_please_set_menu',
                                'walker'         => new HARU_MegaMenu_Walker()
                            );
                            wp_nav_menu( $arg_menu );
                        ?>
                    </div>
                    <?php get_template_part('templates/header/header-elements-nav' ); ?>
                </div>
            </div>
        </div>
    </div>
</header>