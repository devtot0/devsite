<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

/*-----------------------------------
 * 1. Paging Load More Teammember
 *-----------------------------------*/
if ( ! function_exists('haru_paging_load_more_teammember') ) {
    function haru_paging_load_more_teammember( $posts ) {
        // Don't print empty markup if there's only one page.
        if ( $posts->max_num_pages < 2 ) {
            return;
        }
        $link = get_next_posts_page_link($posts->max_num_pages);
        if (!empty($link)) :
            ?> 
                <button data-href="<?php echo esc_url($link); ?>" type="button"  data-loading-text="<span class='fa fa-spinner fa-spin'></span> <?php esc_html_e( 'Loading...','haru-pangja' ); ?>" class="teammember-load-more">
                    <?php echo esc_html__( 'View More', 'haru-pangja' ); ?>
                </button>
        <?php
        endif;
    }
}

/*-----------------------------------
 * 2. Paging Infinite Scroll Teammember
 *-----------------------------------*/
if ( ! function_exists('haru_paging_infinitescroll_teammember') ) {
    function haru_paging_infinitescroll_teammember( $posts ) {
        // Don't print empty markup if there's only one page.
        if ( $posts->max_num_pages < 2 ) {
            return;
        }
        $link = get_next_posts_page_link($posts->max_num_pages);
        if (!empty($link)) :
            ?>
            <nav id="infinite_scroll_button">
                <a href="<?php echo esc_url($link); ?>"></a>
            </nav>
            <div id="infinite_scroll_loading" class="text-center infinite-scroll-loading"></div>
        <?php
        endif;
    }
}

/*-----------------------------------
 * 18. Paging Nav Teammember
 *-----------------------------------*/
if ( ! function_exists( 'haru_paging_nav_teammember' ) ) {
    function haru_paging_nav_teammember($posts) {
        global $wp_rewrite, $paged;
        // Don't print empty markup if there's only one page.
        if ( $posts->max_num_pages < 2 ) {
            return;
        }

        $pagenum_link = html_entity_decode( get_pagenum_link() );
        $query_args   = array();
        $url_parts    = explode( '?', $pagenum_link );

        if ( isset( $url_parts[1] ) ) {
            wp_parse_str( $url_parts[1], $query_args );
        }

        $pagenum_link = esc_url(remove_query_arg( array_keys( $query_args ), $pagenum_link ));
        $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

        $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
        $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

        // Set up paginated links.
        $page_links = paginate_links( array(
            'base'      => $pagenum_link,
            'format'    => $format,
            'total'     => $posts->max_num_pages,
            'current'   => $paged,
            'mid_size'  => 1,
            'add_args'  => array_map( 'urlencode', $query_args ),
            'prev_text' => esc_html__( 'Prev', 'haru-pangja' ),
            'next_text' => esc_html__( 'Next', 'haru-pangja' ),
            'type'      => 'array'
        ) );

        if (count($page_links) == 0) return;

        $links = "<div class='teammember-pagination'>";
        $links .= "<ul class='page-numbers'>\n\t<li>";
        $links .= join("</li>\n\t<li>", $page_links);
        $links .= "</li>\n</ul>\n";
        $links .= "</div>";

        return $links;
    }
}