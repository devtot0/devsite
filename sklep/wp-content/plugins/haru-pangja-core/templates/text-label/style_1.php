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

?>
<div class="text-label-shortcode-wrap <?php echo esc_attr( $layout_type . ' ' . $el_class); ?>">
	<div class="text-label-content">
		<div class="text-label-top">
			<div class="text-label-top-left">
				<div class="label-title"><?php echo esc_html( $title ); ?></div>
	        	<div class="label-sub-title"><?php echo esc_html( $sub_title ); ?></div>
        	</div>
        	<div class="text-label-top-right">
        		<div class="label-description"><?php echo esc_html( $description ); ?></div>
    		</div>
		</div>
        <div class="label-sub-description"><?php echo esc_html( $sub_description ); ?></div>
    </div>
</div>