<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

?>
<ul class="header-elements-item post-category-wrap">
    <?php wp_list_categories(array(
        'show_count' => 0,
        'depth' => 1,
        'order'               => 'ASC',
        'orderby'             => 'name',
        'style'               => 'list',
        'title_li' => '<h2>' . esc_html__('Categories', 'pangja') . '</h2>'
        ));
    ?>
</ul>