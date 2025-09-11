<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

// One Page
$page_ongepage = get_post_meta(  get_the_ID(), 'haru_' . 'page_onepage', true );

if( $page_ongepage == '1' && has_nav_menu('onepage') ) :
?>
    <div id="haru-onepage-menu" class="menu-wrapper">
        <?php
            // $arg_menu = array(
            //     'menu_id'        => 'onepage-menu',
            //     'container'      => '',
            //     'theme_location' => 'onepage',
            //     'menu_class'     => 'haru-nav-onepage-menu',
            //     'fallback_cb'    => 'please_set_menu',
            //     'walker'         => new HARU_MegaMenu_Walker()
            // );
            // wp_nav_menu( $arg_menu );
        ?>
        <!-- <li data-menuanchor="director-slideshow" class="active"><a href="#director-slideshow">First section</a></li>
        <li data-menuanchor="director-introduce"><a href="#director-introduce">Second section</a></li>
        <li data-menuanchor="director-videos"><a href="#director-videos">Third section</a></li>
        <li data-menuanchor="director-statistic"><a href="#director-statistic">Fourth section</a></li>
        <li data-menuanchor="director-footer"><a href="#director-footer">Fourth section</a></li> -->
    </div>
<?php endif;