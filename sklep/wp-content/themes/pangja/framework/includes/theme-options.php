<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux_Framework_theme_options' ) ) {

    class Redux_Framework_theme_options {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
            if ( ! class_exists( 'HaruReduxFramework' ) ) {
                return;
            }

            $this->initSettings();
        }

        public function initSettings() {
            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'init', array( $this, 'remove_demo' ) );

            if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                return;
            }

            $this->ReduxFramework = new HaruReduxFramework( $this->sections, $this->args );
        }

        /**
         * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments( $args ) {
            $args['dev_mode'] = false;

            return $args;
        }

        /**
         * Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {
            // General Setting
            $this->sections[] = array(
                'title'  => esc_html__( 'General Setting', 'pangja' ),
                'desc'   => esc_html__( 'Welcome to Haru Pangja theme options panel! You can easy to customize the theme for your purpose!', 'pangja' ),
                'icon'   => 'el el-cog',
                'fields' => array(
                    array(
                        'id'       => 'haru_layout_style',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Layout Style', 'pangja' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'wide'  => array(
                                'title' => esc_html__( 'Wide', 'pangja' ), 
                                'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/layout-wide.png'
                            ),
                            'boxed' => array(
                                'title' => esc_html__( 'Boxed', 'pangja' ), 
                                'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/layout-boxed.png'
                            ),
                            'float' => array(
                                'title' => esc_html__( 'Float', 'pangja' ), 
                                'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/layout-float.png'
                            )
                        ),
                        'default'  => 'wide'
                    ),

                    array(
                        'id'       => 'haru_layout_site_max_width',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Site Max Width (px)', 'pangja' ),
                        'subtitle' => esc_html__( 'Set the site max width of body', 'pangja' ),
                        'default'  => '1200',
                        "min"      => 980,
                        "step"     => 10,
                        "max"      => 1600,
                        'required' => array('haru_layout_style','=','boxed'),
                    ),

                    array(
                        'id'       => 'haru_body_background_mode',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Body Background Mode', 'pangja' ),
                        'subtitle' => esc_html__( 'Chose Background Mode', 'pangja' ),
                        'desc'     => '',
                        'options'  => array(
                            'background' => esc_html__( 'Background', 'pangja' ),
                            'pattern'    => esc_html__( 'Pattern', 'pangja' )
                        ),
                        'default'  => 'background',
                        'required' => array('haru_layout_style','=','boxed'),
                    ),

                    array(
                        'id'       => 'haru_body_background',
                        'type'     => 'background',
                        'output'   => array( 'body' ),
                        'title'    => esc_html__( 'Body Background', 'pangja' ),
                        'subtitle' => esc_html__( 'Body background (Use only for Boxed layout style).', 'pangja' ),
                        'default'  => array(
                            'background-color'      => '',
                            'background-repeat'     => 'no-repeat',
                            'background-position'   => 'center center',
                            'background-attachment' => 'fixed',
                            'background-size'       => 'cover'
                        ),
                        'required'  => array(
                            array('haru_body_background_mode', '=', array('background'))
                        ),
                    ),

                    array(
                        'id'       => 'haru_body_background_pattern',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Background Pattern', 'pangja' ),
                        'subtitle' => esc_html__( 'Body background pattern (Use only for Boxed layout style)', 'pangja' ),
                        'desc'     => '',
                        'height'   => '40px',
                        'options'  => array(
                            'pattern-1.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-1.png'),
                            'pattern-2.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-2.png'),
                            'pattern-3.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-3.png'),
                            'pattern-4.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-4.png'),
                            'pattern-5.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-5.png'),
                            'pattern-6.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-6.png'),
                            'pattern-7.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-7.png'),
                            'pattern-8.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-8.png'),
                            'pattern-9.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-9.png'),
                            'pattern-10.png' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/pattern-10.png'),
                        ),
                        'default'  => 'pattern-1.png',
                        'required' => array(
                            array('haru_body_background_mode', '=', array('pattern'))
                        ) ,
                    ),
                    
                    array(
                        'id'       => 'haru_home_preloader',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Page Preloader', 'pangja' ),
                        'subtitle' => esc_html__( 'Please leave empty if you don\'t want to use this!', 'pangja' ),
                        'desc'     => '',
                        'options'  => array(
                            'square-1'   => esc_html__('Square 01', 'pangja' ),
                            'square-2'   => esc_html__('Square 02', 'pangja' ),
                            'square-3'   => esc_html__('Square 03', 'pangja' ),
                            'square-4'   => esc_html__('Square 04', 'pangja' ),
                            'square-5'   => esc_html__('Square 05', 'pangja' ),
                            'square-6'   => esc_html__('Square 06', 'pangja' ),
                            'square-7'   => esc_html__('Square 07', 'pangja' ),
                            'square-8'   => esc_html__('Square 08', 'pangja' ),
                            'square-9'   => esc_html__('Square 09', 'pangja' ),
                            'round-1'    => esc_html__('Round 01', 'pangja' ),
                            'round-2'    => esc_html__('Round 02', 'pangja' ),
                            'round-3'    => esc_html__('Round 03', 'pangja' ),
                            'round-4'    => esc_html__('Round 04', 'pangja' ),
                            'round-5'    => esc_html__('Round 05', 'pangja' ),
                            'round-6'    => esc_html__('Round 06', 'pangja' ),
                            'round-7'    => esc_html__('Round 07', 'pangja' ),
                            'round-8'    => esc_html__('Round 08', 'pangja' ),
                            'round-9'    => esc_html__('Round 09', 'pangja' ),
                        ),
                        'default' => ''
                    ),

                    array(
                        'id'       => 'haru_home_preloader_bg_color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( 'Preloader background color', 'pangja' ),
                        'subtitle' => '',
                        'default'  => array(),
                        'mode'     => 'background',
                        'validate' => 'colorrgba',
                        'required' => array('haru_home_preloader', 'not_empty_and', array('none')),
                    ),

                    array(
                        'id'       => 'haru_home_preloader_spinner_color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Preloader spinner color', 'pangja' ),
                        'subtitle' => '',
                        'default'  => '#e8e8e8',
                        'validate' => 'color',
                        'required' => array( 'haru_home_preloader', 'not_empty_and', array('none') ),
                    ),

                    array(
                        'id'       => 'haru_back_to_top',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Back To Top', 'pangja' ),
                        'subtitle' => '',
                        'default'  => true
                    ),

                    // Custom CSS & Script
                    array(
                        'id'       => 'haru_custom_js',
                        'type'     => 'ace_editor',
                        'mode'     => 'javascript',
                        'theme'    => 'monokai',
                        'title'    => esc_html__('Custom JS', 'pangja'),
                        'subtitle' => esc_html__('Insert your Javscript code here. You can add your Google Analytics Code here. Please do not place any <script> tags in here! From WordPress version 4.7+ you can add Custom CSS in Themes » Customize » Additional CSS.', 'pangja'),
                        'desc'     => '',
                        'default'  => '',
                        'options'  => array('minLines'=> 10, 'maxLines' => 60)
                    ),
                )
            );

            // Header
            $this->sections[] = array(
                'title'  => esc_html__( 'Header', 'pangja' ),
                'desc'   => '',
                'icon'   => 'el el-credit-card',
                'fields' => array(
                    array(
                        'id'       => 'haru_header_layout',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Header Layout', 'pangja' ),
                        'subtitle' => esc_html__( 'Select a header layout option from list.', 'pangja' ),
                        'desc'     => '',
                        'options'  => array(
                            'header-1'       => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_1.jpg'),
                            'header-2'       => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_2.jpg'),
                            'header-3'       => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_3.jpg'),
                            'header-10'       => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_10.jpg'),
                            'header-4'       => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_4.jpg'),
                            'header-5'       => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_5.jpg'),
                            'header-6'       => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_6.jpg'),
                            'header-7'       => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_7.jpg'),
                            'header-8'       => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_8.jpg'),
                            'header-9'       => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header_9.jpg'),
                        ),
                        'default' => 'header-1'
                    ),
                )
            );
            
            // Top Header
            $this->sections[] = array(
                'title'      => esc_html__( 'Top Header', 'pangja' ),
                'desc'       => '',
                'subsection' => true,
                'icon'       => '',
                'fields'     => array(
                    array(
                        'id'       => 'haru_top_header',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Top Header', 'pangja' ),
                        'subtitle' => '',
                        'default'  => false
                    ),

                    array(
                        'id'      => 'haru_top_header_layout_width',
                        'type'    => 'button_set',
                        'title'   => esc_html__( 'Top Header layout width', 'pangja' ),
                        'options' => array(
                            'container'       => esc_html__( 'Container','pangja' ),
                            'topheader-fullwith' => esc_html__( 'Full width','pangja' ),
                        ),
                        'default'  => 'container',
                        'required' => array('top_header','=','1'),
                    ),

                    array(
                        'id'       => 'haru_top_header_layout_padding',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Top Header padding left/right (px)', 'pangja' ),
                        'default'  => '100',
                        'min'      => 0,
                        'step'     => 1,
                        'max'      => 200,
                        'required' => array('haru_top_header_layout_width','=','topheader-fullwith'),
                    ),

                    array(
                        'id'       => 'haru_top_header_layout',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Top Header Layout', 'pangja' ),
                        'subtitle' => esc_html__( 'If layout 1 column, it will display top left sidebar.', 'pangja' ),
                        'desc'     => '',
                        'options'  => array(
                            'top-header-1' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/top-header-layout-1.jpg'),
                            'top-header-2' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/top-header-layout-2.jpg'),
                        ),
                        'default'  => 'top-header-1',
                        'required' => array('top_header','=','1'),
                    ),

                    array(
                        'id'       => 'haru_top_header_left_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Top Left Sidebar', 'pangja' ),
                        'subtitle' => esc_html__( 'Set top left sidebar', 'pangja' ),
                        'data'     => 'sidebars',
                        'desc'     => '',
                        'default'  => 'top_header_left',
                        'required' => array('top_header','=','1'),
                    ),

                    array(
                        'id'       => 'haru_top_header_right_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Top Right Sidebar', 'pangja' ),
                        'subtitle' => esc_html__( 'Set top right sidebar', 'pangja' ),
                        'data'     => 'sidebars',
                        'desc'     => '',
                        'default'  => 'top_header_right',
                        'required' => array('top_header','=','1'),
                    ),
                )
            );
            // Navigation
            $this->sections[] = array(
                'title'      => esc_html__( 'Navigation', 'pangja' ),
                'desc'       => '',
                'subsection' => true,
                'icon'       => '',
                'fields'     => array(
                    array(
                        'id'       => 'haru_menu_animation',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Mega Menu Animation', 'pangja' ),
                        'subtitle' => esc_html__( 'Select animation for mega menu', 'pangja' ),
                        'desc'     => '',
                        'options'  => array(
                            'menu_fadeIn'            => esc_html__( 'fadeIn', 'pangja' ),
                            'menu_fadeInDown'        => esc_html__( 'fadeInDown', 'pangja' ),
                            'menu_fadeInUp'          => esc_html__( 'fadeInUp', 'pangja' ),
                            'menu_bounceIn'          => esc_html__( 'bounceIn', 'pangja' ),
                            'menu_flipInX'           => esc_html__( 'flipInX', 'pangja' ),
                            'menu_bounceInRight'     => esc_html__( 'bounceInRight', 'pangja' ),
                            'menu_fadeInRight'       => esc_html__( 'fadeInRight', 'pangja' ),
                        ),
                        'default' => 'menu_fadeIn'
                    ),
                    array(
                        'id'      => 'haru_header_nav_layout',
                        'type'    => 'button_set',
                        'title'   => esc_html__( 'Header navigation layout', 'pangja' ),
                        'options' => array(
                            'container'    => esc_html__( 'Container','pangja' ),
                            'nav-fullwith' => esc_html__( 'Full width','pangja' ),
                        ),
                        'default'  => 'container'
                    ),

                    array(
                        'id'       => 'haru_header_nav_layout_padding',
                        'type'     => 'slider',
                        'title'    => esc_html__( 'Header navigation padding left/right (px)', 'pangja' ),
                        'default'  => '100',
                        'min'      => 0,
                        'step'     => 1,
                        'max'      => 200,
                        'required' => array('haru_header_nav_layout','=','nav-fullwith'),
                    ),
                    array(
                        'id'       => 'haru_header_layout_over_slideshow',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header On Slideshow', 'pangja' ),
                        'subtitle' => esc_html__( 'Menu Over Slideshow. Usually set to Off and should use this only for Homepage in Page Options.', 'pangja' ),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'haru_header_navigation_skin',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Header Navigation Skin', 'pangja' ),
                        'subtitle' => esc_html__( 'Use for Menu text color Header On Slideshow', 'pangja' ),
                        'options'  => array(
                            'navigation_dark'  => esc_html__( 'Dark','pangja' ),
                            'navigation_light' => esc_html__( 'Light','pangja' ),
                        ),
                        'default'  => 'navigation_dark',
                        'required' => array('haru_header_layout_over_slideshow','=',true),
                    ),
                    array(
                        'id'       => 'haru_header_over_slideshow_hover',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header On Slideshow Hover Effect', 'pangja' ),
                        'subtitle' => esc_html__( 'Turn On/Off effect when hover with Header On Slideshow.', 'pangja' ),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'haru_header_layout_under_slideshow',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Under Slideshow', 'pangja' ),
                        'subtitle' => esc_html__( 'Use this when set Revolution Slider layout is Full-Screen and this will override Header On Slideshow option. Should use only in Page Options.', 'pangja' ),
                        'default'  => false,
                    ),
                    array(
                        'id'       => 'haru_header_sticky',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Sticky', 'pangja' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                    array(
                        'id'       => 'haru_header_sticky_skin',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Header Sticky Skin', 'pangja' ),
                        'subtitle' => '',
                        'options'  => array(
                            'sticky_dark'  => esc_html__( 'Dark','pangja' ),
                            'sticky_light' => esc_html__( 'Light','pangja' ),
                        ),
                        'default'  => 'sticky_light'
                    ),
                )
            );
            
            // Header Elements
            $this->sections[] = array(
                'title'      => esc_html__( 'Header Elements', 'pangja' ),
                'desc'       => '',
                'icon'       => '',
                'subsection' => true,
                'fields'     => array(
                    // Option header nav ON/OFF
                    array(
                        'id'       => 'haru-option-header-elements-nav',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Elements Navigation', 'pangja' ),
                        'subtitle' => esc_html__( 'Set Header elements of Navigation Menu', 'pangja' ),
                        'default'  => false,
                    ),
                    array(
                        'id'      => 'haru_header_elements_nav',
                        'type'    => 'sorter',
                        'title'   => esc_html__( 'Header elements navigation', 'pangja' ),
                        'subtitle'    => esc_html__( 'Customize layout of header navigation. Drag Drop to Enable/Disable Header elements.', 'pangja' ),
                        'options' => array(
                            'enabled'  => array(
                                'social-network'       => esc_html__( 'Social Network', 'pangja' ),
                                'search-box'           => esc_html__( 'Search Box', 'pangja' ),
                            ),
                            'disabled' => array(
                                'mini-cart-price'         => esc_html__( 'Mini Cart Price', 'pangja' ),
                                'mini-cart'               => esc_html__( 'Mini Cart', 'pangja' ),
                                'mini-cart-sidebar'       => esc_html__( 'Mini Cart Sidebar', 'pangja' ),
                                'wishlist'                => esc_html__( 'Wishlist', 'pangja' ),
                                'search-button'           => esc_html__( 'Search Button', 'pangja' ),
                                'search-product-category' => esc_html__( 'Search Category', 'pangja' ),
                                'custom-text'             => esc_html__( 'Custom Text', 'pangja' ),
                                'canvas-sidebar'          => esc_html__( 'Canvas Sidebar','pangja' ),
                                'user-account'            => esc_html__( 'User Account', 'pangja' ),
                                'post-category'            => esc_html__( 'Post Category', 'pangja' ),
                            )
                        ), 
                        'required' => array('haru-option-header-elements-nav','=',array('1')),
                    ),
                    array(
                        'id'       => 'haru_header_elements_nav_social_network',
                        'type'     => 'select',
                        'multi'    => true,
                        'width'    => '100%',
                        'title'    => esc_html__( 'Social networks', 'pangja' ),
                        'subtitle' => esc_html__( 'Select social networks', 'pangja' ),
                        'options'  => array(
                            'twitter'    => esc_html__( 'Twitter', 'pangja' ),
                            'facebook'   => esc_html__( 'Facebook', 'pangja' ),
                            'vimeo'      => esc_html__( 'Vimeo', 'pangja' ),
                            'linkedin'   => esc_html__( 'LinkedIn', 'pangja' ),
                            'googleplus' => esc_html__( 'Google+', 'pangja' ),
                            'flickr'     => esc_html__( 'Flickr', 'pangja' ),
                            'youtube'    => esc_html__( 'YouTube', 'pangja' ),
                            'pinterest'  => esc_html__( 'Pinterest', 'pangja' ),
                            'instagram'  => esc_html__( 'Instagram', 'pangja' ),
                            'behance'    => esc_html__( 'Behance', 'pangja' ),
                        ),
                        'desc'    => '',
                        'default' => '', 
                        'required' => array('haru-option-header-elements-nav','=',array('1')),
                    ),
                    array(
                        'id'       => 'haru_header_elements_nav_text',
                        'type'     => 'ace_editor',
                        'mode'     => 'html',
                        'theme'    => 'monokai',
                        'title'    => esc_html__( 'Custom Text Content', 'pangja' ),
                        'subtitle' => esc_html__( 'Add Custom Text Content', 'pangja' ),
                        'desc'     => '',
                        'default'  => '',
                        'options'  => array('minLines'=> 5, 'maxLines' => 60),
                        'required' => array('haru-option-header-elements-nav','=',array('1')),
                    ),
                    // Option header Custommize-left
                    array(
                        'id'       => 'haru-option-header-elements-left',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Elements Left', 'pangja' ),
                        'subtitle' => esc_html__( 'Set Header elements on Left of Logo (or Top of Logo)', 'pangja' ),
                        'default'  => false,
                    ),
                    array(
                        'id'      => 'haru_header_elements_left',
                        'type'    => 'sorter',
                        'title'   => esc_html__( 'Header elements left', 'pangja' ),
                        'subtitle'    => esc_html__( 'Customize layout of header left. Drag Drop to Enable/Disable Header elements.', 'pangja' ),
                        'options' => array(
                            'enabled'  => array(
                            ),
                            'disabled' => array(
                                'mini-cart-price'         => esc_html__( 'Mini Cart Price', 'pangja' ),
                                'mini-cart'               => esc_html__( 'Mini Cart', 'pangja' ),
                                'mini-cart-sidebar'       => esc_html__( 'Mini Cart Sidebar', 'pangja' ),
                                'wishlist'                => esc_html__( 'Wishlist', 'pangja' ),
                                'search-product-category' => esc_html__( 'Search Category', 'pangja'),
                                'search-box'              => esc_html__( 'Search Box', 'pangja' ),
                                'search-button'           => esc_html__( 'Search Button', 'pangja' ),
                                'social-network'          => esc_html__( 'Social Network', 'pangja' ),
                                'custom-text'             => esc_html__( 'Custom Text', 'pangja' ),
                                'canvas-sidebar'          => esc_html__( 'Canvas Sidebar','pangja' ),
                                'user-account'            => esc_html__( 'User Account', 'pangja' ),
                                'post-category'            => esc_html__( 'Post Category', 'pangja' ),
                            )
                        ), 
                        'required'  => array('haru-option-header-elements-left','=', array('1'))
                    
                    ),
                    array(
                        'id'       => 'haru_header_elements_left_social_network',
                        'type'     => 'select',
                        'multi'    => true,
                        'width'    => '100%',
                        'title'    => esc_html__( 'Social networks', 'pangja' ),
                        'subtitle' => esc_html__( 'Select social networks', 'pangja' ),
                        'options'  => array(
                            'twitter'    => esc_html__( 'Twitter', 'pangja' ),
                            'facebook'   => esc_html__( 'Facebook', 'pangja' ),
                            'vimeo'      => esc_html__( 'Vimeo', 'pangja' ),
                            'linkedin'   => esc_html__( 'LinkedIn', 'pangja' ),
                            'googleplus' => esc_html__( 'Google+', 'pangja' ),
                            'flickr'     => esc_html__( 'Flickr', 'pangja' ),
                            'youtube'    => esc_html__( 'YouTube', 'pangja' ),
                            'pinterest'  => esc_html__( 'Pinterest', 'pangja' ),
                            'instagram'  => esc_html__( 'Instagram', 'pangja' ),
                            'behance'    => esc_html__( 'Behance', 'pangja' ),
                        ),
                        'desc'     => '',
                        'default'  => '',  
                        'required' => array('haru-option-header-elements-left','=', array('1'))
                    ),
                    array(
                        'id'       => 'haru_header_elements_left_text',
                        'type'     => 'ace_editor',
                        'mode'     => 'html',
                        'theme'    => 'monokai',
                        'title'    => esc_html__( 'Custom Text Content', 'pangja' ),
                        'subtitle' => esc_html__( 'Add Custom Text Content', 'pangja' ),
                        'desc'     => '',
                        'default'  => '',
                        'options'  => array('minLines'=> 5, 'maxLines' => 60), 
                        'required' => array('haru-option-header-elements-left','=', array('1'))
                    ),
                    // Option header customize right
                    array(
                        'id'     => 'haru-option-header-elements-right',
                        'type'   => 'switch',
                        'title'  => esc_html__( 'Header Elements Right', 'pangja' ),
                        'subtitle' => esc_html__( 'Set Header elements on Right of Logo (or Bottom of Logo)', 'pangja' ),
                        'default' => false
                    ),
                    array(
                        'id'      => 'haru_header_elements_right',
                        'type'    => 'sorter',
                        'title'   => esc_html__( 'Header elements right', 'pangja' ),
                        'subtitle'    => esc_html__( 'Customize layout of header right. Drag Drop to Enable/Disable Header elements.', 'pangja' ),
                        'options' => array(
                            'enabled'  => array(
                            ),
                            'disabled' => array(
                                'mini-cart-price'         => esc_html__( 'Mini Cart Price', 'pangja' ),
                                'mini-cart'               => esc_html__( 'Mini Cart', 'pangja' ),
                                'mini-cart-sidebar'       => esc_html__( 'Mini Cart Sidebar', 'pangja' ),
                                'wishlist'                => esc_html__( 'Wishlist', 'pangja' ),
                                'search-product-category' => esc_html__( 'Search Category', 'pangja' ),
                                'search-box'              => esc_html__( 'Search Box', 'pangja' ),
                                'search-button'           => esc_html__( 'Search Button', 'pangja' ),
                                'social-network'          => esc_html__( 'Social Network', 'pangja' ),
                                'custom-text'             => esc_html__( 'Custom Text', 'pangja' ),
                                'canvas-sidebar'          => esc_html__( 'Canvas Sidebar','pangja' ),
                                'user-account'            => esc_html__( 'User Account', 'pangja' ),
                                'post-category'            => esc_html__( 'Post Category', 'pangja' ),
                            )
                        ),  
                        'required'  => array('haru-option-header-elements-right','=', array('1'))
                    ),
                    array(
                        'id'       => 'haru_header_elements_right_social_network',
                        'type'     => 'select',
                        'multi'    => true,
                        'width'    => '100%',
                        'title'    => esc_html__( 'Social networks', 'pangja' ),
                        'subtitle' => esc_html__( 'Select social networks', 'pangja' ),
                        'options'  => array(
                            'twitter'    => esc_html__( 'Twitter', 'pangja' ),
                            'facebook'   => esc_html__( 'Facebook', 'pangja' ),
                            'vimeo'      => esc_html__( 'Vimeo', 'pangja' ),
                            'linkedin'   => esc_html__( 'LinkedIn', 'pangja' ),
                            'googleplus' => esc_html__( 'Google+', 'pangja' ),
                            'flickr'     => esc_html__( 'Flickr', 'pangja' ),
                            'youtube'    => esc_html__( 'YouTube', 'pangja' ),
                            'pinterest'  => esc_html__( 'Pinterest', 'pangja' ),
                            'instagram'  => esc_html__( 'Instagram', 'pangja' ),
                            'behance'    => esc_html__( 'Behance', 'pangja' ),
                        ),
                        'desc'    => '',
                        'default' => '', 
                        'required'  => array('haru-option-header-elements-right','=', array('1'))
                    ),
                    array(
                        'id'       => 'haru_header_elements_right_text',
                        'type'     => 'ace_editor',
                        'mode'     => 'html',
                        'theme'    => 'monokai',
                        'title'    => esc_html__( 'Custom Text Content', 'pangja' ),
                        'subtitle' => esc_html__( 'Add Custom Text Content', 'pangja' ),
                        'desc'     => '',
                        'default'  => '',
                        'options'  => array('minLines'=> 5, 'maxLines' => 60), 
                        'required'  => array('haru-option-header-elements-right','=', array('1'))
                    ),
                )
            );

            // Mobile Header
            $this->sections[] = array(
                'title'      => esc_html__( 'Mobile Header', 'pangja' ),
                'desc'       => '',
                'subsection' => true,
                'icon'       => '',
                'fields'     => array(
                    array(
                        'id'       => 'haru_mobile_header_layout',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Header Layout', 'pangja' ),
                        'subtitle' => esc_html__( 'Set header mobile layout from List', 'pangja' ),
                        'desc'     => '',
                        'options'  => array(
                            'header-mobile-1' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header-mobile-layout-1.jpg'),
                            'header-mobile-2' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header-mobile-layout-2.jpg'),
                            'header-mobile-3' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/header-mobile-layout-3.jpg'),
                        ),
                        'default' => 'header-mobile-2'
                    ),
                    array(
                        'id'       => 'haru_mobile_header_menu_drop',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Menu Mobile Type', 'pangja' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'fly'      => esc_html__( 'Fly Menu', 'pangja' ),
                            'dropdown' => esc_html__( 'Dropdown Menu', 'pangja' ),
                        ),
                        'default'  => 'fly'
                    ),
                    array(
                        'id'       => 'haru_mobile_header_search',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Search', 'pangja' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                    array(
                        'id'       => 'haru_mobile_header_cart',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Cart', 'pangja' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                    array(
                        'id'       => 'haru_mobile_header_account',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header User Account', 'pangja' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                    array(
                        'id'       => 'haru_mobile_header_wishlist',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Wishlist', 'pangja' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                    array(
                        'id'       => 'haru_mobile_header_social',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Header Social', 'pangja' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                    array(
                        'id'       => 'haru_mobile_header_social_network',
                        'type'     => 'select',
                        'multi'    => true,
                        'width'    => '100%',
                        'title'    => esc_html__( 'Social networks', 'pangja' ),
                        'subtitle' => esc_html__( 'Select social networks', 'pangja' ),
                        'options'  => array(
                            'twitter'    => esc_html__( 'Twitter', 'pangja' ),
                            'facebook'   => esc_html__( 'Facebook', 'pangja' ),
                            'vimeo'      => esc_html__( 'Vimeo', 'pangja' ),
                            'linkedin'   => esc_html__( 'LinkedIn', 'pangja' ),
                            'googleplus' => esc_html__( 'Google+', 'pangja' ),
                            'flickr'     => esc_html__( 'Flickr', 'pangja' ),
                            'youtube'    => esc_html__( 'YouTube', 'pangja' ),
                            'pinterest'  => esc_html__( 'Pinterest', 'pangja' ),
                            'instagram'  => esc_html__( 'Instagram', 'pangja' ),
                            'behance'    => esc_html__( 'Behance', 'pangja' ),
                        ),
                        'desc'    => '',
                        'default' => '', 
                        'required'  => array('haru_mobile_header_social','=', true)
                    ),
                    array(
                        'id'       => 'haru_mobile_header_top_header',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Top Header', 'pangja' ),
                        'subtitle' => '',
                        'default'  => false
                    ),
                    array(
                        'id'       => 'haru_mobile_header_stick',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Sticky Mobile Header', 'pangja' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                )
            );

            $this->sections[] = array(
                'title'      => esc_html__( 'Search Settings', 'pangja' ),
                'desc'       => '',
                'subsection' => true,
                'icon'       => '',
                'fields'     => array(
                    array(
                        'id'       => 'haru_search_box_type',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Search Box Type', 'pangja' ),
                        'subtitle' => esc_html__( 'Set search box and search button type.', 'pangja' ),
                        'desc'     => '',
                        'options'  => array(
                            'standard' => esc_html__( 'Standard', 'pangja' ),
                            'ajax'     => esc_html__( 'Ajax Search', 'pangja' )
                        ),
                        'default'  => 'standard'
                    ),
                )
            );

            // Footer
            $this->sections[] = array(
                'title'  => esc_html__( 'Footer', 'pangja' ),
                'desc'   => '',
                'icon'   => 'el el-lines',
                'fields' => array(
                    array(
                        'id'       => 'haru_footer_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__('Layout', 'pangja'),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full'            => esc_html__( 'Full Width', 'pangja' ),
                            'container'       => esc_html__( 'Container', 'pangja' ),
                        ),
                        'default'  => 'container'
                    ),
                    array(
                        'id'       => 'haru_footer',
                        'type'     => 'footer',
                        'title'    => esc_html__('Footer Block', 'pangja'),
                        'subtitle' => '',
                    ),

                )
            );

            // Logo
            $this->sections[] = array(
                'title'  => esc_html__( 'Logo & Favicon', 'pangja' ),
                'desc'   => '',
                'icon'   => 'el el-picture',
                'fields' => array(
                    array(
                        'id'       => 'haru_logo',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Logo', 'pangja' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  => array(
                            'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo.png'
                        )
                    ),
                    array(
                        'id'       => 'haru_logo_black',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Logo Black', 'pangja' ),
                        'subtitle' => '',
                        'desc'     => esc_html__('Use when hover with Header On Slideshow - Background Light', 'pangja'),
                        'default'  => array(
                            'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo-black.png'
                        )
                    ),
                    array(
                        'id'       => 'haru_logo_retina',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Retina Logo', 'pangja' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  => array(
                            'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo@2x.png'
                        )
                    ),
                    array(
                        'id'       => 'haru_sticky_logo',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Sticky Logo', 'pangja' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  => array(
                            'url'      => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo.png'
                        )
                    ),
                    array(
                        'id'       => 'haru_mobile_header_logo',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Mobile Logo', 'pangja' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  => array(
                            'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/logo.png'
                        )
                    ),
                    array(
                        'id'       => 'haru_custom_favicon',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Custom favicon', 'pangja'),
                        'subtitle' => esc_html__( 'Upload a 16px x 16px Png/Gif/ico image.', 'pangja' ),
                        'desc'     => ''
                    ),
                )
            );

            // Styling Options
            $this->sections[] = array(
                'title'  => esc_html__( 'Color Scheme', 'pangja' ),
                'desc'   => esc_html__( 'To make color scheme work you need enable SCSS Compiler.', 'pangja' ),
                'icon'   => 'el el-magic',
                'fields' => array(
                    array(
                        'id'       => 'haru_primary_color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Primary Color', 'pangja' ),
                        'subtitle' => esc_html__( 'Set Primary Color', 'pangja' ),
                        'compiler' => true,
                        'default'  => '#333333',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'haru_secondary_color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Secondary Color', 'pangja' ),
                        'subtitle' => esc_html__( 'Set Secondary Color', 'pangja' ),
                        'compiler' => true,
                        'default'  => '#444444',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'haru_text_color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Text Color', 'pangja' ),
                        'subtitle' => esc_html__( 'Set Text Color.', 'pangja' ),
                        'compiler' => true,
                        'default'  => '#696969',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'haru_heading_color',
                        'type'     => 'color',
                        'title'    => esc_html__( 'Heading Color', 'pangja' ),
                        'subtitle' => esc_html__( 'Set Heading Color.', 'pangja' ),
                        'default'  => '#333333',
                        'compiler' => true,
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'haru_link_color',
                        'type'     => 'link_color',
                        'title'    => esc_html__( 'Link Color', 'pangja' ),
                        'subtitle' => esc_html__( 'Set Link Color.', 'pangja' ),
                        'compiler' => true,
                        'default'  => array(
                            'regular'  => '#696969',
                            'hover'    => '#444444',
                            'active'   => '#444444',
                        ),
                    ),
                )
            );

            // SCSS Compile
            $this->sections[] = array(
                'title'      => esc_html__( 'SCSS Compiler', 'pangja' ),
                'desc'       => esc_html__( 'If you want to custom color or CSS you must enable this option.', 'pangja' ),
                'icon'       => 'el el-edit',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id'       => 'haru_scss_compiler',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'SCSS Compiler', 'pangja' ),
                        'subtitle' => esc_html__( 'To make this option work you need install plugin Less & scss PHP Compilers.', 'pangja' ),
                        'default'  => false
                    ),

                )
            );

            // Typography
            $this->sections[] = array(
                'icon'   => 'el el-font',
                'title'  => esc_html__('Typograhpy', 'pangja'),
                'desc'   => '',
                'fields' => array(
                    array(
                        'id'     => 'haru-section-body_font',
                        'type'   => 'section',
                        'title'  => esc_html__('Body Font', 'pangja'),
                        'indent' => true
                    ),

                    array(
                        'id'             => 'haru_body_font',
                        'type'           => 'typography',
                        'title'          => esc_html__( 'Body Font', 'pangja' ),
                        'subtitle'       => esc_html__( 'Set body font properties.', 'pangja' ),
                        'google'         => true,
                        'line-height'    => false,
                        'color'          => false,
                        'letter-spacing' => false,
                        'text-align'     => false,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'         => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'units'          => 'px', // Defaults to px
                        'default'        => array(
                            'font-size'   => '14px',
                            'font-family' => 'Poppins',
                            'font-weight' => '400',
                            'google'      => true,
                        ),
                    ),

                    array(
                        'id'             => 'haru_secondary_font',
                        'type'           => 'typography',
                        'title'          => esc_html__( 'Secondary Font', 'pangja' ),
                        'subtitle'       => esc_html__( 'Set secondary font properties.', 'pangja' ),
                        'google'         => true,
                        'line-height'    => false,
                        'color'          => false,
                        'letter-spacing' => false,
                        'text-align'     => false,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'         => array(), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array(), // An array of CSS selectors to apply this font style to dynamically
                        'units'          => 'px', // Defaults to px
                        'default'        => array(
                            'font-size'   => '14px',
                            'font-family' => 'Open Sans',
                            'font-weight' => '400',
                            'google'      => true,
                        ),
                    ),
                    
                    array(
                        'id'     => 'haru-section-heading-font',
                        'type'   => 'section',
                        'title'  => esc_html__('Heading Font', 'pangja'),
                        'indent' => true
                    ),

                    array(
                        'id'             =>'haru_h1_font',
                        'type'           => 'typography',
                        'title'          => esc_html__('H1 Font', 'pangja'),
                        'subtitle'       => esc_html__('Set H1 font properties.', 'pangja'),
                        'google'         => true,
                        'letter-spacing' => false,
                        'color'          => false,
                        'line-height'    => false,
                        'text-align'     => false,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'         => array('h1'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array('h1'), // An array of CSS selectors to apply this font style to dynamically
                        'units'          =>'px', // Defaults to px
                        'default'        => array(
                            'font-size'   => '36px',
                            'font-family' => 'Poppins',
                            'font-weight' => '700',
                        ),
                    ),

                    array(
                        'id'             =>'haru_h2_font',
                        'type'           => 'typography',
                        'title'          => esc_html__('H2 Font', 'pangja'),
                        'subtitle'       => esc_html__('Set H2 font properties.', 'pangja'),
                        'google'         => true,
                        'letter-spacing' => false,
                        'color'          => false,
                        'line-height'    => false,
                        'text-align'     => false,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'         => array('h2'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array('h2'), // An array of CSS selectors to apply this font style to dynamically
                        'units'          =>'px', // Defaults to px
                        'default'        => array(
                            'font-size'   => '28px',
                            'font-family' => 'Poppins',
                            'font-weight' => '700',
                        ),
                    ),

                    array(
                        'id'             =>'haru_h3_font',
                        'type'           => 'typography',
                        'title'          => esc_html__('H3 Font', 'pangja'),
                        'subtitle'       => esc_html__('Set H3 font properties.', 'pangja'),
                        'google'         => true,
                        'color'          => false,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'text-align'     => false,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'         => array('h3'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array('h3'), // An array of CSS selectors to apply this font style to dynamically
                        'units'          =>'px', // Defaults to px
                        'default'        => array(
                            'font-size'   => '24px',
                            'font-family' => 'Poppins',
                            'font-weight' => '700',
                        ),
                    ),

                    array(
                        'id'             =>'haru_h4_font',
                        'type'           => 'typography',
                        'title'          => esc_html__('H4 Font', 'pangja'),
                        'subtitle'       => esc_html__('Set H4 font properties.', 'pangja'),
                        'google'         => true,
                        'color'          => false,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'text-align'     => false,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'         => array('h4'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array('h4'), // An array of CSS selectors to apply this font style to dynamically
                        'units'          =>'px', // Defaults to px
                        'default'        => array(
                            'font-size'   => '21px',
                            'font-family' => 'Poppins',
                            'font-weight' => '700',
                        ),
                    ),

                    array(
                        'id'             =>'haru_h5_font',
                        'type'           => 'typography',
                        'title'          => esc_html__('H5 Font', 'pangja'),
                        'subtitle'       => esc_html__('Set H5 font properties.', 'pangja'),
                        'google'         => true,
                        'line-height'    => false,
                        'color'          => false,
                        'letter-spacing' => false,
                        'text-align'     => false,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'         => array('h5'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array('h5'), // An array of CSS selectors to apply this font style to dynamically
                        'units'          =>'px', // Defaults to px
                        'default'        => array(
                            'font-size'   => '18px',
                            'font-family' => 'Poppins',
                            'font-weight' => '700',
                        ),
                    ),

                    array(
                        'id'             =>'haru_h6_font',
                        'type'           => 'typography',
                        'title'          => esc_html__('H6 Font', 'pangja'),
                        'subtitle'       => esc_html__('Set H6 font properties.', 'pangja'),
                        'google'         => true,
                        'color'          => false,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'text-align'     => false,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'         => array('h6'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array('h6'), // An array of CSS selectors to apply this font style to dynamically
                        'units'          =>'px', // Defaults to px
                        'default'        => array(
                            'font-size'   => '14px',
                            'font-family' => 'Poppins',
                            'font-weight' => '700',
                        ),
                    ),

                    array(
                        'id'     => 'haru-section-menu-font',
                        'type'   => 'section',
                        'title'  => esc_html__('Menu Font', 'pangja'),
                        'indent' => true
                    ),

                    array(
                        'id'             => 'haru_menu_font',
                        'type'           => 'typography',
                        'title'          => esc_html__('Menu Font', 'pangja'),
                        'subtitle'       => esc_html__('Set Menu font properties.', 'pangja'),
                        'google'         => true,
                        'all_styles'     => false, // Enable all Google Font style/weight variations to be added to the page
                        'color'          => false,
                        'line-height'    => false,
                        'text-align'     => false,
                        'font-style'     => false,
                        'subsets'        => true,
                        'text-transform' => false,
                        'output'         => array('.navbar .navbar-nav a'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'units'          => 'px', // Defaults to px
                        'default'        => array(
                            'font-family'    => 'Poppins',
                            'font-size'      => '14px',
                            'font-weight'    => '400',
                        ),
                    ),

                    array(
                        'id'     => 'haru-section-page-title-font',
                        'type'   => 'section',
                        'title'  => esc_html__('Page Title Font', 'pangja'),
                        'indent' => true
                    ),

                    array(
                        'id'             => 'haru_page_title_font',
                        'type'           => 'typography',
                        'title'          => esc_html__('Page Title Font', 'pangja'),
                        'subtitle'       => esc_html__('Set page title font properties.', 'pangja'),
                        'google'         => true,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'line-height'    => false,
                        'color'          => false,
                        'text-align'     => false,
                        'font-style'     => true,
                        'subsets'        => true,
                        'font-size'      => true,
                        'font-weight'    => true,
                        'text-transform' => false,
                        'output'         => array('.page-title-inner h1'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array(), // An array of CSS selectors to apply this font style to dynamically
                        'units'          => 'px', // Defaults to px
                        'default'        => array(
                            'font-family'    => 'Poppins',
                            'font-size'      => '36px',
                            'font-weight'    => '400',
                        ),
                    ),

                    array(
                        'id'             => 'haru_page_sub_title_font',
                        'type'           => 'typography',
                        'title'          => esc_html__('Page Sub Title Font', 'pangja'),
                        'subtitle'       => esc_html__('Set page sub title font properties.', 'pangja'),
                        'google'         => true,
                        'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
                        'line-height'    => false,
                        'color'          => false,
                        'font-style'     => true,
                        'text-align'     => false,
                        'subsets'        => true,
                        'font-size'      => true,
                        'font-weight'    => true,
                        'text-transform' => false,
                        'output'         => array('.page-title-inner .page-sub-title'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'       => array(), // An array of CSS selectors to apply this font style to dynamically
                        'units'          => 'px', // Defaults to px
                        'default'        => array(
                            'font-family'    => 'Poppins',
                            'font-size'      => '14px',
                            'font-weight'    => '400italic',
                        ),
                    ),

                ),
            );
            
            // WordPress Setting
            $this->sections[] = array(
                'title'  => esc_html__( 'WordPress Setting', 'pangja' ),
                'desc'   => '',
                'icon'   => 'el el-website',
                'fields' => array(

                )
            );
            // Pages Setting
            $this->sections[] = array(
                'title'      => esc_html__( 'Pages Setting', 'pangja' ),
                'desc'       => '',
                'icon'       => 'el el-website',
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'       => 'haru_page_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__('Layout', 'pangja'),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full'            => esc_html__( 'Full Width', 'pangja' ),
                            'container'       => esc_html__( 'Container', 'pangja' ),
                        ),
                        'default'  => 'container'
                    ),

                    array(
                        'id'       => 'haru_page_sidebar',
                        'type'     => 'image_select',
                        'title'    => esc_html__('Sidebar', 'pangja'),
                        'subtitle' => esc_html__('Sidebar Style: None, Left, Right Sidebar', 'pangja'),
                        'options'  => array(
                            'none'  => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-none.png'),
                            'left'  => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-right.png'),
                        ),
                        'default' => 'none'
                    ),

                    array(
                        'id'       => 'haru_page_left_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__('Left Sidebar', 'pangja'),
                        'subtitle' => esc_html__('Choose the default left sidebar', 'pangja'),
                        'data'     => 'sidebars',
                        'desc'     => '',
                        'default'  => 'sidebar-1',
                        'required' => array('haru_page_sidebar', '=', array('left','both')),
                    ),

                    array(
                        'id'       => 'haru_page_right_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__('Right Sidebar', 'pangja'),
                        'subtitle' => esc_html__('Choose the default right sidebar', 'pangja'),
                        'data'     => 'sidebars',
                        'desc'     => '',
                        'default'  => 'sidebar-2',
                        'required' => array('haru_page_sidebar', '=', array('right','both')),
                    ),

                    array(
                        'id'     => 'haru-section-page-title-setting-start',
                        'type'   => 'section',
                        'title'  => esc_html__('Page Title Setting', 'pangja'),
                        'indent' => true
                    ),

                    array(
                        'id'       => 'haru_show_page_title',
                        'type'     => 'switch',
                        'title'    => esc_html__('Show Page Title', 'pangja'),
                        'subtitle' => '',
                        'default'  => false
                    ),

                    array(
                        'id'       => 'haru_page_title_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__('Page Title Layout', 'pangja'),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full'            => esc_html__('Full Width', 'pangja'),
                            'container'       => esc_html__('Container', 'pangja'),
                        ),
                        'default'  => 'full',
                        'required' => array('haru_show_page_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'haru_page_title_bg_image',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__('Page Title Background', 'pangja'),
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  => array(
                            'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/bg-page-title.jpg'
                        ),
                        'required'  => array('haru_show_page_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'haru_page_title_parallax',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Page Title Parallax', 'pangja' ),
                        'subtitle' => '',
                        'default'  => false,
                        'required' => array('haru_show_page_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'haru_breadcrumbs_in_page_title',
                        'type'     => 'switch',
                        'title'    => esc_html__('Breadcrumbs', 'pangja'),
                        'subtitle' => '',
                        'default'  => true
                    ),
                )
            );

            // Archive Setting
            $this->sections[] = array(
                'title'      => esc_html__( 'Archive Setting', 'pangja' ),
                'desc'       => '',
                'subsection' => true,
                'icon'       => 'el el-folder-close',
                'fields'     => array(
                    array(
                        'id'       => 'haru_archive_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Layout', 'pangja' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full'            => esc_html__( 'Full Width', 'pangja' ),
                            'container'       => esc_html__( 'Container', 'pangja' ),
                        ),
                        'default'  => 'container'
                    ),

                    array(
                        'id'       => 'haru_archive_sidebar',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Sidebar', 'pangja' ),
                        'subtitle' => esc_html__( 'Sidebar Style: None, Left or Right Sidebar', 'pangja' ),
                        'desc'     => '',
                        'options'  => array(
                            'none'     => array('title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-none.png'),
                            'left'     => array('title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-left.png'),
                            'right'    => array('title' => '', 'img' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/sidebar-right.png'),
                        ),
                        'default'  => 'left'
                    ),

                    array(
                        'id'       => 'haru_archive_left_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Left Sidebar', 'pangja' ),
                        'subtitle' => '',
                        'data'     => 'sidebars',
                        'desc'     => '',
                        'default'  => 'sidebar-1',
                        'required' => array('haru_archive_sidebar', '=', array('left','both')),
                    ),

                    array(
                        'id'       => 'haru_archive_right_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Right Sidebar', 'pangja' ),
                        'subtitle' => '',
                        'data'     => 'sidebars',
                        'desc'     => '',
                        'default'  => 'sidebar-2',
                        'required' => array('haru_archive_sidebar', '=', array('right','both')),
                    ),

                    array(
                        'id'       => 'haru_archive_display_type',
                        'type'     => 'select',
                        'title'    => esc_html__('Archive Blog Style', 'pangja'),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'large-image'  => esc_html__('Large Image','pangja'),
                            'medium-image' => esc_html__('Medium Image','pangja'),
                            'grid'         => esc_html__('Grid','pangja'),
                            'masonry'      => esc_html__('Masonry','pangja'),
                        ),
                        'default'  => 'large-image'
                    ),

                    array(
                        'id'       => 'haru_archive_paging_style',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Blog Paging Style', 'pangja' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'default'         => esc_html__( 'Default', 'pangja' ),
                            'load-more'       => esc_html__( 'Load More', 'pangja' ),
                            'infinity-scroll' => esc_html__( 'Infinity Scroll', 'pangja' )
                        ),
                        'default'  => 'default'
                    ),

                    array(
                        'id'       => 'haru_archive_display_columns',
                        'type'     => 'select',
                        'title'    => esc_html__('Archive Display Columns', 'pangja'),
                        'subtitle' => esc_html__('Choose the number of columns to display on archive pages.','pangja'),
                        'options'  => array(
                            '2'     => '2',
                            '3'     => '3',
                            '4'     => '4',
                        ),
                        'desc'     => '',
                        'default'  => '2',
                        'required' => array('haru_archive_display_type','=',array('grid','masonry')),
                    ),

                    array(
                        'id'        => 'haru_archive_number_exceprt',
                        'type'      => 'text',
                        'title'     => esc_html__( 'Length of excerpt (words)','pangja' ),
                        'value'     => '30'    
                    ),

                    array(
                        'id'     => 'haru-section-archive-title-setting-start',
                        'type'   => 'section',
                        'title'  => esc_html__('Archive Title Setting', 'pangja'),
                        'indent' => true
                    ),

                    array(
                        'id'       => 'haru_show_archive_title',
                        'type'     => 'switch',
                        'title'    => esc_html__('Archive Page Title', 'pangja'),
                        'subtitle' => '',
                        'default'  => true
                    ),

                    array(
                        'id'       => 'haru_archive_title_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__('Archive Title Layout', 'pangja'),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full'            => esc_html__( 'Full Width', 'pangja' ),
                            'container'       => esc_html__( 'Container', 'pangja' ),
                        ),
                        'default'  => 'full',
                        'required' => array('haru_show_archive_title','=',array('1')),
                    ),

                    array(
                        'id'       => 'haru_archive_title_bg_image',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__('Archive Title Background', 'pangja'),
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  =>  array(
                            'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/bg-page-title.jpg'
                        ),
                        'required' => array('haru_show_archive_title','=',array('1')),
                    ),

                    array(
                        'id'       => 'haru_archive_title_parallax',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Archive Title Parallax', 'pangja' ),
                        'subtitle' => '',
                        'default'  => false,
                        'required' => array('haru_show_archive_title','=',array('1')),
                    ),

                    array(
                        'id'       => 'haru_breadcrumbs_in_archive_title',
                        'type'     => 'switch',
                        'title'    => esc_html__('Breadcrumbs', 'pangja'),
                        'subtitle' => '',
                        'default'  => true
                    ),
                )
            );

            // Single Page
            $this->sections[] = array(
                'title'      => esc_html__( 'Single Setting', 'pangja' ),
                'desc'       => '',
                'icon'       => 'el el-file',
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'       => 'haru_single_blog_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Layout', 'pangja' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full'            => esc_html__( 'Full Width', 'pangja' ),
                            'container'       => esc_html__( 'Container', 'pangja' ),
                        ),
                        'default'  => 'container'
                    ),

                    array(
                        'id'       => 'haru_single_blog_sidebar',
                        'type'     => 'image_select',
                        'title'    => esc_html__( 'Sidebar', 'pangja' ),
                        'subtitle' => esc_html__( 'Sidebar Style: None, Left or Right Sidebar', 'pangja' ),
                        'desc'     => '',
                        'options'  => array(
                            'none'  => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-none.png'),
                            'left'  => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-right.png'),
                        ),
                        'default'  => 'left'
                    ),

                    array(
                        'id'       => 'haru_single_blog_left_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Left Sidebar', 'pangja' ),
                        'subtitle' => '',
                        'data'     => 'sidebars',
                        'desc'     => '',
                        'default'  => 'sidebar-1',
                        'required' => array('haru_single_blog_sidebar', '=', array('left','both')),
                    ),

                    array(
                        'id'       => 'haru_single_blog_right_sidebar',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Right Sidebar', 'pangja' ),
                        'subtitle' => '',
                        'data'     => 'sidebars',
                        'desc'     => '',
                        'default'  => 'sidebar-2',
                        'required' => array('haru_single_blog_sidebar', '=', array('right','both')),
                    ),

                    array(
                        'id'       => 'haru_show_post_navigation',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Post Navigation', 'pangja' ),
                        'subtitle' => esc_html__( 'Show/Hide Next/Pre post', 'pangja' ),
                        'default'  => true
                    ),

                    array(
                        'id'       => 'haru_show_author_info',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Author Info', 'pangja' ),
                        'subtitle' => esc_html__( 'Show/Hide Author Info', 'pangja' ),
                        'default'  => true
                    ),

                    array(
                        'id'     => 'haru-section-single-blog-title-setting-start',
                        'type'   => 'section',
                        'title'  => esc_html__( 'Single Blog Title Setting', 'pangja' ),
                        'indent' => true
                    ),

                    array(
                        'id'       => 'haru_show_single_blog_title',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Single Blog Title', 'pangja' ),
                        'subtitle' => '',
                        'default'  => true
                    ),

                    array(
                        'id'       => 'haru_single_blog_title_layout',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Single Blog Title Layout', 'pangja' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'full'            => esc_html__( 'Full Width', 'pangja' ),
                            'container'       => esc_html__( 'Container', 'pangja' ),
                        ),
                        'default'  => 'full',
                        'required' => array('haru_show_single_blog_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'haru_single_blog_title_bg_image',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__( 'Single Blog Title Background', 'pangja' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  =>  array(
                            'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/bg-page-title.jpg'
                        ),
                        'required'  => array('haru_show_single_blog_title', '=', array('1'))
                    ),

                    array(
                        'id'       => 'haru_single_blog_title_parallax',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Single Blog Title Parallax', 'pangja' ),
                        'subtitle' => '',
                        'default'  => false,
                        'required' => array('haru_show_single_blog_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'haru_breadcrumbs_in_single_blog_title',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Breadcrumbs', 'pangja' ),
                        'subtitle' => '',
                        'default'  => true
                    ),
                )
            );

            // Social options
            $this->sections[] = array(
                'title'  => esc_html__( 'Social Settings', 'pangja' ),
                'desc'   => '',
                'icon'   => 'el el-facebook',
                'fields' => array(
                    array(
                        'title'    => esc_html__('Social Share', 'pangja'),
                        'id'       => 'haru_social_sharing',
                        'type'     => 'checkbox',
                        'subtitle' => esc_html__('Show the social sharing in blog posts or custom posttype', 'pangja'),
                        // Must provide key => value pairs for multi checkbox options
                        'options'  => array(
                            'facebook'  => esc_html__('Facebook', 'pangja'),
                            'twitter'   => esc_html__('Twitter', 'pangja'),
                            'google'    => esc_html__('Google', 'pangja'),
                            'linkedin'  => esc_html__('Linkedin', 'pangja'),
                            'tumblr'    => esc_html__('Tumblr', 'pangja'),
                            'pinterest' => esc_html__('Pinterest', 'pangja')
                        ),

                        // See how default has changed? you also don't need to specify opts that are 0.
                        'default' => array(
                            'facebook'  => '1',
                            'twitter'   => '1',
                            'google'    => '1',
                            'linkedin'  => '1',
                            'tumblr'    => '1',
                            'pinterest' => '1'
                        )
                    ),
                    array(
                        'id'       => 'haru_twitter_url',
                        'type'     => 'text',
                        'title'    => esc_html__('Twitter URL', 'pangja'),
                        'subtitle' => esc_html__('Please insert your Twitter URL.', 'pangja'),
                        'desc'     => '',
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'haru_facebook_url',
                        'type'     => 'text',
                        'title'    => esc_html__('Facebook URL', 'pangja'),
                        'subtitle' => esc_html__('Please insert your Facebook URL.', 'pangja'),
                        'desc'     => '',
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'haru_youtube_url',
                        'type'     => 'text',
                        'title'    => esc_html__('YouTube URL', 'pangja'),
                        'subtitle' => esc_html__('Please insert your Youtube URL.', 'pangja'),
                        'desc'     => '',
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'haru_pinterest_url',
                        'type'     => 'text',
                        'title'    => esc_html__('Pinterest URL', 'pangja'),
                        'subtitle' => esc_html__('Please insert your Pinterest URL.', 'pangja'),
                        'desc'     => '',
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'haru_instagram_url',
                        'type'     => 'text',
                        'title'    => esc_html__('Instagram URL', 'pangja'),
                        'subtitle' => esc_html__('Please insert your Instagram URL.', 'pangja'),
                        'desc'     => '',
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'haru_vimeo_url',
                        'type'     => 'text',
                        'title'    => esc_html__('Vimeo URL', 'pangja'),
                        'subtitle' => esc_html__('Please insert your Vimeo URL.', 'pangja'),
                        'desc'     => '',
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'haru_linkedin_url',
                        'type'     => 'text',
                        'title'    => esc_html__('LinkedIn URL', 'pangja'),
                        'subtitle' => esc_html__('Please insert your Linkedin URL.', 'pangja'),
                        'desc'     => '',
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'haru_googleplus_url',
                        'type'     => 'text',
                        'title'    => esc_html__('Google+ URL', 'pangja'),
                        'subtitle' => esc_html__('Please insert your Google+ URL.', 'pangja'),
                        'desc'     => '',
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'haru_flickr_url',
                        'type'     => 'text',
                        'title'    => esc_html__('Flickr URL', 'pangja'),
                        'subtitle' => esc_html__('Please insert your Flickr URL.', 'pangja'),
                        'desc'     => '',
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'haru_behance_url',
                        'type'     => 'text',
                        'title'    => esc_html__('Behance URL', 'pangja'),
                        'subtitle' => esc_html__('Please insert your Behance URL.', 'pangja'),
                        'desc'     => '',
                        'default'  => ''
                    )
                )
            );

            // Popup Configs
            $this->sections[] = array(
                'title'  => esc_html__( 'Newsletter Popup', 'pangja' ),
                'desc'   => '',
                'icon'   => 'el el-photo',
                'fields' => array(
                    array(
                        'id'       => 'haru_show_popup',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Show Popup', 'pangja' ),
                        'subtitle' => '',
                        'default'  => false
                    ),
                    array(
                        'id'       => 'haru_popup_width',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Popup Width', 'pangja' ),
                        'subtitle' => esc_html__( 'Please set with of popup (number only in px)', 'pangja' ),
                        'validate' => 'numeric',
                        'desc'     => '',
                        'default'  => '750'
                    ),
                    array(
                        'id'       => 'haru_popup_height',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Popup Height', 'pangja' ),
                        'subtitle' => esc_html__( 'Please set height of popup (number only in px)', 'pangja' ),
                        'validate' => 'numeric',
                        'desc'     => '',
                        'default'  => '450'
                    ),
                    array(
                        'id'       => 'haru_popup_effect',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Popup Effect', 'pangja' ),
                        'subtitle' => '',
                        'options'  => array(
                            'mfp-zoom-in'         => esc_html__( 'ZoomIn', 'pangja' ),
                            'mfp-newspaper'       => esc_html__( 'Newspaper', 'pangja' ),
                            'mfp-move-horizontal' => esc_html__( 'Move Horizontal', 'pangja' ),
                            'mfp-move-from-top'   => esc_html__( 'Move From Top', 'pangja' ),
                            'mfp-3d-unfold'       => esc_html__( '3D Unfold', 'pangja' ),
                            'mfp-zoom-out'        => esc_html__( 'ZoomOut', 'pangja' ),
                            'hinge'               => esc_html__( 'Hinge', 'pangja' )
                        ),
                        'desc'     => '',
                        'default'  => 'mfp-zoom-in'
                    ),
                    array(
                        'id'       => 'haru_popup_delay',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Popup Delay', 'pangja' ),
                        'subtitle' => esc_html__( 'Please set delay of popup (caculate by miliseconds)', 'pangja' ),
                        'validate' => 'numeric',
                        'desc'     => '',
                        'default'  => '5000'
                    ),
                    array(
                        'id'       => 'haru_popup_content',
                        'type'     => 'editor',
                        'title'    => esc_html__( 'Popup Content', 'pangja' ),
                        'subtitle' => esc_html__( 'Please set content of popup. You can use shortcode here.', 'pangja' ),
                        'desc'     => '',
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'haru_popup_background',
                        'type'     => 'media',
                        'title'    => esc_html__( 'Popup Background', 'pangja' ),
                        'url'      => true,
                        'subtitle' => '',
                        'desc'     => '',
                        'default'  => array(
                            'url'  =>  ''
                        ),
                    ),

                )
            );

            if ( true == haru_check_woocommerce_status() ) {
                // WooCommerce
                $this->sections[] = array(
                    'title'  => esc_html__( 'WooCommerce', 'pangja' ),
                    'desc'   => '',
                    'icon'   => 'el el-shopping-cart-sign',
                    'fields' => array(
                        array(
                            'id'       => 'haru_product_sale_flash_mode',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Sale Badge Mode', 'pangja' ),
                            'subtitle' => esc_html__( 'Choose Sale Badge Mode', 'pangja' ),
                            'desc'     => '',
                            'options'  => array(
                                'text'    => esc_html__( 'Text', 'pangja' ),
                                'percent' => esc_html__( 'Percent', 'pangja' )
                            ),
                            'default'  => 'percent'
                        ),
                        array(
                            'id'       => 'haru_product_attribute',
                            'type'     => 'product_attribute',
                            'title'    => esc_html__( 'Product Attribute', 'pangja' ),
                            'subtitle' => esc_html__( 'Show Product Attribute (Apply for Color, Image & Label attribute type in Products -> Attributes)', 'pangja' ),
                        ),
                        array(
                            'id'       => 'haru_product_quick_view',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Quick View Button', 'pangja' ),
                            'subtitle' => esc_html__( 'Enable/Disable Quick View', 'pangja' ),
                            'default'  => true
                        ),
                        array(
                            'id'       => 'haru_product_add_wishlist',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Add To Wishlist Button', 'pangja' ),
                            'subtitle' => esc_html__( 'Enable/Disable Add To Wishlist Button', 'pangja' ),
                            'default'  => true
                        ),
                        array(
                            'id'       => 'haru_product_add_to_compare',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Add To Compare Button', 'pangja' ),
                            'subtitle' => esc_html__( 'Enable/Disable Add To Compare Button', 'pangja' ),
                            'default'  => true
                        ),
                    )
                );

                // Archive Product
                $this->sections[] = array(
                    'title'      => esc_html__( 'Archive Product', 'pangja' ),
                    'desc'       => '',
                    'icon'       => 'el el-book',
                    'subsection' => true,
                    'fields'     => array(
                        array(
                            'id'       => 'haru_product_per_page',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Products Per Page', 'pangja' ),
                            'desc'     => esc_html__( 'This must be numeric or empty (default 12).', 'pangja' ),
                            'subtitle' => '',
                            'validate' => 'numeric',
                            'default'  => '12',
                        ),

                        array(
                            'id'       => 'haru_product_display_columns',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Products Display Columns', 'pangja' ),
                            'subtitle' => esc_html__( 'Choose the number of columns to display on shop/category pages.','pangja' ),
                            'options'  => array(
                                '2'     => '2',
                                '3'     => '3',
                                '4'     => '4',
                                '5'     => '5'
                            ),
                            'desc'    => '',
                            'default' => '3',
                            'select2' => array('allowClear' =>  false) ,
                        ),
                        array(
                            'id'     => 'haru-section-archive-product-layout-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Layout Options', 'pangja' ),
                            'indent' => true
                        ),
                        array(
                            'id'       => 'haru_archive_product_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Archive Product Layout', 'pangja' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'full'            => esc_html__( 'Full Width', 'pangja' ),
                                'container'       => esc_html__( 'Container', 'pangja' ), 
                            ),
                            'default'  => 'container'
                        ),
                        array(
                            'id'       => 'haru_archive_product_style',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Archive Product Style', 'pangja' ),
                            'subtitle' => esc_html__( 'Set shop page or product category style.', 'pangja' ),
                            'options'  => array(
                                'default' => esc_html__( 'Default', 'pangja' ), // style_1
                                'ajax'    => esc_html__( 'Ajax', 'pangja' ), // style_2
                            ),
                            'default'  => 'default'
                        ),
                        array(
                            'id'       => 'haru_ajax_show_categories',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Show Categories', 'pangja' ),
                            'subtitle' => esc_html__( 'Show/Hide categories in filter sidebar.', 'pangja' ),
                            'default'  => true,
                            'required' => array('haru_archive_product_style', '=', array('ajax')),
                        ),
                        array(
                            'id'       => 'haru_ajax_show_filters',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Show Filters', 'pangja' ),
                            'subtitle' => esc_html__( 'Show/Hide filters in filter sidebar.', 'pangja' ),
                            'default'  => true,
                            'required' => array('haru_archive_product_style', '=', array('ajax')),
                        ),
                        array(
                            'id'       => 'haru_ajax_show_search',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Show Search', 'pangja' ),
                            'subtitle' => esc_html__( 'Show/Hide search in filter sidebar.', 'pangja' ),
                            'default'  => true,
                            'required' => array('haru_archive_product_style', '=', array('ajax')),
                        ),
                        array(
                            'id'       => 'haru_archive_product_sidebar',
                            'type'     => 'image_select',
                            'title'    => esc_html__( 'Archive Product Sidebar', 'pangja' ),
                            'subtitle' => esc_html__( 'None, Left or Right Sidebar', 'pangja' ),
                            'desc'     => '',
                            'options'  => array(
                                'none'  => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-none.png'),
                                'left'  => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-left.png'),
                                'right' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-right.png')
                            ),
                            'default'  => 'right',
                            'required' => array('haru_archive_product_style', '=', array('default'))
                        ),

                        array(
                            'id'       => 'haru_archive_product_left_sidebar',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Archive Product Left Sidebar', 'pangja' ),
                            'subtitle' => '',
                            'data'     => 'sidebars',
                            'desc'     => '',
                            'default'  => 'woocommerce',
                            'required' => array('haru_archive_product_sidebar', '=', array('left')),
                        ),
                        array(
                            'id'       => 'haru_archive_product_right_sidebar',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Archive Product Right Sidebar', 'pangja' ),
                            'subtitle' => '',
                            'data'     => 'sidebars',
                            'desc'     => '',
                            'default'  => 'woocommerce',
                            'required' => array('haru_archive_product_sidebar', '=', array('right')),
                        ),
                        array(
                            'id'     => 'haru-section-archive-product-layout-end',
                            'type'   => 'section',
                            'indent' => false
                        ),
                        array(
                            'id'     => 'haru-section-archive-product-title-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Page Title Options', 'pangja' ),
                            'indent' => true
                        ),
                        array(
                            'id'       => 'haru_show_archive_product_title',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Archive Title', 'pangja' ),
                            'subtitle' => '',
                            'default'  => true
                        ),

                        array(
                            'id'       => 'haru_archive_product_title_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Archive Product Title Layout', 'pangja' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'full'            => esc_html__( 'Full Width', 'pangja' ),
                                'container'       => esc_html__( 'Container', 'pangja' ),
                            ),
                            'default'  => 'full',
                            'required' => array('haru_show_archive_product_title', '=', array('1')),
                        ),

                        array(
                            'id'       => 'haru_archive_product_title_bg_image',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => esc_html__( 'Archive Product Title Background', 'pangja' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'default'  => array(
                                'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/bg-page-title.jpg'
                            ),
                            'required'  => array('haru_show_archive_product_title', '=', array('1')),
                        ),

                        array(
                            'id'       => 'haru_archive_product_title_parallax',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Archive Product Title Parallax', 'pangja' ),
                            'subtitle' => '',
                            'default'  => false,
                            'required' => array('haru_show_archive_product_title', '=', array('1')),
                        ),

                        array(
                            'id'       => 'haru_breadcrumbs_in_archive_product_title',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Breadcrumbs in Archive Product', 'pangja' ),
                            'subtitle' => '',
                            'default'  => true
                        ),

                    )
                );

                // Single Product
                $this->sections[] = array(
                    'title'      => esc_html__( 'Single Product', 'pangja' ),
                    'desc'       => '',
                    'icon'       => 'el el-laptop',
                    'subsection' => true,
                    'fields'     => array(
                        array(
                            'id'     => 'haru-section-single-product-layout-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Layout Options', 'pangja' ),
                            'indent' => true
                        ),

                        array(
                            'id'       => 'haru_single_product_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Single Product Layout', 'pangja' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'full'            => esc_html__( 'Full Width', 'pangja' ),
                                'container'       => esc_html__( 'Container', 'pangja' ),
                            ),
                            'default'  => 'container'
                        ),

                        array(
                            'id'       => 'haru_single_product_style',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Single Product Style', 'pangja' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'horizontal'     => esc_html__( 'Horizontal Slide','pangja' ),
                                'vertical'       => esc_html__( 'Vertical Slide','pangja' ),
                                'vertical_gallery'       => esc_html__( 'Vertical Gallery','pangja' ),
                            ),
                            'default'  => 'horizontal'
                        ),

                        array(
                            'id'       => 'haru_single_product_thumbnail_columns',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Product Thumbnail Columns', 'pangja' ),
                            'subtitle' => esc_html__( 'Choose the number of columns to display thumbnails.','pangja' ),
                            'options'  => array(
                                '2'     => '2',
                                '3'     => '3',
                                '4'     => '4',
                                '5'     => '5'
                            ),
                            'desc'    => '',
                            'default' => '4',
                            'required'  => array('haru_single_product_style', '=', array('horizontal', 'vertical')),
                        ),

                        array(
                            'id'       => 'haru_single_product_thumbnail_position',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Product Thumbnails Position', 'pangja' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'thumbnail-left'        => esc_html__( 'Left', 'pangja' ),
                                'thumbnail-right'       => esc_html__( 'Right', 'pangja' ),
                            ),
                            'default'  => 'thumbnail-left',
                            'required'  => array('haru_single_product_style', '=', array('vertical')),
                        ),

                        array(
                            'id'       => 'haru_single_product_sidebar',
                            'type'     => 'image_select',
                            'title'    => esc_html__( 'Single Product Sidebar', 'pangja' ),
                            'subtitle' => esc_html__( 'None, Left or Right Sidebar', 'pangja' ),
                            'desc'     => '',
                            'options'  => array(
                                'none'  => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-none.png'),
                                'left'  => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-left.png'),
                                'right' => array('title' => '', 'img' => get_template_directory_uri().'/framework/admin-assets/images/theme-options/sidebar-right.png'),
                            ),
                            'default' => 'none'
                        ),

                        array(
                            'id'       => 'haru_single_product_left_sidebar',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Single Product Left Sidebar', 'pangja' ),
                            'subtitle' => '',
                            'data'     => 'sidebars',
                            'desc'     => '',
                            'default'  => 'woocommerce',
                            'required' => array('haru_single_product_sidebar', '=', array('left','both')),
                        ),

                        array(
                            'id'       => 'haru_single_product_right_sidebar',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Single Product Right Sidebar', 'pangja' ),
                            'subtitle' => '',
                            'data'     => 'sidebars',
                            'desc'     => '',
                            'default'  => 'woocommerce',
                            'required' => array('haru_single_product_sidebar', '=', array('right','both')),
                        ),

                        array(
                            'id'     => 'haru-section-single-product-layout-end',
                            'type'   => 'section',
                            'indent' => false
                        ),

                        array(
                            'id'     => 'haru-section-single-product-title-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Page Title Options', 'pangja' ),
                            'indent' => true
                        ),

                        array(
                            'id'       => 'haru_show_single_product_title',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Single Title', 'pangja' ),
                            'subtitle' => '',
                            'default'  => true
                        ),

                        array(
                            'id'       => 'haru_single_product_title_layout',
                            'type'     => 'button_set',
                            'title'    => esc_html__( 'Single Product Title Layout', 'pangja' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'options'  => array(
                                'full'            => esc_html__( 'Full Width', 'pangja' ),
                                'container'       => esc_html__( 'Container', 'pangja' ),
                            ),
                            'default'  => 'full',
                            'required' => array('haru_show_single_product_title', '=', array('1')),
                        ),

                        array(
                            'id'       => 'haru_single_product_title_bg_image',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => esc_html__( 'Single Product Title Background', 'pangja' ),
                            'subtitle' => '',
                            'desc'     => '',
                            'default'  => array(
                                'url' => get_template_directory_uri() . '/framework/admin-assets/images/theme-options/bg-page-title.jpg'
                            ),
                            'required'  => array('haru_show_single_product_title', '=', array('1')),
                        ),

                        array(
                            'id'       => 'haru_single_product_title_parallax',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Single Product Title Parallax', 'pangja' ),
                            'subtitle' => '',
                            'default'  => false,
                            'required' => array('haru_show_single_product_title', '=', array('1')),
                        ),

                        array(
                            'id'       => 'haru_breadcrumbs_in_single_product_title',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Breadcrumbs in Single Product', 'pangja' ),
                            'subtitle' => '',
                            'default'  => true
                        ),

                        array(
                            'id'     => 'haru-section-single-product-title-end',
                            'type'   => 'section',
                            'indent' => false
                        ),

                        array(
                            'id'     => 'haru-section-single-product-related-start',
                            'type'   => 'section',
                            'title'  => esc_html__( 'Related Product Options', 'pangja' ),
                            'indent' => true
                        ),

                        array(
                            'id'       => 'haru_related_product_count',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Related Products Number', 'pangja' ),
                            'subtitle' => '',
                            'validate' => 'number',
                            'default'  => '6',
                        ),

                        array(
                            'id'       => 'haru_related_product_display_columns',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Related Product Display Columns', 'pangja' ),
                            'subtitle' => '',
                            'options'  => array(
                                '3'     => esc_html__( '3', 'pangja' ),
                                '4'     => esc_html__( '4', 'pangja' ),
                            ),
                            'desc'    => '',
                            'default' => '4'
                        ),

                        array(
                            'id'     => 'haru-section-single-product-related-end',
                            'type'   => 'section',
                            'indent' => false
                        ),

                    )
                );
            }
            // Portfolio Settings

        }

        public function setHelpTabs() {

        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'           => 'haru_pangja_options',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'       => $theme->get( 'Name' ),
                // Name that appears at the top of your panel
                'display_version'    => $theme->get( 'Version' ),
                // Version that appears at the top of your panel
                'menu_type'          => 'menu', // or submenu under Appearence
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'     => true,
                // Show the sections below the admin menu item or not
                'menu_title'         => esc_html__( 'Theme Options', 'pangja' ),
                'page_title'         => esc_html__( 'Theme Options', 'pangja' ),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'     => '',
                // Must be defined to add google fonts to the typography module

                'async_typography'   => false,
                // Use a asynchronous font on the front end or font string
                'admin_bar'          => true,
                // Show the panel pages on the admin bar
                'global_variable'    => '',
                // Set a different name for your global variable other than the opt_name
                'dev_mode'           => false,
                // Show the time the page took to load, etc
                'forced_dev_mode_off' => true,
                // To forcefully disable the dev mode
                'templates_path'     => get_template_directory().'/framework/core/templates/panel',
                // Path to the templates file for various Redux elements
                'customizer'         => true,
                // Enable basic customizer support

                // OPTIONAL -> Give you extra features
                'page_priority'      => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'        => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_theme_page#Parameters
                'page_permissions'   => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon'          => '',
                // Specify a custom URL to an icon
                'last_tab'           => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon'          => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug'          => '_options',
                // Page slug used to denote the panel
                'save_defaults'      => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show'       => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark'       => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time'     => 60 * MINUTE_IN_SECONDS,
                'output'             => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'         => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'           => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'        => false,
                // REMOVE

                // HINTS
                'hints'              => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'   => 'light',
                        'shadow'  => true,
                        'rounded' => false,
                        'style'   => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'mouseover',
                        ),
                        'hide' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'click mouseleave',
                        ),
                    ),
                )
            );

            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => esc_html__( 'Visit us on GitHub', 'pangja' ),
                'icon'  => 'el el-github'
            );
            $args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => esc_html__( 'Like us on Facebook', 'pangja' ),
                'icon'  => 'el el-facebook'
            );
            $args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => esc_html__( 'Follow us on Twitter', 'pangja' ),
                'icon'  => 'el el-twitter'
            );
            $args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => esc_html__( 'Find us on LinkedIn', 'pangja' ),
                'icon'  => 'el el-linkedin'
            );

        }

    }

    // global $reduxConfig;
    $reduxConfig = new Redux_Framework_theme_options();
}