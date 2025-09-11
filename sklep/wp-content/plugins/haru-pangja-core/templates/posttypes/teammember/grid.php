<?php
/**
 * @package    HaruTheme/Haru Pharmacy
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

extract( $atts );

global $paged;
            
if ( is_front_page() ) {
    $paged   = get_query_var( 'page' ) ? intval( get_query_var( 'page' ) ) : 1;
} else {
    $paged   = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
}

$args = array(
    'orderby'        => 'post__in',
    'post__in'       => explode(",", $member_ids),
    'posts_per_page' => $posts_per_page, // -1 is Unlimited member
    'post_type'      => 'haru_teammember',
    'paged'          => $paged,
    'post_status'    => 'publish'
);

if ( $data_source == '' ) {
    $args = array(
        'posts_per_page' => $posts_per_page, // -1 is Unlimited member
        'orderby'        => $orderby,
        'order'          => $order,
        'post_type'      => 'haru_teammember',
        'paged'          => $paged,
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

$teammembers_paging_class   = array('teammember-shortcode-paging-wrapper');
$teammembers_paging_class[] = 'paging-' . $paging_style;    
// Equeue assets
wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/assets/libraries/imagesloaded/imagesloaded.min.js', false, true );
wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/libraries/isotope/isotope.pkgd.min.js', false, true );
?>
<?php if ( $teammembers->have_posts() ) : ?>
    <div class="teammember-shortcode-wrap <?php echo esc_attr( $layout_type . ' ' . $el_class ); ?>">
        <?php if ( $filter == 'show' ) : 
            $slugSelected = explode(',', $category);
            $terms = get_terms(
                array(
                    'taxonomy'  => 'team_category',
                    'slug'      => $slugSelected,
                    'orderby'   => 'slug__in',
                )
            );
        ?>
        <ul data-option-key="filter" class="teammember-filter <?php echo esc_attr( $filter_style . ' ' . $filter_align ); ?>">
            <li>
                <a class=""
                    href="javascript:;" 
                    data-option-value="*"
                ><?php echo esc_html__( 'All', 'haru-formota' ); ?></a>
            </li>
            <?php foreach ($terms as $term) : ?>
            <li>
                <a class=""
                    href="javascript:;" 
                    data-option-value =".<?php echo esc_attr($term->slug); ?>"
                ><?php echo wp_kses_post( $term->name ); ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <div class="teammember-list padding-10 columns-<?php echo esc_attr( $columns ); ?>">
            <?php while( $teammembers->have_posts() ) : $teammembers->the_post(); 
                $terms          = wp_get_post_terms(get_the_ID(), array('team_category'));
                $filter_slug = '';
                foreach ( $terms as $term ) {
                    $filter_slug .= $term->slug . ' ';
                }
            ?>
            <div class="team-item <?php echo esc_attr( $filter_slug ); ?>" onclick="void(0)">
                <div class="team-content">
                    <div class="team-image">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                    <div class="team-meta">
                        <div class="team-meta-content">
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
                            <div class="team-info">
                                <?php if( !empty(haru_get_post_meta( get_the_ID(), 'haru_teammember_position' )) ) : ?>
                                <p class="team-position"><?php echo haru_get_post_meta( get_the_ID(), 'haru_teammember_position', true ); ?></p>
                                <?php endif; ?>
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
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php if ( ( $teammembers->max_num_pages > 1 ) && ( $paging_style != 'none' ) ) : ?>
        <div class="<?php echo join(' ', $teammembers_paging_class); ?>">
            <?php
                switch ( $paging_style ) {
                    case 'load-more':
                        haru_paging_load_more_teammember($teammembers);
                        break;
                    case 'infinity-scroll':
                        haru_paging_infinitescroll_teammember($teammembers);
                        break;
                    default:
                        echo haru_paging_nav_teammember($teammembers);
                        break;
                }
            ?>
        </div>
    <?php endif; ?>
<?php else : ?>
    <div class="item-not-found"><?php echo esc_html__( 'No item found', 'haru-formota' ) ?></div>
<?php endif; ?>