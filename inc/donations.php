<?php
//create CPT for Donations
function hownd_donation_cpt() {
    $args = array(
        'label'             => __( 'Donation', 'hownd' ),
        'description'       => '',
        'menu_icon'         => 'dashicons-money-alt',
        'hierarchical'      => false,
        'has_archive'       => false,
        'supports'          => array('title', 'custom-fields'),
        'labels'            => array(
            'name'                => _x( 'Donations', 'Post Type General Name', 'hownd' ),
            'singular_name'       => _x( 'Donation', 'Post Type Singular Name', 'hownd' ),
            'menu_name'           => __( 'Donations', 'hownd' ),
            'parent_item_colon'   => __( 'Parent Donation', 'hownd' ),
            'all_items'           => __( 'All Donations', 'hownd' ),
            'view_item'           => __( 'View Donation', 'hownd' ),
            'add_new_item'        => __( 'Add New Donations', 'hownd' ),
            'add_new'             => __( 'Add New', 'hownd' ),
            'edit_item'           => __( 'Edit Donation', 'hownd' ),
            'update_item'         => __( 'Update Donation', 'hownd' ),
            'search_items'        => __( 'Search Donation', 'hownd' ),
            'not_found'           => __( 'Not Found', 'hownd' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'hownd' ),
        ),
        'capability_type'   => 'post',
        'public'            => false,
        'show_in_rest'      => true,
        'can_export'        => true,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menus' => false,
        'show_in_admin_bar' => true,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
    );
    register_post_type( 'donations', $args);
}
add_action( 'init', 'hownd_donation_cpt' );

//add custom column on admin
add_filter( 'manage_donations_posts_columns', 'hownd_set_custom_edit_donations_columns' );
function hownd_set_custom_edit_donations_columns( $columns ) {
    $columns['is_completed'] = __( 'Completed', 'hownd' );

    return $columns;
}

// Add the data to the custom columns for the donations post type:
add_action( 'manage_donations_posts_custom_column' , 'hownd_custom_donation_column', 10, 2 );
function hownd_custom_donation_column( $column, $post_id ) {
    switch ( $column ) {
        case 'is_completed' :
            echo get_post_meta( $post_id , 'is_donation_completed' , true ) ? 'Yes' : 'No'; 
            break;

    }
}

//donate form shortcode
function hownd_donate_form_func() {
    if(!is_user_logged_in()) return;
    $current_user = wp_get_current_user();
    ob_start();
    ?>
        <form id="howndDonateForm" action="">
            <input id="email" type="hidden" name="email" value="<?php echo $current_user->user_email; ?>">
            <button type="submit" class="btn-primary2 js-donate-submit"><?php echo __( 'Donate', 'hownd' ); ?></button>
            <div class="hownd-loader js-donate-loader mx-auto"></div>
        </form>
        <script>
            jQuery(document).ready(function($) {
                $('#howndDonateForm').on('submit', function(e) {
                    e.preventDefault();
                    var $user_email = $('#email').val();
                    $('.js-donate-submit').hide();
                    $('.js-donate-loader').show();

                    $.ajax({
                        url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
                        method: 'POST',
                        data: {
                            action: 'hownd_donate_reward',
                            user_email: $user_email
                        },
                        success: function(response) {
                            $('.js-donate-loader').hide();
                            if (response.success) {
                                $('#donatePopup').find('.popup__content').text(response.data);
                                setTimeout(() => {
                                    location.reload();
                                }, 300);
                            } else {
                                $('.js-donate-submit').show();
                                $('#donatePopup').find('.popup__content').append('<div class="mt-3 text-danger">Error: ' + response.data + '</div>');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $('.js-donate-loader').hide();
                            $('.js-donate-submit').show();
                            console.log(jqXHR.responseText); // Log error response
                            alert('AJAX error: ' + textStatus);
                        }
                    });
                });
            });
        </script>
    <?php
    return ob_get_clean();
}
add_shortcode( 'hownd_donate_form', 'hownd_donate_form_func' );

//deduct points to WP Loyalty via donate button
add_action('wp_ajax_nopriv_hownd_donate_reward', 'hownd_donate_reward');
add_action('wp_ajax_hownd_donate_reward', 'hownd_donate_reward');
function hownd_donate_reward() {
    $user_email = sanitize_email($_POST['user_email']);
    $points = 500;

    $consumer_key = 'ck_f8fd2434a2a2b1956516000936062f73f85ef6d9';
    $consumer_secret = 'cs_3a30536e4b8e78fd510bbdc82c557d038374cfe4';
    $site_url = home_url();

    // Data to send in the request
    $data = [
        'user_email' => $user_email,
        'points' => $points,
    ];

    // Initialize cURL
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $site_url . '/wp-json/wc/v3/wployalty/customers/points/reduce');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_USERPWD, $consumer_key . ':' . $consumer_secret);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute the request
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        wp_send_json_error('Error: ' . curl_error($ch));
    } else {
        // Handle response
        $response_data = json_decode($response, true);
        if (isset($response_data['success']) && $response_data['success']) {
            $post_id = wp_insert_post(array(
                'post_title' => $user_email,
                'post_type' => 'donations',
                'post_status' => 'publish'
            ));
            if( !is_wp_error($post_id) ) {
                wp_send_json_success('You have successfully donated to All Dogs Matter!');
            } else {
                wp_send_json_error($post_id->get_error_message());
            }
        } else {
            wp_send_json_error('Failed to deduct points: ' . $response_data['message']);
        }
    }

    // Close cURL
    curl_close($ch);

    // Always die in the end
    wp_die();
}

