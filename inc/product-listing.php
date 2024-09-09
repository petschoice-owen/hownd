<?php
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

//SHOP FILTER
function hownd_shop_filter() {
    if (is_shop() || is_product_category()) {
        $current_per_page = get_query_var('products_per_page', 12); // Default to 12 if not set
        $per_page_options = array(12, 24, 36);
        echo '<div class="shop-actions">';
            echo '<div class="shop-actions__filter">';
                echo '<a href="#flyoutRange" class="js-filter-trigger">Filter <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="icon" viewBox="0 0 24 24">
                    <path d="M7 10l5 5 5-5z" fill="#757575"></path>
                    <path d="M0 0h24v24H0z" fill="none"></path>
                    </svg></a>';
                echo '<a href="#flyoutSort" class="js-filter-trigger">Sort <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="icon" viewBox="0 0 24 24">
                    <path d="M7 10l5 5 5-5z" fill="#757575"></path>
                    <path d="M0 0h24v24H0z" fill="none"></path>
                    </svg></a>';
            echo '</div>';
            echo '<div class="shop-actions__view"><span>Show</span>';
            foreach ($per_page_options as $option) {
                $class = ($current_per_page == $option) ? 'active' : '';
                echo '<a href="' . esc_url(add_query_arg('products_per_page', $option)) . '" class="' . esc_attr($class) . '">' . esc_html($option) . '</a>';
            }
            echo '</div>';
        echo '</div>';
        echo get_template_part( 'partials/filter-flyout' );
    }
}
add_action( 'woocommerce_before_shop_loop', 'hownd_shop_filter', 30 );

function hownd_products_per_page_query($query) {
    if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category())) {
        $products_per_page = get_query_var('products_per_page');
        if ($products_per_page) {
            $query->set('posts_per_page', intval($products_per_page));
        } else {
            $query->set('posts_per_page', 12);
        }
    }
}
add_action( 'pre_get_posts', 'hownd_products_per_page_query' );

function hownd_add_query_vars_filter($vars) {
    $vars[] = 'products_per_page';
    return $vars;
}
add_filter( 'query_vars', 'hownd_add_query_vars_filter' );

// Customize 'Add to Cart' button for variable products on the shop page
function hownd_add_to_cart_button_products() {
    global $product;

    if ( $product->is_type( 'variable' ) ) {
        $product_id = $product->get_id();
        $variations = $product->get_available_variations();

        if ( ! empty( $variations ) ) {
            $first_variation_id = $variations[0]['variation_id'];

            // Ensure the first variation is in stock
            if ( $product->get_child( $first_variation_id )->is_in_stock() ) {
                echo '<a href="#" class="button add_to_cart_button" data-product_id="' . esc_attr( $product_id ) . '" data-variation_id="' . esc_attr( $first_variation_id ) . '">Add to Cart</a>';
            } else {
                echo '<a href="' . esc_url( $product->get_permalink() ) . '" class="button">View Product</a>';
            }
        }
    } else {
        if( $product->is_in_stock() ) {
            echo '<a href="#" class="button add_to_cart_button" data-product_id="' . esc_attr( $product->get_id() ) . '">Add to Cart</a>';
        }
    }
}
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

//ADD Back soon badge
add_action( 'woocommerce_before_shop_loop_item_title', function() {
    global $product;
    if( !$product->is_in_stock() ) {
        echo '<div class="badge-backsoon">Back Soon</div>';
    }
}, 10 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', function(){
    echo '<div class="image-wrapper">';
}, 1 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );
add_action( 'woocommerce_before_shop_loop_item_title', function(){
    echo hownd_add_to_cart_button_products();
    echo '</div>';
}, 20 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );


//PAGINATION
function hownd_woocommerce_pagination_args( $args ) {
    $args['prev_text'] = __( 'Previous', 'woocommerce' );
    $args['next_text'] = __( 'Next', 'woocommerce' );

    return $args;
}
add_filter( 'woocommerce_pagination_args', 'hownd_woocommerce_pagination_args' );