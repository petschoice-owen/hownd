<?php

/**
 * Banner Template.
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
*/

$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'hownd-banner alignfull',
        'id'    =>  isset($block['anchor']) ? $block['anchor'] : ''
    ]
);
$bg = get_field( 'hownd_banner_bg' );
$bg_position = get_field( 'hownd_banner_bg_position' );
$has_overlay = get_field( 'hownd_add_overlay' );
$overlay = get_field( 'hownd_banner_overlay' );
?>
<?php if ( isset($block['data']['preview_banner']) ) :
    echo '<img src="'. get_template_directory_uri() .'/assets/blocks-preview/banner.jpg" style="width:100%; height:auto;">';
else : ?>
    <div <?php echo $wrapper_attributes; ?>>
        <InnerBlocks />
        <?php
            if( $bg ) :
                $pos = 'object-position: '.$bg_position;
                echo wp_get_attachment_image( $bg, 'full', "", ["class" => "hownd-banner__bg", "style" => $pos] );
            endif;
            if( $has_overlay && $overlay ) :
                echo '<div class="hownd-banner__overlay" style="background-color: '.$overlay.';"></div>';
            endif;
        ?>
    </div>
<?php endif; ?>