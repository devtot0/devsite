<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

if( ! class_exists( 'Haru_PangjaCore_Posttypes' ) ) {
	class Haru_PangjaCore_Posttypes {
		static $instance;

		public static function init() {
			if( !isset(self::$instance) ) {
				self::$instance = new Haru_PangjaCore_Posttypes;
				add_action( 'init', array(self::$instance, 'includes'), 0 );
			}

			return self::$instance;
		}

		public function includes() {
			require_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/posttypes/footer.php');
			require_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/posttypes/teammember.php');
			require_once( PLUGIN_HARU_PANGJA_CORE_DIR . 'includes/posttypes/testimonial.php');
		}
	}

	if ( ! function_exists('init_haru_pangja_framework_posttypes') ) {
        function init_haru_pangja_framework_posttypes() {
            return Haru_PangjaCore_Posttypes::init();
        }

        init_haru_pangja_framework_posttypes();
    }
}