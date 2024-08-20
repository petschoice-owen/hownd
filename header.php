<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class();?>>
    <div class="body__wrapper">
        <header class="header">
            <div class="header__top">
                <div class="container">
                    <div class="header__socials">
                        <?php echo get_template_part( 'partials/social' ); ?>
                    </div>
                    <div class="header__announcement"><?php echo get_field( 'hownd_header_announcement', 'option' ); ?></div>
                    <div class="header__top-menu">
                        <?php
                            wp_nav_menu(
                                array(
                                    'theme_location'  => 'top_menu',
                                    'container'       => '',
                                    'menu_class'      => '',
                                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'fallback_cb'     => '__return_false',
                                    'walker'          => new WP_bootstrap_4_walker_nav_menu()
                                )
                            );
                        ?>
                    </div>
                </div>
            </div>
            <div class="header__main">
                <div class="container">
                    <div class="header__main-wrapper">
                        <div class="header__middle">
                            <div class="left-side">
                                <a href="#" class="d-lg-none header__toggler js-nav-toggler">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" fill="#9a9a9a"></path></svg>
                                </a>
                            </div>
                            <div class="header__logo">
                                <?php echo get_custom_logo() ? get_custom_logo() : get_bloginfo(); ?>
                            </div>
                            <div class="right-side">
                                <a href="#" class="d-none d-lg-block js-header-search">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" fill="currentColor"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
                                </a>
                                <a href="#" class="d-none d-lg-block">Account</a>
                                <a href="#" class="header__cart-count">
                                    <svg width="13px" height="16px" viewBox="0 0 13 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <!-- Generator: Sketch 63.1 (92452) - https://sketch.com -->
                                        <title>cart icon</title>
                                        <desc>Created with Sketch.</desc>
                                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="cart-icon" transform="translate(1.000000, 1.000000)" stroke="#000000" stroke-width="1.8">
                                                <g>
                                                    <path d="M0,4.14285714 L11,4.14285714 L11,12.9519759 C11,13.5042606 10.5522847,13.9519759 10,13.9519759 L1,13.9519759 C0.44771525,13.9519759 6.76353751e-17,13.5042606 0,12.9519759 L0,4.14285714 L0,4.14285714 Z" id="Path-2"></path>
                                                    <path d="M2,4.14285714 L2,2.78056875 C2.6420657,0.92685625 3.80873237,-1.0658141e-14 5.5,-1.0658141e-14 C7.19126763,-1.0658141e-14 8.3579343,0.92685625 9,2.78056875 L9,4.14285714" id="Path-3"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <span class="count">0</span>
                                </a>
                            </div>
                            <div class="header__search">
                                <form role="search" method="get" class="search-form header__search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
									<label>
										<span class="screen-reader-text"><?php echo _x( 'What are you looking for?', 'label', 'hownd' ); ?></span>
										<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'What are you looking for?', 'placeholder', 'hownd' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
									</label>
									<button type="submit" class="search-submit"><?php echo __( 'Submit', 'hownd' ); ?></button>
								</form>
                            </div>
                            <div class="header__search-overlay"></div>
                        </div>
                        <div class="header__nav d-none d-lg-block">
                            <div class="header__nav-wrapper">
                                <?php
                                    wp_nav_menu(
                                        array(
                                            'theme_location'  => 'primary',
                                            'container'       => '',
                                            'menu_class'      => 'navbar-nav',
                                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                            'fallback_cb'     => '__return_false',
                                            'walker'          => new WP_bootstrap_4_walker_nav_menu()
                                        )
                                    );
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-nav">
                <div class="mobile-nav__header">
                    <a href="#" class="js-close-mobile-nav">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="icon close" viewBox="0 0 20 20"><path d="M15.89 14.696l-4.734-4.734 4.717-4.717c.4-.4.37-1.085-.03-1.485s-1.085-.43-1.485-.03L9.641 8.447 4.97 3.776c-.4-.4-1.085-.37-1.485.03s-.43 1.085-.03 1.485l4.671 4.671-4.688 4.688c-.4.4-.37 1.085.03 1.485s1.085.43 1.485.03l4.688-4.687 4.734 4.734c.4.4 1.085.37 1.485-.03s.43-1.085.03-1.485z"></path></svg>
                    </a>
                </div>
                <div class="mobile-nav__middle">
                    <?php
                        wp_nav_menu(
                            array(
                                'theme_location'  => 'mobile_menu',
                                'container'       => '',
                                'menu_class'      => '',
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'fallback_cb'     => '__return_false',
                                'walker'          => new WP_bootstrap_4_walker_nav_menu()
                            )
                        );
                    ?>
                </div>
                <div class="mobile-nav__bottom">
                    <a href="#">Account</a>
                    <a href="#" class="js-mobile-search">Search</a>
                </div>
                <div class="mobile-search">
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <label>
                            <span class="screen-reader-text"><?php echo _x( 'Search', 'label', 'hownd' ); ?></span>
                            <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'hownd' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                        </label>
                        <a href="#" class="js-close-mobile-search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="icon close" viewBox="0 0 20 20"><path d="M15.89 14.696l-4.734-4.734 4.717-4.717c.4-.4.37-1.085-.03-1.485s-1.085-.43-1.485-.03L9.641 8.447 4.97 3.776c-.4-.4-1.085-.37-1.485.03s-.43 1.085-.03 1.485l4.671 4.671-4.688 4.688c-.4.4-.37 1.085.03 1.485s1.085.43 1.485.03l4.688-4.687 4.734 4.734c.4.4 1.085.37 1.485-.03s.43-1.085.03-1.485z"></path></svg>
                        </a>
                    </form>
                </div>
            </div>
            <div class="mobile-nav-overlay"></div>
        </header>
        <div class="header-placeholder"></div>
        <main>