<?php 
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

get_header();
?>
<section class="haru-404-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="haru-content-404">
                    <div class="page-content">
                        <h2 class="entry-title haru-title-404"><?php echo esc_html__( '404', 'pangja' ); ?></h2>
                        <p class="txt2"><?php echo esc_html__( 'Sorry, looks like this page doesn\'t exist', 'pangja' ); ?></p>
                        <p class="txt3"><?php echo esc_html__( 'You could either go to homepage', 'pangja' ); ?></p>
                        <a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr__( 'Home Page','pangja' ); ?>">
                            <?php echo esc_html__( 'Back to home', 'pangja' ); ?>
                        </a>
                    </div>
                    <!-- .page-content -->
                </div>
            </div>
            <!-- /.haru-content-area-->
        </div>
        <!-- /.row-->
    </div>
    <!-- /.container-->
</section>
<?php get_footer(); ?>