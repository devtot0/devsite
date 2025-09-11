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
$image_src = wp_get_attachment_url($image);

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
        <div class="testimonial-list slider-for" data-slick='{"slidesToShow" : 1, "slidesToScroll" : 1, "arrows" : false, "infinite" : true, "asNavFor" : ".slider-nav", "focusOnSelect" : true, "vertical" : false, "responsive" : [{"breakpoint": 767,"settings":{"slidesToShow": 1}}] }'
        style="background-image: url('<?php echo esc_attr($image_src); ?>')">
            <?php while( $testimonials->have_posts() ) : $testimonials->the_post(); ?>
            <div class="testimonial-item">
                <div class="quote-sign"><i class="fa fa-quote-left"></i></div>
                <div class="testimonial-content"><?php echo wp_kses_post(get_the_content()); ?></div>
                <div class="testimonial-meta">
                    <h3 class="testimonial-title"><?php the_title(); ?></h3> - 
                    <?php if( !empty(haru_get_post_meta( get_the_ID(), 'haru_testimonial_position' )) ) : ?>
                    <p class="testimonial-position"><?php echo haru_get_post_meta( get_the_ID(), 'haru_testimonial_position' )['0']; ?></p>
                    <?php endif; ?>
                    <?php if( !empty(haru_get_post_meta( get_the_ID(), 'haru_testimonial_special' )) ) : ?>
                    <p class="testimonial-special"><?php echo haru_get_post_meta( get_the_ID(), 'haru_testimonial_special' )['0']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="testimonial-right">
            <div class="testimonial-title-content">
                <h5 class="testimonial-title"><?php echo esc_html( $testimonial_title ); ?></h5>
                <p class="testimonial-desc"><?php echo esc_html( $testimonial_desc ); ?></p>
            </div>
            <div class="testimonial-nav slider-nav" data-slick='{"slidesToShow" : 4, "slidesToScroll" : 1, "arrows" : false, "infinite" : true, "asNavFor" : ".slider-for", "focusOnSelect" : true, "vertical" : false, "responsive" : [{"breakpoint": 767,"settings":{"slidesToShow": 3}}] }'>
                <?php while( $testimonials->have_posts() ) : $testimonials->the_post(); ?>
                    <div class="nav-item">
                        <?php the_post_thumbnail(); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="item-not-found"><?php echo esc_html__( 'No item found', 'haru-pangja' ) ?></div>
<?php endif; ?>