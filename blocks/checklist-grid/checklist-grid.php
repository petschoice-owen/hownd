<?php

/**
 * Checklist Grid Template.
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
*/

$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'hownd-checklist-grid',
        'id'    =>  isset($block['anchor']) ? $block['anchor'] : '',
    ]
);
?>
<?php if ( isset($block['data']['preview_image_checklist_grid']) ) :
    echo '<img src="'. get_template_directory_uri() .'/assets/blocks-preview/image-text-content.jpg" style="width:100%; height:auto;">';
else : ?>
    <?php if ( have_rows( 'hownd_checklist' ) ) : ?>
        <div <?php echo $wrapper_attributes; ?>>
            <?php while ( have_rows( 'hownd_checklist' ) ) : the_row(); ?>
                <div class="hownd-checklist-grid__item">
                    <img class="check-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-check.webp" alt="check" width="72" height="72">
                    <?php echo get_sub_field( 'title' ) ? '<h3 class="hownd-checklist-grid__title">'. get_sub_field( 'title' ) .'</h3>' : ''; ?>
                    <?php echo get_sub_field( 'text' ) ? '<div class="hownd-checklist-grid__text '. (get_sub_field( 'image' ) ? '' : 'mb-0') .'">'. get_sub_field( 'text' ) .'</div>' : ''; ?>
                    <?php if ( $image = get_sub_field( 'image' ) ) : ?>
                        <?php echo '<div class="hownd-checklist-grid__image">'. wp_get_attachment_image( $image, 'medium' ) . '</div>'; ?>
                    <?php endif ;?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>