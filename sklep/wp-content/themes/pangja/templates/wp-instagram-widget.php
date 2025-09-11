<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

echo '<li class="' . esc_attr( $liclass ) . '">
        <a href="' . esc_url( $item['link'] ) . '" target="' . esc_attr( $target ) . '"  class="' . esc_attr( $aclass ) . '">
            <img src="' .   esc_url( $item[$size] ) . '"  alt="' . esc_attr( $item['description'] ) . '" title="' . esc_attr( $item['description'] ) . '"  class="' . esc_attr( $imgclass ) . '"/>
            <span class="instagram-info">
	            <span><i class="ti-comment"></i>' . esc_html( $item['comments'] ) . '</span>
	            <span><i class="ti-thumb-up"></i>' . esc_html( $item['likes'] ) . '</span>
            </span>
        </a>
    </li>'; 
?>