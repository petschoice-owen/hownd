<?php
/**
 * The template for displaying archive pages
 *
 * This is the template that displays all archives by default.
 * Please note that this is the WordPress construct of archives
 * and that other 'archives' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header();
?>

    <div class="container">
        <div class="intro">
            <h1><?php echo get_the_title( get_option( 'page_for_posts' ) ); ?></h1>
        </div>
        <ul class="blog-categories">
            <li>
                <a href="/blogs/category/featured">Featured</a>
            </li>
            <li>
                <a href="/hownd-as-seen-in">As Seen In...</a>
            </li>
            <li>
                <a href="/blogs/category/our-backers">Our Backers</a>
            </li>
        </ul>
    </div>
    <?php if ( have_posts() ) : ?>
        <div class="container">
            <div class="row">
                <?php while ( have_posts() ) : ?>
                    <?php the_post(); ?>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="blog-preview">
                            <?php $featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full' ); ?>
                            <a href="<?php the_permalink(); ?>" class="post-link">
                                <div class="featured-image-wrapper">
                                    <img src="<?php echo $featured_img[0]; ?>" class="featured-image" alt="<?php the_title(); ?>" />
                                </div>
                            </a>
                            <?php // $post_date = get_the_date( 'F jS Y' ); ?>
                            <!-- <div class="post-meta">
                                <span class="date"><?php // echo $post_date; ?></span>
                            </div> -->
                            <a href="<?php the_permalink(); ?>">
                                <h4 class="post-title"><?php the_title(); ?></h4>
                            </a>
                            <?php
                                // Check if the post has an excerpt
                                if (has_excerpt()) { ?>
                                    <p class="excerpt"><?php the_excerpt(); ?></p>
                                <? }
                                // else { the_content(); } 
                            ?>
                        </div>
                    </div>
                <?php endwhile; ?>
                <!-- pagination -->
                <?php the_posts_pagination(); ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    <?php else : ?>
        <div class="container">
            <h1 class="archive-heading">There are no posts at the moment.</h1>
        </div>
    <?php endif; ?>

    <!-- recently viewed products -->
    <div class="container">
        <?php echo do_shortcode('[recently_viewed_products]'); ?>
    </div>
<?php
get_footer();