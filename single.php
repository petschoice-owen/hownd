<?php
/**
 * The template for displaying all posts
 *
 * This is the template that displays all posts by default.
 * Please note that this is the WordPress construct of posts
 * and that other 'posts' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header();
?>

    <?php if ( have_posts() ) : ?>
        <div class="container">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php 
                    $featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large' ); 
                    $post_date = get_the_date( 'F jS Y' );
                    if ( !empty($featured_img) ) : ?>
                        <h1 class="post-title"><?php the_title(); ?></h1>
                        <p class="date"><?php echo esc_html($post_date); ?></p>
                        <div class="content">
                            <div class="featured-image-wrapper">
                                <img src="<?php echo esc_url($featured_img[0]); ?>" class="featured-image" alt="<?php the_title_attribute(); ?>" />
                            </div>
                            <?php the_content(); ?>
                        </div>
                        <?php
                            $categories = get_the_category();
                            if ( $categories ) {
                                $category_ids = array();

                                foreach ( $categories as $category ) {
                                    $category_ids[] = $category->term_id;
                                }

                                $args = array(
                                    'post_type'      => 'post',
                                    'posts_per_page' => 3, 
                                    'post__not_in'   => array( get_the_ID() ), 
                                    'orderby'        => 'rand', 
                                    'category__in'   => $category_ids, 
                                );

                                $related_posts_query = new WP_Query( $args );

                                if ( $related_posts_query->have_posts() ) : ?>
                                    <div class="related-posts">
                                        <h2 class="section-heading">Related Posts</h2>
                                        <div class="row">
                                            <?php while ( $related_posts_query->have_posts() ) : $related_posts_query->the_post(); ?>
                                                <div class="col-12 col-md-4">
                                                    <div class="blog-preview">
                                                        <?php $featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium' ); ?>
                                                        <a href="<?php the_permalink(); ?>" class="post-link">
                                                            <img src="<?php echo $featured_img[0]; ?>" class="featured-image" alt="<?php the_title(); ?>" />
                                                        </a>
                                                        <div class="blog-details">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <h4 class="post-title"><?php the_title(); ?></h4>
                                                            </a>
                                                            <div class="excerpt">
                                                                <?php
                                                                    if (has_excerpt()) { 
                                                                        $excerpt = get_the_excerpt(); 
                                                                        echo '<p>' . (strlen($excerpt) > 150 ? substr($excerpt, 0, 150) . '...' : $excerpt) . '</p>';
                                                                    } else { 
                                                                        $content = get_the_content();
                                                                        echo (strlen($content) > 150 ? substr($content, 0, 150) . '...' : $content);
                                                                    } 
                                                                ?>
                                                            </div>
                                                            <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                    <?php wp_reset_postdata(); 
                                endif;
                            }
                        ?>

                    <?php else : ?>
                        <h1 class="post-title"><?php the_title(); ?></h1>
                        <p class="date"><?php echo esc_html($post_date); ?></p>
                        <div class="content no-featured-image">
                            <?php the_content(); ?>
                        </div>
                    <?php endif; 
                ?>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <div class="container">
            <h1 class="archive-heading">There are no posts at the moment.</h1>
        </div>
    <?php endif; ?>
<?php
get_footer();