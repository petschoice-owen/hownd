<?php
// b2b
function hownd_get_quote_rules() {
    $args = array(
        'post_type'        => 'addify_rfq',
        'post_status'      => 'publish',
        'numberposts'      => -1,
        'orderby'          => 'menu_order',
        'order'            => 'ASC',
        'suppress_filters' => false,
    );
    return get_posts( $args );
}
function is_product_button_hidden( $product ) {
    $is_product_button_hidden = false;
    if ( 'variation' === $product->get_type() ) {
        $product_id = $product->get_parent_id();
        $product    = wc_get_product( $product_id );
    }
    $rules = hownd_get_quote_rules();
    foreach ( $rules as $rule ) {
        $afrfq_is_hide_price   = get_post_meta( intval( $rule->ID ), 'afrfq_is_hide_price', true );

        if ( 'yes' !== $afrfq_is_hide_price ) {
            continue;
        }
        if (class_exists( 'AF_R_F_Q_Main' )) {
            $b2bClass = new AF_R_F_Q_Main();
            if ( ! $b2bClass->afrfq_check_rule_for_product( $product->get_id(), $rule->ID ) ) {
                continue;
            }
        }

        $is_product_button_hidden = true;
    }
    return $is_product_button_hidden;
}

//hide add to cart button
function hownd_non_trade_hide_add_to_cart_button() {
    if ( is_product() ) {
        $product_id = get_the_ID();
        $product = wc_get_product($product_id);
        if (is_product_button_hidden( $product ) ) {
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
        }
    }
}
add_action( 'wp', 'hownd_non_trade_hide_add_to_cart_button' );