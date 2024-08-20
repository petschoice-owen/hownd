
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
  <?php wp_footer(); ?>

  </body>
</html>
