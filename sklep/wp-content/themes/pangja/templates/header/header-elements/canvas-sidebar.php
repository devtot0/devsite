<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

/* 2.2. Header canvas sidebar*/
add_action('haru_after_page_main','haru_add_canvas_sidebar_template', '10');
function haru_add_canvas_sidebar_template() {
    ?>
    <div class="haru-canvas-sidebar-wrap light">
        <div class="canvas-sidebar-header">
            <?php echo esc_html__( 'Quick Menu', 'pangja' ); ?>
            <span class="canvas-sidebar-close"></span>    
        </div>
        <div class="canvas-sidebar-inner sidebar">
            <?php 
                if (is_active_sidebar('canvas-sidebar')) { 
                    dynamic_sidebar('canvas-sidebar'); 
                } 
            ?>
        </div>
    </div>
    <div class="canvas-mask-overlay"></div>
    <?php
}

?>
<div class="header-elements-item haru-canvas-sidebar-toggle-wrap">
    <a class="canvas-sidebar-toggle" href="javascript:;"><i class="header-icon ion ion-md-menu"></i></a>
</div>