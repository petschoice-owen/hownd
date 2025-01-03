<?php
function hownd_include_products_in_search($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', array('post', 'page', 'product'));
    }
    return $query;
}
add_filter('pre_get_posts', 'hownd_include_products_in_search');
