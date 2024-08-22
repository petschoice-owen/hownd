<?php
/**
 * Three Column Template.
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
*/

$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'hownd-three-col',
        'id'    =>  isset($block['anchor']) ? $block['anchor'] : '',
    ]
);
$allowed_blocks = array( 'acf/hownd-tc-first-col', 'acf/hownd-tc-second-col', 'acf/hownd-tc-third-col' );
$template = array(
	array( 'acf/hownd-tc-first-col', array() ),
    array( 'acf/hownd-tc-second-col', array() ),
    array( 'acf/hownd-tc-third-col', array() )
);
?>
<?php
if ( isset($block['data']['preview_image_three_col']) ) :
    echo '<img src="'. get_template_directory_uri() .'/assets/images/blocks-preview/preview-three-column.png" style="width:100%; height:auto;">';
else :
?>
    <div <?php echo $wrapper_attributes; ?>>
        <InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" template="<?php echo esc_attr( wp_json_encode( $template ) ); ?>" templateLock="all" />
    </div>
<?php endif; ?>