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
    if(get_field( 'hownd_product_faqs', $product->get_ID() )) {
        $tabs['faqs'] = array(
            'title' => __( 'FAQs', 'woocommerce' ),
            'priority' => 45,
            'callback' => 'hownd_faqs_product_tab_content',
        );
    }
    if(get_field( 'hownd_product_video', $product->get_ID() )) {
        $tabs['video'] = array(
            'title' => __( 'Video', 'woocommerce' ),
            'priority' => 50,
            'callback' => 'hownd_video_product_tab_content',
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

//remove sidebar on product page
function hownd_remove_sidebar_product_pages() {
    if ( is_product() ) {
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
    }
}
add_action( 'wp', 'hownd_remove_sidebar_product_pages' );

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