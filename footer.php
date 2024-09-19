            <?php echo is_woocommerce() ? '</div>' : ''; ?>
            <?php if( is_product() && have_rows( 'hownd_product_text_images', 'option' ) ) : ?>
                <div class="single-product__text-images">
                    <div class="container">
                        <div class="row">
                            <?php while( have_rows( 'hownd_product_text_images', 'option' ) ) : the_row(); ?>
                            <div class="col-12 col-md-4 single-product__text-images-col">
                                <?php
                                    if( $logo_img = get_sub_field( 'image' ) ) {
                                        echo wp_get_attachment_image( $logo_img, 'medium' );
                                    }

                                    if( $text = get_sub_field( 'title' ) ) {
                                        echo '<h3>'. $text .'</h3>';
                                    }
                                ?>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </main>
        <footer class="footer">
            <?php if ( have_rows( 'hownd_footer_logo_slider', 'option' ) ): ?>
                <div class="footer__logos">
                    <div class="container">
                        <div class="footer__logos-slider js-footer-logo-slider">
                            <?php while( have_rows( 'hownd_footer_logo_slider', 'option' ) ): the_row(); 
                                $logo_img = get_sub_field( 'image' ); 
                                $logo_link = get_sub_field( 'link' );
                                if ( $logo_img ) : ?>
                                    <?php if ( $logo_link ) : ?>
                                        <a href="<?php echo esc_url( $logo_link ); ?>" target="_blank" class="footer__logos-slide" aria-label="logo">
                                    <?php else: ?>
                                        <span class="footer__logos-slide">
                                    <?php endif; ?>
                                        <?php echo wp_get_attachment_image( $logo_img, 'medium' ); ?>
                                    <?php if ( $logo_link ) : ?>
                                        </a>
                                    <?php else: ?>
                                        </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ( have_rows( 'hownd_footer_newsletter', 'option' ) ): ?>
                <?php while ( have_rows( 'hownd_footer_newsletter', 'option' ) ): the_row(); ?>
                <div class="footer__newsletter">
                    <div class="container">
                        <div class="row">
                            <?php if ( have_rows( 'left_column' ) ): ?>
                                <?php while ( have_rows( 'left_column' ) ): the_row(); ?>
                                <div class="col-lg-6">
                                    <?php echo get_sub_field( 'heading' ) ? '<h3>'. get_sub_field( 'heading' ) .'</h3>' : ''; ?>
                                    <?php if ( $text = get_sub_field( 'text' ) ) : ?>
                                        <div class="footer__newsletter-text">
                                            <?php echo $text; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( $images = get_sub_field( 'step_images' ) ) : ?>
                                        <div class="footer__newsletter-icons">
                                            <?php foreach( $images as $image_id ): ?>
                                                <?php echo wp_get_attachment_image( $image_id, 'medium' ); ?>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php 
                                    $link = get_sub_field( 'button' );
                                    if( $link ): 
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                        <div><a class="btn-gray" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></div>
                                    <?php endif; ?>
                                </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <?php if ( have_rows( 'right_column' ) ): ?>
                                <?php while ( have_rows( 'right_column' ) ): the_row(); ?>
                                    <div class="col-lg-6">
                                        <?php echo get_sub_field( 'heading' ) ? '<h3>'. get_sub_field( 'heading' ) .'</h3>' : ''; ?>
                                        <?php if ( $text = get_sub_field( 'text' ) ) : ?>
                                            <div class="footer__newsletter-text">
                                                <?php echo $text; ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="footer__newsletter-socials">
                                            <?php echo get_template_part( 'partials/social' ); ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
        <div class="footer__wrapper">
            <div class="container">
                <div class="footer__main">
                    <?php if ( $logo = get_field( 'hownd_footer_logo', 'option' ) ) : ?>
                        <div class="footer__logo"><a href="<?php echo home_url(); ?>"><?php echo wp_get_attachment_image( $logo, 'large' ); ?></a></div>
                    <?php endif; ?>
                    <?php if ( have_rows( 'hownd_footer_menu', 'option' ) ) : ?>
                        <?php while ( have_rows( 'hownd_footer_menu', 'option' ) ) : the_row(); ?>
                            <div class="footer__menu">
                                <h5 class="footer__menu-title"><?php echo get_sub_field( 'heading' ); ?></h5>
                                <?php if ( have_rows( 'menu' ) ) : ?>
                                    <ul>
                                    <?php while ( have_rows( 'menu' ) ) : the_row(); ?>
                                        <?php 
                                        $link = get_sub_field( 'menu_item' );
                                        if( $link ): 
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                            <li><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></li>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <div class="footer__bottom">
                    <div class="footer__bottom-left">
                        <?php if ( $payments = get_field( 'hownd_footer_payment_options', 'option' ) ) : ?>
                            <div class="payment-icons">
                                <?php foreach( $payments as $image_id ): ?>
                                    <?php echo wp_get_attachment_image( $image_id, 'medium' ); ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="footer__bottom-right">
                        <div class="footer__bottom-socials">
                            <?php echo get_template_part( 'partials/social' ); ?>
                        </div>
                    </div>
                    <div class="footer__bottom-left">
                        <?php if ( $copyright = get_field( 'hownd_footer_copyright', 'option' ) ) : ?>
                            <div class="footer__copyright"><?php echo $copyright; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        </footer>
    </div>
    <?php if ( !is_user_logged_in() ) : ?>
        <a href="#" class="trigger-hownd-club js-hownd-club-trigger"><i class="fa fa-angle-up"></i> <?php echo __( 'The Hownd Club', 'hownd' ); ?></a>
        <div id="howndClubPopup" class="popup popup--howndclub">
            <div class="popup__wrapper">
                <div class="d-md-none popup__close-mobile-wrapper">
                    <a href="#" class="popup__close-mobile js-close-popup"><i class="fa fa-angle-left"></i> Return to store</a>
                </div>
                <div class="popup__header">
                    <?php echo get_field( 'hownd_hcp_heading', 'option' ); ?>
                    <a href="#" class="popup__close js-close-popup"><i class="fa fa-remove"></i></a>
                </div>
                <div class="popup__content">
                    <?php if( have_rows( 'hownd_hcp_left_column', 'option' ) ) : ?>
                        <?php while( have_rows( 'hownd_hcp_left_column', 'option' ) ) : the_row(); ?>
                            <div class="popup--howndclub__column">
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
                            <div class="popup--howndclub__column">
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
                <div class="popup__footer">
                    <p>Log in or sign up to HOWND to earn rewards today</p>
                    <div class="actions">
                        <a href="<?php echo wc_get_page_permalink( 'myaccount' ) . '/login'; ?>" class="btn-primary2">Log in</a>
                        <span class="spacer">/</span>
                        <a href="<?php echo wc_get_page_permalink( 'myaccount' ) . '/register'; ?>" class="btn-primary2">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ( is_user_logged_in() ) : ?>
        <div id="donatePopup" class="popup popup--donate">
            <div class="popup__wrapper">
                <div class="popup__header">
                    <?php echo __( 'Donate to All Dogs Matter', 'hownd' ); ?>
                    <a href="#" class="d-block popup__close js-close-popup"><i class="fa fa-remove"></i></a>
                </div>
                <div class="popup__content p-4 text-center">
                    <?php echo do_shortcode('[hownd_donate_form]'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php wp_footer(); ?>

    </body>
</html>
