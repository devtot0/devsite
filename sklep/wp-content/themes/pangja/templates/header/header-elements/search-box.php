<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

$search_box_type = haru_get_option('haru_search_box_type');

?>
<div class="header-elements-item search-box-wrap">
    <div class="haru-search-box-wrap" data-hint-message="<?php echo esc_attr__( 'Please type at least 3 character to search...', 'pangja' ) ?>">
	    <form method="get" action="<?php echo esc_url(site_url()); ?>" class="search-box-form search-box" data-search-type="<?php echo esc_attr($search_box_type); ?>">
	        <input type="text" name="s" autocomplete="off" placeholder="<?php echo esc_attr__( 'Search...', 'pangja' ); ?>"/>
	        <button type="submit"><i class="header-icon icon-magnifier"></i></button>
	        <input type="hidden" name="post_type" value="product">
	    </form>
	    <?php if ( $search_box_type == 'ajax' ) : ?>
            <div class="ajax-search-result"></div>
        <?php endif; ?>
    </div>
</div>