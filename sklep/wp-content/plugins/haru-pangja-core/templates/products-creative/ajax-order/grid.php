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


$atts = compact('product_cats', 'layout_type','product_style', 'per_page', 'columns', 'auto_play', 'slide_duration');

$classes   = array();
$classes[] = 'haru-products-ajax-order';
$classes[] = $layout_type;
$classes[] = $el_class;

$shortcode_id   = uniqid();
$rand_id        = 'haru-product-ajax-order-' . rand();
$product_tabs   = explode(',', $product_tabs);

// Enqueue assets
wp_enqueue_script( array('imagesloaded') );
wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/libraries/isotope/isotope.pkgd.min.js', false, true );
?>
<div class="<?php echo esc_attr( implode(' ', $classes) ); ?>" id="<?php echo esc_attr($rand_id) ?>" data-atts="<?php echo htmlentities( json_encode($atts) ); ?>">
    
    <div id="product-ajax-order-<?php echo esc_attr($shortcode_id); ?>">
        <ul class="products-tabs <?php echo esc_attr($tab_align); ?> clearfix">
            <?php
                if ( !empty($product_tabs) ) : 
                    foreach( $product_tabs as $tab ) : 
                        $tab_title = $tab . '_title';
            ?>
                <li class="tab-item" data-product_order="<?php echo esc_attr($tab); ?>">
                    <span><?php echo esc_html($$tab_title); ?></span>
                </li>
            <?php
                    endforeach;
                endif; 
            ?>
        </ul>
    
        <div class="products-content <?php echo $layout_type; ?>">
        </div>
    </div>
</div>