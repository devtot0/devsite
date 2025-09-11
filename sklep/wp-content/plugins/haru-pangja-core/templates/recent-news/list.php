<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

extract( $atts );

$args = array(
    'posts_per_page' => $posts_per_page,
    'orderby'        => $orderby,
    'order'          => $order,
    'category_name'  => strtolower($category),
    'post_status'    => 'publish'
);

// If data_source = list_id
if ( $data_source == 'list_id' ) {
    $args = array(
        'posts_per_page' => $posts_per_page,
        'orderby'        => $orderby,
        'order'          => $order,
        'post_status'    => 'publish',
        'post__in'       =>  explode( ',' , $post_ids )
    );
}
$recent_news = new WP_Query($args);
// Enqueue assets

?>
<?php if ( $recent_news->have_posts() ) : ?>
    <div class="recent-news-shortcode-wrap <?php echo esc_attr($layout_type . ' ' . $el_class); ?>">
        <div class="recent-news-container" >
            <?php while( $recent_news->have_posts() ) : $recent_news->the_post(); ?>
            <article class="recent-news-item">
                <div class="post-left">
                    <div class="post-meta-date">
                        <div class="post-day"><?php echo date_i18n( 'd', strtotime(get_the_date('Y-m-d')) ); ?></div>
                        <div class="post-month"><?php echo date_i18n( 'M', strtotime(get_the_date('Y-m-d')) ); ?></div>
                    </div>
                </div>
                <div class="post-content">
                    <div class="post-meta">
                        <div class="post-meta-views"><i class="icon-eye"></i><?php echo haru_count_post_views( get_the_ID() ); ?></div>
                        <div class="post-meta-comment">
                            <i class="fa fa-comments-o"></i>
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
                    </div>
                    <h3 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                </div>
            </article>
            <?php endwhile; ?>
        </div>
    </div>
<?php else : ?>
    <div class="item-not-found"><?php echo esc_html__( 'No item found', 'haru-pangja' ) ?></div>
<?php endif; ?>