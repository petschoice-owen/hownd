<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>
    <div class="container">
        <div class="row h-100 py-5 my-5 text-center justify-content-center align-items-center">
            <div class="col-12">
                <h1><?php echo __( '404 Page Not Found', 'hownd' ); ?></h1>
                <div>The page you requested does not exist. Click <a href="<?php echo home_url();?>">here</a> to continue shopping.</div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
