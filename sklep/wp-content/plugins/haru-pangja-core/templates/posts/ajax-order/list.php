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

$atts = compact('category', 'layout_type', 'per_page');

$classes   = array();
$classes[] = 'haru-posts-ajax-order';
$classes[] = $layout_type;
$classes[] = $el_class;

$shortcode_id   = uniqid();
$rand_id        = 'haru-post-ajax-order-' . rand();
$post_tabs   = explode(',', $post_tabs);

// Enqueue assets
?>
<div class="<?php echo esc_attr( implode(' ', $classes) ); ?>" id="<?php echo esc_attr($rand_id) ?>" data-atts="<?php echo htmlentities( json_encode($atts) ); ?>">
    
    <div id="post-ajax-order-<?php echo esc_attr($shortcode_id); ?>">
        <ul class="posts-tabs <?php echo esc_attr($tab_align); ?> clearfix">
            <?php
                if ( !empty($post_tabs) ) : 
                    foreach( $post_tabs as $tab ) : 
                        $tab_title = $tab . '_title';
            ?>
                <li class="tab-item <?php echo esc_attr($tab); ?>" data-post_order="<?php echo esc_attr($tab); ?>">
                    <span><?php echo esc_html($$tab_title); ?></span>
                </li>
            <?php
                    endforeach;
                endif; 
            ?>
        </ul>
    
        <div class="posts-content <?php echo esc_attr($layout_type); ?>">
        </div>
    </div>
</div>