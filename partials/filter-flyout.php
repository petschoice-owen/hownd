<?php
// Get sorting options
$catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
    'menu_order' => __( 'Featured', 'woocommerce' ),
    'price'      => __( 'Price: Low to High', 'woocommerce' ),
    'price-desc' => __( 'Price: High to Low', 'woocommerce' ),
    'title'       => __( 'A-Z', 'woocommerce' ),
    'title-desc'  => __( 'Z-A', 'woocommerce' ),
    'date'        => __( 'Oldest to Newest', 'woocommerce' ),
    'date-desc'   => __( 'Newest to Oldest', 'woocommerce' ),
    'popularity' => __( 'Best Selling', 'woocommerce' ),
) );

// Get the current orderby
$current_orderby = isset( $_GET['orderby'] ) ? $_GET['orderby'] : '';
?>

<div id="flyoutSort" class="filter-flyout">
    <div class="filter-flyout__header">
        <h4><?php echo __( 'Sort', 'hownd' ); ?></h4>
        <a href="#" class="filter-flyout__close fa fa-close"></a>
    </div>
    <div class="filter-flyout__filters">
        <form action="" id="filterSort">
            <?php
             foreach ( $catalog_orderby_options as $id => $name ) {
                $checked = ( $current_orderby === $id ) ? 'checked' : '';
                echo '<div class="form-check-wrapper">';
                echo '<input id="' . esc_attr( $id ) . '" type="radio" name="orderby" value="' . esc_attr( $id ) . '" ' . $checked . '>';
                echo '<label for="' . esc_attr( $id ) . '">' . esc_html( $name ) . '</label>';
                echo '</div>';
            }
            ?>
        </form>
    </div>
    <div class="filter-flyout__bottom">
        <button class="btn-primary" type="submit" form="filterSort" value="Apply"><?php echo __( 'Apply', 'hownd' ) ?></button>
    </div>
</div>

<?php
if (is_shop() || is_product_category()) {
    // Get all products in this category
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
    );
    if(is_product_category()) {
        // Get the current category
        $current_category = get_queried_object();
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $current_category->term_id,
            )
        );
    }
    $query = new WP_Query($args);

    // Array to hold all tags
    $tags = array();

    // Loop through products
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_ID());

            // Get tag slugs for this product
            $product_tags = get_the_terms(get_the_ID(), 'product_tag');

            if (!empty($product_tags) && !is_wp_error($product_tags)) {
                foreach ($product_tags as $tag) {
                    // Filter tags where slug starts with 'Range_'
                    if (strpos($tag->slug, 'range_') === 0) {
                        $tags[] = $tag;
                    }
                }
            }
        }
        wp_reset_postdata();
    }

    // Remove duplicate tags
    $tags = array_unique($tags, SORT_REGULAR);
    usort($tags, function($a, $b) {
        $display_name_a = str_replace('Range_', '', $a->name);
        $display_name_b = str_replace('Range_', '', $b->name);
        return strcmp($display_name_a, $display_name_b);
    });

    // Display tags
    if (!empty($tags)) {
        $product_tags = isset( $_GET['product_tag'] ) ? $_GET['product_tag'] : '';
        $decoded_tags = str_replace(' ', '+', $product_tags);
        $current_tags = explode('+', $decoded_tags);
    ?>
        <div id="flyoutRange" class="filter-flyout">
            <div class="filter-flyout__header">
                <h4><?php echo __( 'Range', 'hownd' ); ?></h4>
                <a href="#" class="filter-flyout__close fa fa-close"></a>
            </div>
            <div class="filter-flyout__filters">
                <form action="" id="filterRange">
                    <?php
                    foreach ( $tags as $tag ) {
                        $checked = ( in_array($tag->slug, $current_tags) ) ? 'checked' : '';
                        $display_name = str_replace('Range_', '', $tag->name);
                        echo '<div class="form-check-wrapper">';
                        echo '<input id="' . esc_attr( $tag->slug ) . '" type="checkbox" name="product_tag" value="' . esc_attr( $tag->slug ) . '" ' . $checked . '>';
                        echo '<label for="' . esc_attr( $tag->slug ) . '">' . esc_html( $display_name ) . '</label>';
                        echo '</div>';
                    }
                    ?>
                </form>
            </div>
            <div class="filter-flyout__bottom">
                <button class="btn-primary" type="submit" form="filterRange" value="Apply"><?php echo __( 'Apply', 'hownd' ) ?></button>
            </div>
        </div>
    <?php
    }
}
?>