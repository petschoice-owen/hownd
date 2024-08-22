<?php
/**
 * Three Column: First Column.
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
*/

$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'hownd-three-col__column'
    ]
);
$template = array(
	array('core/paragraph', array())
);
?>
<div <?php echo $wrapper_attributes; ?>>
    <InnerBlocks template="<?php echo esc_attr( wp_json_encode( $template ) ); ?>" templateLock="false" />
</div>