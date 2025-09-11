<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

$data_search_type = 'standard';

$search_box_type = haru_get_option('haru_search_box_type');
if ( isset($search_box_type)  && $search_box_type == 'ajax' ) {
    $data_search_type = 'ajax';
}
?>
<div class="header-elements-item search-button-wrap">
    <a href="javascript:;" class="header-search-button" data-search-type="<?php echo esc_attr($data_search_type) ?>"><i class="icon-magnifier"></i></a>
</div>