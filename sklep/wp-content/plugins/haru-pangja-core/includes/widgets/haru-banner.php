<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

class Haru_Widget_Banner extends HARU_Widget {
    public function __construct() {
        $this->widget_cssclass    = 'widget-banner';
        $this->widget_description = esc_html__( 'Haru Banner Widget', 'haru-pangja' );
        $this->widget_id          = 'haru-banner';
        $this->widget_name        = esc_html__( 'Haru Banner', 'haru-pangja' );
        $this->settings           = array(
            'title'  => array(
                'type'  => 'text',
                'std'   =>'',
                'label' => esc_html__( 'Title', 'haru-pangja' )
            ),
            'image' => array(
                'type'  => 'image',
                'std'   => '',
                'label' => esc_html__( 'Image', 'haru-pangja' )
            ),
            'description' => array(
                'type'  => 'text',
                'std'   => 'Description',
                'label' => esc_html__( 'Description', 'haru-pangja' )
            ),
            'url' => array(
                'type'  => 'text',
                'std'   => '#',
                'label' => esc_html__( 'Url', 'haru-pangja' )
            ),
            'style' => array(
                'type'    => 'select',
                'std'     => '',
                'label'   => esc_html__( 'Style', 'haru-pangja' ),
                'options' => array(
                    'style_1' => esc_html__( 'Style 1', 'haru-pangja' ),
                )
            ),
        );
        parent::__construct();
    }

    function widget( $args, $instance ) {
        if ( $this->get_cached_widget( $args ) )
            return;

        extract( $args, EXTR_SKIP );
        $title          = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
        $image    = ( ! empty( $instance['image'] ) ) ? $instance['image'] : '';
        $description   = ( ! empty( $instance['description'] ) ) ? $instance['description'] : '';
        $url = ( ! empty( $instance['url'] ) ) ? $instance['url'] : '';
        $style = ( ! empty( $instance['style'] ) ) ? $instance['style'] : '';

        ob_start();
        echo wp_kses_post($args['before_widget']);
        if ( $title )
            echo $before_title . $title . $after_title;
        ?>
            <div class="banner-widget-wrap <?php echo esc_attr( $style ); ?>">
                <div class="banner-content-wrap">
                    <a href="<?php echo esc_url( $url ); ?>" target="_self">
                        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>">
                        <div class="banner-content-inner">
                            <div class="banner-content">
                                <h1 class="banner-title"><?php echo esc_html( $description ); ?></h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php
        echo wp_kses_post($args['after_widget']);
        $content =  ob_get_clean();
        echo wp_kses_post($content);
        $this->cache_widget( $args, $content );
    }
}

if (!function_exists('haru_register_widget_bannner')) {
    function haru_register_widget_bannner() {
        register_widget('Haru_Widget_Banner');
    }
    add_action('widgets_init', 'haru_register_widget_bannner', 1);
}