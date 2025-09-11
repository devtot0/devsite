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

$plans_arr   = (array)vc_param_group_parse_atts( $plans );
$plan_class  = 'plan-col-' . $columns;
// Equeue assets
?>
<div class="pricing-plan-shortcode-wrap <?php echo esc_attr($layout_type . ' ' . $plan_class . $el_class); ?>">
    <div class="pricing-plan-wrap plan-list">
        <?php
            foreach( $plans_arr as $plan ) : 
                $link = '';
                if ( isset($plan['link']) ) {
                    $link = vc_build_link( $plan['link'] );
                }
        ?>
            <div class="plan-item-wrap">
                <div class="plan-item <?php if ( array_key_exists( 'featured', $plan ) ) echo esc_attr($plan['featured']); ?>">
                    <div class="plan-item-top">
                        <?php if ( $plan['title'] != '' ) : ?>
                            <h3 class="plan-title"><?php echo esc_html( $plan['title'] ); ?></h3>
                        <?php endif; ?>
                        <div class="plan-price">
                            <span class="plan-currency"><?php if ( $plan['price'] != '0' ) echo esc_html( $currency ); ?></span>
                            <?php if ( array_key_exists( 'price', $plan ) ) : ?>
                                <span class="price">
                                    <?php 
                                        if ( $plan['price'] == '0' ) {
                                            echo esc_html__( 'Free', 'haru-pangja' );
                                        } else {
                                            echo esc_html( $plan['price'] ); 
                                        }
                                    ?>
                                </span>
                            <?php endif; ?>
                            <span class="plan-unit"><?php if ( $plan['price'] != '0' ) echo esc_html( $time_unit ); ?></span>
                        </div>
                    </div>

                    <div class="plan-content">
                        <ul class="plan-information">
                            <?php
                                $information_arr   = (array)vc_param_group_parse_atts( $plan['information'] );
                                foreach( $information_arr as $information ) : 
                            ?>
                            <li class="<?php echo esc_attr( $information['active'] ); ?>"><?php echo $information['info']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php if ( $link != '' ) : ?>
                        <a href="<?php echo esc_url($link['url']); ?>" class="plan-link" target="<?php echo esc_attr( ($link['target'] != '') ? $link['target'] : '_self' ); ?>"><?php echo esc_html__( 'Purchase', 'haru-pangja' ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>