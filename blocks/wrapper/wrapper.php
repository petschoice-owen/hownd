<?php
/**
 * Wrapper Template.
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
*/

$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'hownd-wrapper mx-auto',
        'id'    =>  isset($block['anchor']) ? $block['anchor'] : '',
        'style' => 'max-width: ' .  get_field( 'hownd_wrapper_maximum_width') . 'px;'
    ]
);
?>
<?php
if ( isset($block['data']['preview_image_wrapper']) ) :
    echo '<img src="'. get_template_directory_uri() .'/assets/blocks-preview/preview-wrapper.png" style="width:100%; height:auto;">';
else :
?>
<div <?php echo $wrapper_attributes; ?>>
    <InnerBlocks />
</div>
<?php endif; ?>