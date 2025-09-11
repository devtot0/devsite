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

<div class="post-meta-info">
    <h3 class="post-title"><?php the_title(); ?></h3>
    <div class="post-info">
        <?php if ( has_category() ) : ?>
        <div class="post-meta-author"><span class="post-by"><?php echo esc_html__('by', 'pangja') ?></span>
            <?php printf('<a href="%1$s">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() )); ?>
        </div>
        <?php endif; ?>
        <span class="post-on"><?php echo esc_html__( 'on', 'pangja' ); ?></span>
        <div class="post-meta-date"><?php echo date_i18n( get_option( 'date_format' ), strtotime(get_the_date('Y-m-d')) ); ?></div>
        <?php
            // Use only when active all plugin
            if ( true == haru_check_core_plugin_status() ) : 
        ?>
        <div class="post-meta-views"><i class="icon-eye"></i><?php echo haru_count_post_views( get_the_ID() ); ?></div>
        <?php endif; ?>
        <div class="post-meta-comment">
            <i class="icon-bubbles"></i>
            <?php 
                $num_comments = get_comments_number();
                if ( $num_comments == 0 ) {
                    $comments = esc_html__( 'No Comments', 'pangja' );
                } elseif ( $num_comments > 1 ) {
                    $comments = $num_comments . esc_html__( ' Comments', 'pangja' );
                } else {
                    $comments = esc_html__( '1 Comment', 'pangja' );
                }
                printf('<a href="%1$s">%2$s</a>', esc_url( get_comments_link() ), $comments ); 
            ?>
        </div>
        <?php if ( is_sticky() ) : ?>
        <div class="post-meta-sticky"><i class="fa fa-flag"></i><?php echo esc_html__( 'Sticky', 'pangja' ); ?></div>
        <?php endif; ?>
    </div>
</div>