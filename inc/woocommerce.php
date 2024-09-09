<?php
//wrapper
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

function hownd_output_content_wrapper() {
	echo '<div class="hownd-shop-wrapper">';
}
add_action( 'woocommerce_before_main_content', 'hownd_output_content_wrapper',10 );

function hownd_output_content_wrapper_end() {
    echo '</div>';
}
add_action( 'woocommerce_after_main_content', 'hownd_output_content_wrapper_end', 10 );

//PRODUCT PAGE
function hownd_feeding_guide_product_tab_content() {
    global $product;
    echo '<h2 class="hownd-tab-toggler">Feeding Guide</h2>';
    echo '<div class="hownd-tab-content-wrapper">';
    echo get_field( 'hownd_product_feeding_guide', $product->get_ID() );
    echo '</div>';
}
function hownd_how_to_use_product_tab_content() {
    global $product;
    echo '<h2 class="hownd-tab-toggler">How to Use</h2>';
    echo '<div class="hownd-tab-content-wrapper">';
    echo get_field( 'hownd_product_how_to_use', $product->get_ID() );
    echo '</div>';
}
function hownd_ingredients_product_tab_content() {
    global $product;
    echo '<h2 class="hownd-tab-toggler">Ingredients</h2>';
    echo '<div class="hownd-tab-content-wrapper">';
    echo get_field( 'hownd_product_ingredients', $product->get_ID() );
    echo '</div>';
}
function hownd_faqs_product_tab_content() {
    global $product;
    echo '<h2 class="hownd-tab-toggler">FAQs</h2>';
    echo '<div class="hownd-tab-content-wrapper">';
    while( have_rows( 'hownd_product_faqs', $product->get_ID() ) ) {
        the_row();
        ?>
        <div class="product-accordion__item">
            <div class="product-accordion__item-header" data-bs-toggle="collapse" data-bs-target="#product-faq<?php echo get_row_index(); ?>" aria-expanded="false">
                <?php echo get_sub_field( 'heading' ); ?>
            </div>
            <div id="product-faq<?php echo get_row_index(); ?>" class="collapse">
                <div class="product-accordion__item-content">
                    <?php echo get_sub_field( 'content' ); ?>
                </div>
            </div>
        </div>
    <?php
    }
    echo '</div>';
}
function hownd_video_product_tab_content() {
    global $product;
    echo '<h2 class="hownd-tab-toggler">Video</h2>';
    echo '<div class="hownd-tab-content-wrapper">';
    echo get_field( 'hownd_product_video', $product->get_ID() );
    echo '</div>';
}
function hownd_custom_description_callback() {
    ?>
        <h2 class="hownd-tab-toggler active"><?php echo __( 'Description', 'woocommerce' ); ?></h2>
        <div class="hownd-tab-content-wrapper"><?php the_content(); ?></div>
    <?php
}
function hownd_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );
    unset( $tabs['reviews'] );
    global $product;
    if(get_field( 'hownd_product_feeding_guide', $product->get_ID() )) {
        $tabs['feeding_guide'] = array(
            'title' => __( 'Feeding Guide', 'woocommerce' ),
            'priority' => 30,
            'callback' => 'hownd_feeding_guide_product_tab_content',
        );
    }
    if(get_field( 'hownd_product_how_to_use', $product->get_ID() )) {
        $tabs['how_to_use'] = array(
            'title' => __( 'How to Use', 'woocommerce' ),
            'priority' => 35,
            'callback' => 'hownd_how_to_use_product_tab_content',
        );
    }
    if(get_field( 'hownd_product_ingredients', $product->get_ID() )) {
        $tabs['ingredients'] = array(
            'title' => __( 'Ingredients', 'woocommerce' ),
            'priority' => 40,
            'callback' => 'hownd_ingredients_product_tab_content',
        );
    }
    if(get_field( 'hownd_product_video', $product->get_ID() )) {
        $tabs['video'] = array(
            'title' => __( 'Video', 'woocommerce' ),
            'priority' => 50,
            'callback' => 'hownd_video_product_tab_content',
        );
    }
    if(get_field( 'hownd_product_faqs', $product->get_ID() )) {
        $tabs['faqs'] = array(
            'title' => __( 'FAQs', 'woocommerce' ),
            'priority' => 45,
            'callback' => 'hownd_faqs_product_tab_content',
        );
    }
    $tabs[ 'description' ][ 'callback' ] = 'hownd_custom_description_callback';
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'hownd_product_tabs', 9999 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

//remove related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

//remove sidebar 
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
// function hownd_remove_sidebar_product_pages() {
//     if ( is_product() || is_shop() ) {
//         remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
//     }
// }
// add_action( 'wp', 'hownd_remove_sidebar_product_pages' );

/**
 * Remove WooCommerce breadcrumbs 
 */
function hownd_remove_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action( 'init', 'hownd_remove_breadcrumbs' );

//QUANTITY PLUS MINUS
function hownd_display_quantity_minus() {
    if ( ! is_product() ) return;
    echo '<span class="minus-btn">-</span>';
 }
 add_action( 'woocommerce_before_quantity_input_field', 'hownd_display_quantity_minus' );
 function hownd_display_quantity_plus() {
    if ( ! is_product() ) return;
    echo '<span class="plus-btn">+</span>';
 }
 add_action( 'woocommerce_after_quantity_input_field', 'hownd_display_quantity_plus' );

 //SUBSCRIPTION FREQUENCY
 function hownd_add_custom_subscription_interval( $subscription_intervals ) {
    $subscription_intervals['7'] = sprintf( __( 'every %s', 'woocommerce-subscriptions' ), WC_Subscriptions::append_numeral_suffix( 7 )  );
	$subscription_intervals['8'] = sprintf( __( 'every %s', 'woocommerce-subscriptions' ), WC_Subscriptions::append_numeral_suffix( 8 )  );
    $subscription_intervals['9'] = sprintf( __( 'every %s', 'woocommerce-subscriptions' ), WC_Subscriptions::append_numeral_suffix( 9 )  );
    $subscription_intervals['10'] = sprintf( __( 'every %s', 'woocommerce-subscriptions' ), WC_Subscriptions::append_numeral_suffix( 10 )  );
    $subscription_intervals['11'] = sprintf( __( 'every %s', 'woocommerce-subscriptions' ), WC_Subscriptions::append_numeral_suffix( 11 )  );
    $subscription_intervals['12'] = sprintf( __( 'every %s', 'woocommerce-subscriptions' ), WC_Subscriptions::append_numeral_suffix( 12 )  );

	return $subscription_intervals;
}
add_filter( 'woocommerce_subscription_period_interval_strings', 'hownd_add_custom_subscription_interval' );

//RECENTLY VIEWED PRODUCTS SHORTCODE
function hownd_track_product_view() {
    if ( ! is_singular( 'product' ) ) return;
    global $post;
    if ( empty( $_COOKIE['hownd_recently_viewed'] ) ) {
    $viewed_products = array();
    } else {
    $viewed_products = wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['hownd_recently_viewed'] ) ) );
    }
    $keys = array_flip( $viewed_products );
    if ( isset( $keys[ $post->ID ] ) ) {
        unset( $viewed_products[ $keys[ $post->ID ] ] );
    }
    $viewed_products[] = $post->ID;
    if ( count( $viewed_products ) > 15 ) {
        array_shift( $viewed_products );
    }
    wc_setcookie( 'hownd_recently_viewed', implode( '|', $viewed_products ) );
}
add_action( 'template_redirect', 'hownd_track_product_view', 9999 );

function hownd_recently_viewed_shortcode() {
    $viewed_products = ! empty( $_COOKIE['hownd_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['hownd_recently_viewed'] ) ) : array();
    $viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );
    if ( empty( $viewed_products ) ) return;
    $title = '<h3>Recently Viewed</h3>';
    $product_ids = implode( ",", $viewed_products );
    return '<div class="hownd-recently-viewed">'. $title . do_shortcode("[products ids='$product_ids' columns='4' limit='4']") . '</div>';
}
add_shortcode( 'recently_viewed_products', 'hownd_recently_viewed_shortcode' );


//cart counter
add_filter( 'woocommerce_add_to_cart_fragments', 'hownd_custom_cart_count_fragment' );
function hownd_custom_cart_count_fragment ($fragments ) {
    ob_start();
    $cart_count = WC()->cart->get_cart_contents_count();
    ?>
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
            <span class="count"><?php echo esc_html( $cart_count ); ?></span>
        </a>
    <?php
    $fragments['.header__cart-count'] = ob_get_clean();
    return $fragments;
}