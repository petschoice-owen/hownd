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
                            <?php $featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium' ); ?>
                            <a href="<?php the_permalink(); ?>" class="post-link">
                                <img src="<?php echo $featured_img[0]; ?>" class="featured-image" alt="<?php the_title(); ?>" />
                            </a>
                            <?php // $post_date = get_the_date( 'F jS Y' ); ?>
                            <!-- <div class="post-meta">
                                <span class="date"><?php // echo $post_date; ?></span>
                            </div> -->
                            <div class="blog-details">
                                <a href="<?php the_permalink(); ?>">
                                    <h4 class="post-title"><?php the_title(); ?></h4>
                                </a>
                                <div class="excerpt">
                                    <?php
                                        if (has_excerpt()) { 
                                            $excerpt = get_the_excerpt(); 
                                            echo '<p>' . (strlen($excerpt) > 200 ? substr($excerpt, 0, 200) . '...' : $excerpt) . '</p>';
                                            ?>
                                        <? }
                                        else { 
                                            $content = get_the_content();
                                            echo (strlen($content) > 200 ? substr($content, 0, 200) . '...' : $content);
                                        } 
                                    ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <!-- pagination -->
                <div class="col-12">
                    <div class="pagination-section">
                        <?php 
                            $total = $wp_query->found_posts;
                            $current_page = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                            $posts_per_page = get_query_var('posts_per_page');
                            $start = ( $current_page - 1 ) * $posts_per_page + 1;
                            $end = min( $current_page * $posts_per_page, $total );
                            echo '<p>Showing ' . $start . '-' . $end . ' of ' . $total . ' results</p>';
                        ?>
                        <?php the_posts_pagination(); ?>
                    </div>
                </div>
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