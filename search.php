<?php
/**
 * The template for displaying search results for archive pages
 *
 * This is the template that displays search results for archive by default.
 * 
 * 
 * 
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header();
?>
    <div class="wp-block-group px-3">
        <div class="wp-block-group__inner-container">
            <?php 
                global $wp_query;
                $total_results = $wp_query->found_posts;    
            ?>
            <h1 class="text-center"><?php echo $total_results. ' results for "'. get_search_query() .'"'; ?></h1>
            <div class="search-results__form">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'hownd' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                </form>
            </div>
            <?php if ( have_posts() ) : ?>
                <div class="search-results__list">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <a href="<?php echo get_the_permalink(); ?>" class="search-results__item">
                            <?php
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'medium' );
                            }
                            ?>
                            <div class="info">
                                <h3><?php echo get_the_title(); ?></h3>
                                <?php
                                    if ( 'product' === get_post_type() ) {
                                        global $product;
                                        $product = wc_get_product( get_the_ID() );
                                        if ( $product ) {
                                            echo '<div class="price">' . $product->get_price_html() . '</div>';
                                        }
                                    } else {
                                        echo get_the_excerpt();
                                    }
                                ?>
                            </div>
                        </a>
                    <?php endwhile; ?>
                    <div class="pagination-wrapper">
                        <?php 
                            $total = $wp_query->found_posts;
                            $current_page = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                            $posts_per_page = get_query_var('posts_per_page');
                            $start = ( $current_page - 1 ) * $posts_per_page + 1;
                            $end = min( $current_page * $posts_per_page, $total );
                            echo '<p>You\'re viewing ' . $start . '-' . $end . ' of ' . $total .'</p>';
                        ?>
                        <?php the_posts_pagination(); ?>
                    </div>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p class="text-center">Please try a different search term or go back to the <a href="<?php echo home_url(); ?>">homepage</a>.</p>
            <?php endif; ?>
        </div>
    </div>
<?php
get_footer();