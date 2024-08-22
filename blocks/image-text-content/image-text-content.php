<?php

/**
 * Image with Text Content Template.
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
*/

$image = get_field( 'hownd_itc_image' );
$image_position = get_field( 'hownd_itc_image_position' );
$hide_image_mobile = get_field( 'hownd_itc_hide_image_mobile' );
$bg = get_field( 'hownd_itc_bg_image' );
$bg_position = get_field( 'hownd_itc_bg_image_position' );
$style = '';
if($bg) {
    $style = 'background-image: url('.$bg.');background-position:'.$bg_position.';';
}
$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'wp-block-group hownd-itc alignfull',
        'id'    =>  isset($block['anchor']) ? $block['anchor'] : '',
        'style' => $style
    ]
);
?>
<?php if ( isset($block['data']['preview_image_text_content']) ) :
    echo '<img src="'. get_template_directory_uri() .'/assets/blocks-preview/image-text-content.jpg" style="width:100%; height:auto;">';
else : ?>

    <div <?php echo $wrapper_attributes; ?>>
        <div class="wp-block-group__inner-container">
            <div class="hownd-itc__row image--<?php echo $image_position; ?>">
                <div class="col-content">
                    <InnerBlocks />
                </div>
                <div class="col-image">
                    <div class="wrapper-image<?php echo $hide_image_mobile ? ' d-none d-md-block' : ''; ?>">
                        <?php echo wp_get_attachment_image( $image, 'large', "", ["class" => "image"] ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>