<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

class Haru_Social_Profile extends Haru_Widget {
    public function __construct() {
        $this->widget_cssclass    = 'widget-social-profile';
        $this->widget_description = esc_html__( 'Social profile widget', 'haru-pangja' );
        $this->widget_id          = 'haru-social-profile';
        $this->widget_name        = esc_html__( 'Haru Social Profile', 'haru-pangja' );
        $this->settings           = array(
            'label' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Label','haru-pangja' )
            ),
	        'type'  => array(
                'type'    => 'select',
                'std'     => '',
                'label'   => esc_html__( 'Type', 'haru-pangja' ),
                'options' => array(
                    'social-icon-no-border' => esc_html__( 'No Border', 'haru-pangja' ),
                    'social-icon-bordered'  => esc_html__( 'Bordered', 'haru-pangja' )
                )
            ),
            'icons' => array(
				'type'    => 'multi-select',
				'label'   => esc_html__( 'Select social profiles', 'haru-pangja' ),
				'std'     => '',
				'options' => array(
					'twitter'    => esc_html__( 'Twitter', 'haru-pangja' ),
					'facebook'   => esc_html__( 'Facebook', 'haru-pangja' ),
					'vimeo'      => esc_html__( 'Vimeo', 'haru-pangja' ),
					'linkedin'   => esc_html__( 'LinkedIn', 'haru-pangja' ),
					'googleplus' => esc_html__( 'Google+', 'haru-pangja' ),
					'flickr'     => esc_html__( 'Flickr', 'haru-pangja' ),
					'youtube'    => esc_html__( 'YouTube', 'haru-pangja' ),
					'pinterest'  => esc_html__( 'Pinterest', 'haru-pangja' ),
					'instagram'  => esc_html__( 'Instagram', 'haru-pangja' ),
					'behance'    => esc_html__( 'Behance', 'haru-pangja' ),
	            )
            )
        );
        parent::__construct();
    }

    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
		$label        = empty( $instance['label'] ) ? '' : apply_filters( 'widget_label', $instance['label'] );
		$type         = empty( $instance['type'] ) ? '' : apply_filters( 'widget_type', $instance['type'] );
		$icons        = empty( $instance['icons'] ) ? '' : apply_filters( 'widget_icons', $instance['icons'] );
		$widget_id    = $args['widget_id'];
		$social_icons = haru_get_social_icon($icons,'social-profile ' . $type );
	    echo wp_kses_post( $before_widget );
	    ?>
	    <?php if (!empty($label)) : ?>
		    <span><?php echo wp_kses_post($label); ?></span>
		<?php endif; ?>
		    <?php echo wp_kses_post( $social_icons ); ?>
	    <?php
	    echo wp_kses_post( $after_widget );
    }
}
if ( ! function_exists('haru_register_social_profile') ) {
    function haru_register_social_profile() {
        register_widget('Haru_Social_Profile');
    }

    add_action('widgets_init', 'haru_register_social_profile', 1);
}