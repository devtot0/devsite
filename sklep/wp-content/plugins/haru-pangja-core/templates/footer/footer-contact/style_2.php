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

$contacts_arr      = (array)vc_param_group_parse_atts( $contacts );

?>
<div class="footer-contact-shortcode-wrap <?php echo esc_attr( $layout_type . ' ' . $el_class); ?>">
    <div class="footer-contact-content">
        <ul class="contact-information">
            <?php
                foreach( $contacts_arr as $key => $contact ) : 
                    // Icon
                    vc_icon_element_fonts_enqueue( $contact['icon_library'] );
                    $iconClass = isset( $contact['icon_' . $contact['icon_library']] ) ? esc_attr( $contact['icon_' . $contact['icon_library']] ) : 'fa fa-adjust';
            ?>
                    <li>
                        <span class="contact-icon <?php echo $iconClass; ?>"></span>
                        <span class="contact-label"><?php echo esc_html($contact['title']); ?></span>
                        <span class="contact-description"><?php echo ( $contact['description'] ); ?></span>
                    </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>