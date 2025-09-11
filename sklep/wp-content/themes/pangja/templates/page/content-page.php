<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

// One Page
$page_ongepage = get_post_meta(  get_the_ID(), 'haru_' . 'page_onepage', true );
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div <?php if( $page_ongepage == '1' ) echo wp_kses_post('id="fullpage"');  ?> class="entry-content">
        <?php the_content(); ?>
    </div>
    <?php wp_link_pages(array(
        'before'      => '<div class="haru-page-links"><span class="haru-page-links-title">' . esc_html__( 'Pages:', 'pangja' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span class="haru-page-link">',
        'link_after'  => '</span>',
    )); ?>
</div>