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
    'post__in'       => explode(",", $member_ids),
    'posts_per_page' => $posts_per_page, // -1 is Unlimited member
    'post_type'      => 'haru_teammember',
    'post_status'    => 'publish'
);

if ( $data_source == '' ) {
    $args = array(
        'posts_per_page' => $posts_per_page, // -1 is Unlimited member
        'orderby'        => 'post_date',
        'order'          => $order,
        'post_type'      => 'haru_teammember',
        'post_status'    => 'publish',
        'tax_query'      => array(
            array(
                'taxonomy' => 'team_category',
                'field'    => 'slug',
                'terms'    => explode(',', $category),
            )
        )
    );
}
$teammembers = new WP_Query($args);
// Equeue assets
if ( $layout_type == 'grid' ) {
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/libraries/owl-carousel/assets/owl.carousel.min.css', array(), false );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/libraries/owl-carousel/owl.carousel.min.js', false, true );
}
           
?>
<?php if ( $teammembers->have_posts() ) : ?>
    <div class="teammember-shortcode-wrap <?php echo $layout_type . ' ' . $el_class; ?>">
        <div class="haru-carousel teammember-list owl-carousel owl-theme"
            data-items="<?php echo esc_attr($columns); ?>"
            data-items-desktop="<?php echo esc_attr($columns); ?>"
            data-items-tablet="3"
            data-items-mobile="1"
            data-margin="30"
            data-autoplay="<?php echo esc_attr($autoplay); ?>"
            data-slide-duration="<?php echo esc_attr($slide_duration); ?>"
            data-loop="true"
            data-counter="true"
        >
            <?php while( $teammembers->have_posts() ) : $teammembers->the_post(); ?>
            <div class="team-item">
                <div class="team-content">
                    <div class="team-image">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                    <div class="team-meta">
                        <div class="team-meta-content">
                            <div class="team-info">
                                <?php
                                    $detail_link_id = get_post_meta( get_the_ID(), 'haru_teammember_url', true );
                                ?>
                                <h5 class="team-title">
                                    <?php if ( $detail_link_id != '' ) : ?>
                                    <a href="<?php echo esc_url( get_permalink( $detail_link_id ) ); ?>" target="_self">
                                    <?php endif; ?>
                                        <?php the_title(); ?>
                                    <?php if ( $detail_link_id != '' ) : ?>
                                    </a>
                                    <?php endif; ?>
                                </h5>
                                <?php if( !empty(haru_get_post_meta( get_the_ID(), 'haru_teammember_position' )) ) : ?>
                                <p class="team-position"><?php echo haru_get_post_meta( get_the_ID(), 'haru_teammember_position', true ); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if ( !empty(get_post_meta( get_the_ID(), 'haru_teammember_social', true )) ) : 
                                $haru_teammember_social = get_post_meta( get_the_ID(), 'haru_teammember_social', true );
                            ?>
                                <ul class="member-socials">
                                <?php foreach( $haru_teammember_social as $social ) : ?>
                                    <li class="member-social"><a href="<?php echo esc_url( $social['url'] ); ?>"><i class="<?php echo esc_attr( $social['icon'] ); ?>"></i><?php echo esc_html( $social['network'] ); ?></a></li>
                                <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php else : ?>
    <div class="item-not-found"><?php echo esc_html__( 'No item found', 'haru-pangja' ) ?></div>
<?php endif; ?>