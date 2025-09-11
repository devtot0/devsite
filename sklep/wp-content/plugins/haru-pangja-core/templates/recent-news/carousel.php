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
if ( $layout_type == 'carousel' || $layout_type == 'carousel_2' ) {
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/libraries/owl-carousel/assets/owl.carousel.min.css', array(),false );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/libraries/owl-carousel/owl.carousel.min.js', false, true );
}
?>
<?php if ( $recent_news->have_posts() ) : ?>
    <div class="recent-news-shortcode-wrap <?php echo esc_attr($layout_type . ' ' . $el_class); ?>">
        <div class="haru-carousel recent-news-container owl-carousel owl-theme"
            data-items="<?php echo esc_attr($columns); ?>"
            data-items-tablet="2"
            data-items-mobile="1"
            data-margin="30"
            data-autoplay="<?php echo esc_attr($autoplay); ?>"
            data-slide-duration="<?php echo esc_attr($slide_duration); ?>"
        >
            <?php while( $recent_news->have_posts() ) : $recent_news->the_post(); ?>
            <?php $thumbnail_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>
            <article class="recent-news-item">
                <div class="post-thumbnail">
                    <div class="post-image">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="post-category">
                        <?php if ( has_category() ) : ?>
                            <?php echo get_the_category_list(', '); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="post-content">
                    <div class="post-meta">
                        <div class="post-meta-date"><i class="icon-calendar"></i><?php echo date_i18n( get_option( 'date_format' ), strtotime(get_the_date('Y-M-d')) ); ?></div>
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
                    <div class="post-excerpt">
                        <?php 
                            if ( has_excerpt() ) {
                                echo wp_trim_words( get_the_excerpt(), $excerpt_length, '...' );
                            } else {
                                echo wp_trim_words( get_the_content(), $excerpt_length, '...' ); 
                            }
                        ?>
                    </div>
                    <div class="post-readmore">
                        <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" target="_self"><?php echo esc_html__( 'Read More', 'haru-pangja' ); ?><i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </article>
            <?php endwhile; ?>
        </div>
    </div>
<?php else : ?>
    <div class="item-not-found"><?php echo esc_html__( 'No item found', 'haru-pangja' ) ?></div>
<?php endif; ?>