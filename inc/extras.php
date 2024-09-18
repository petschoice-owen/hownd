<?php
function hownd_include_products_in_search($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', array('post', 'page', 'product'));
    }
    return $query;
}
add_filter('pre_get_posts', 'hownd_include_products_in_search');

function hownd_club_info_function() {
    ob_start();
    ?>
        <div class="hc-info">
            <?php if( get_field( 'hownd_hcp_heading', 'option' ) ) : ?>
                <div class="hc-info__header">
                    <?php echo get_field( 'hownd_hcp_heading', 'option' ); ?>
                </div>
            <?php endif; ?>
            <div class="hc-info__content">
                <?php if( have_rows( 'hownd_hcp_left_column', 'option' ) ) : ?>
                    <?php while( have_rows( 'hownd_hcp_left_column', 'option' ) ) : the_row(); ?>
                        <div class="hc-info__content-column">
                            <div class="intro">
                                <?php echo get_sub_field( 'title' ); ?>
                            </div>
                            <?php if( have_rows( 'list' ) ) : ?>
                                <div class="list">
                                    <?php while( have_rows( 'list' ) ) : the_row(); ?>
                                        <div class="list-item">
                                            <?php
                                            if( $image = get_sub_field( 'image' ) ) {
                                                echo '<div class="image">' . wp_get_attachment_image( $image, 'medium' ) . '</div>';
                                            }
                                            ?>
                                            <div class="info">
                                                <div class="title"><?php echo get_sub_field( 'title' ); ?></div>
                                                <div class="value"><?php echo get_sub_field( 'subtitle' ); ?></div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php if( have_rows( 'hownd_hcp_right_column', 'option' ) ) : ?>
                    <?php while( have_rows( 'hownd_hcp_right_column', 'option' ) ) : the_row(); ?>
                        <div class="hc-info__content-column">
                            <div class="intro">
                                <?php echo get_sub_field( 'title' ); ?>
                            </div>
                            <?php if( have_rows( 'list' ) ) : ?>
                                <div class="list">
                                    <?php while( have_rows( 'list' ) ) : the_row(); ?>
                                        <div class="list-item">
                                            <?php
                                            if( $image = get_sub_field( 'image' ) ) {
                                                echo '<div class="image">' . wp_get_attachment_image( $image, 'medium' ) . '</div>';
                                            }
                                            ?>
                                            <div class="info">
                                                <div class="title"><?php echo get_sub_field( 'title' ); ?></div>
                                                <div class="value"><?php echo get_sub_field( 'subtitle' ); ?></div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="hc-info__footer">
                <p>Log in or sign up to HOWND to earn rewards today</p>
                <div class="actions">
                    <a href="<?php echo wc_get_page_permalink( 'myaccount' ) . '/login'; ?>" class="btn-primary2">Log in</a>
                    <span class="spacer">/</span>
                    <a href="<?php echo wc_get_page_permalink( 'myaccount' ) . '/register'; ?>" class="btn-primary2">Sign up</a>
                </div>
            </div>
        </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'hownd_club_info', 'hownd_club_info_function' );