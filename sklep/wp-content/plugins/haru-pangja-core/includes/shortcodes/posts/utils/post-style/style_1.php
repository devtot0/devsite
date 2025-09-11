<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/
$excerpt_length = 35;
?>
<li class="post-item special <?php post_class(); ?>">
	<article class="recent-news-item">
        <div class="post-thumbnail">
            <div class="post-image">
                <?php the_post_thumbnail(); ?>
            </div>
            <div class="overlay-bg">
            </div>
        </div>
        <div class="post-content">
            <div class="post-meta">
            	<div class="post-category"><?php echo get_the_category_list(' / '); ?></div>
                <div class="post-meta-date"><?php echo date_i18n( get_option( 'date_format' ), strtotime(get_the_date('Y-m-d')) ); ?></div>
            </div>
            <h3 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
            <p class="post-excerpt">
                <?php 
                    if ( has_excerpt() ) {
                        echo wp_trim_words( get_the_excerpt(), $excerpt_length, '...' ); 
                    } else {
                        echo wp_trim_words( get_the_content(), $excerpt_length, '...' ); 
                    }
                ?>
            </p>
        </div>
    </article>
</li>