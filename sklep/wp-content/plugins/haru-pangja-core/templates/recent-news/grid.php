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
            <div class="row">
                <?php while( $recent_news->have_posts() ) : $recent_news->the_post(); ?>
                <?php $thumbnail_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>
                <article class="recent-news-item col-md-6 col-sm-6 col-xs-12">
                    <div class="post-thumbnail">
                        <div class="post-image">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="overlay-bg">
                        </div>
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <div class="post-meta-date"><?php echo date_i18n( get_option( 'date_format' ), strtotime(get_the_date('Y-m-d')) ); ?></div>
                            <div class="post-meta-author"><span class="post-by"><?php echo esc_html__('by', 'haru-pangja') ?></span>
                                <?php printf('<a href="%1$s">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() )); ?>
                            </div>
                        </div>
                        <h3 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                        <div class="post-excerpt">
                            <?php 
                                if ( has_excerpt() ) {
                                    echo wp_trim_words( get_the_excerpt(), $excerpt_length, '...' );
                                } else {
                                    echo wp_trim_words( get_the_content(), $excerpt_length, '...' ); 
                                }
                            ?>
                        </div>
                    </div>
                </article>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="item-not-found"><?php echo esc_html__( 'No item found', 'haru-pangja' ) ?></div>
<?php endif; ?>