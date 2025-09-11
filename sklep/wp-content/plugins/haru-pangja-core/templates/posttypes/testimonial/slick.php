<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

extract( $atts );

$args = array(
    'orderby'        => 'post__in',
    'post__in'       => explode(",", $testimonial_ids),
    'posts_per_page' => -1, // Unlimited testimonial
    'post_type'      => 'haru_testimonial',
    'post_status'    => 'publish');

if ($data_source == '') {
    $args = array(
        'posts_per_page'       => -1, // Unlimited testimonial
        'orderby'              => 'post_date',
        'order'                => $order,
        'post_type'            => 'haru_testimonial',
        'post_status'          => 'publish',
        'tax_query'      => array(
            array(
                'taxonomy' => 'testimonial_category',
                'field'    => 'slug',
                'terms'    => explode(',', $category),
            )
        )
    );
}

$testimonials = new WP_Query($args);
// Enqueue assets
wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/libraries/slick/slick.css', array(), false );
wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/libraries/slick/slick.min.js', false, true );
?>
<?php if( $testimonials->have_posts() ) : ?>
    <div class="testimonial-shortcode-wrap <?php echo esc_attr( $layout_type . ' ' . $el_class ); ?>">
        <div class="testimonial-left">
            <div class="testimonial-title-content">
                <h5 class="testimonial-title"><?php echo esc_html( $testimonial_title ); ?></h5>
                <p class="testimonial-desc"><?php echo esc_html( $testimonial_desc ); ?></p>
            </div>
            <div class="slick-actions">
                <div class="slick-action slick-prev"><i class="ion ion-md-arrow-back"></i></div>
                <div class="slick-action slick-next"><i class="ion ion-md-arrow-forward"></i></div>
            </div>
        </div>
        <div class="testimonial-list" data-slick='{"slidesToShow" : 1, "slidesToScroll" : 1, "arrows" : false, "infinite" : true, "centerMode" : true, "focusOnSelect" : true, "vertical" : false, "centerPadding": "35%", "responsive" : [{"breakpoint": 767,"settings":{"slidesToShow": 1, "centerPadding": "0"}}] }'>
            <?php while( $testimonials->have_posts() ) : $testimonials->the_post(); ?>
            <div class="testimonial-item">
                <div class="testimonial-content">
                    <div class="testimonial-top">
                        <div class="testimonial-image">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="testimonial-author-meta">
                            <?php if( !empty(haru_get_post_meta( get_the_ID(), 'haru_testimonial_rating' )) ) : ?>
                            <div class="testimonial-rating">
                                <?php
                                    $rating = intval(haru_get_post_meta( get_the_ID(), 'haru_testimonial_rating', true ));
                                    for( $i = 0; $i < $rating; $i++ ) :
                                ?>
                                <span class="ion-ios-star"></span>
                                <?php endfor; ?>
                            </div>
                            <?php endif; ?>
                            <span class="testimonial-title"><?php the_title(); ?></span>
                            <?php if( !empty(haru_get_post_meta( get_the_ID(), 'haru_testimonial_position' )) ) : ?>
                            <span class="testimonial-position"><?php echo haru_get_post_meta( get_the_ID(), 'haru_testimonial_position', true ); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="text-testimonial"><?php echo wp_kses_post(get_the_content()); ?></div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php else : ?>
    <div class="item-not-found"><?php echo esc_html__( 'No item found', 'haru-pangja' ) ?></div>
<?php endif; ?>