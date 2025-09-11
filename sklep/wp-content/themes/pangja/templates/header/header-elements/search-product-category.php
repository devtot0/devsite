<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

$categories       = get_categories(array( 'taxonomy' => 'product_cat' ));
$category_content = haru_categories_binder($categories, '0');
?>
<div class="header-elements-item search-product-category" data-hint-message="<?php echo esc_attr__( 'Please type at least 3 character to search...', 'pangja' ) ?>">
    <div class="search-product-category-wrap d-flex">
        <div class="select-category align-self-center">
            <span data-catid="-1"><?php echo esc_html__( 'Categories', 'pangja' ); ?></span>
            <?php if ( !empty($category_content) ) : ?>
                <?php echo wp_kses_post($category_content) ?>
            <?php endif; ?>
        </div>
        <div class="ajax-search-form align-self-center d-flex justify-content-center">
            <input type="text" name="s" autocomplete="off" placeholder="<?php echo esc_attr__( 'Search product...', 'pangja' ) ?>" />
            <button type="button"><i class="icon-magnifier"></i></button>
        </div>
    </div>
    <!-- Need change to option -->
    <div class="ajax-search-result"></div>
</div>