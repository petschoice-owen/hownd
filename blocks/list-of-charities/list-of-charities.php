<?php

/**
 * List of Charities/Accreditations Template.
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
*/

$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'row hownd-list-charities',
        'id'    =>  isset($block['anchor']) ? $block['anchor'] : '',
    ]
);
?>
<?php if ( isset($block['data']['preview_image_checklist_grid']) ) :
    echo '<img src="'. get_template_directory_uri() .'/assets/blocks-preview/list-charities.jpg" style="width:100%; height:auto;">';
else : ?>
    <?php if ( have_rows( 'hownd_charities_list' ) ) : ?>
        <div <?php echo $wrapper_attributes; ?>>
            <?php while ( have_rows( 'hownd_charities_list' ) ) : the_row(); ?>
                <div class="col-12 col-md-6 col-xl-4 hownd-list-charities__col">
                    <?php
                        $link = get_sub_field( 'link' );
                        $image = get_sub_field( 'image' ) ? wp_get_attachment_image( get_sub_field( 'image' ), 'large' ) : '<img src="'.get_template_directory_uri().'/assets/images/img-default.png" alt="placeholder" />';
                        $title = get_sub_field( 'title' );
                        $text = get_sub_field( 'text' );
                    ?>
                    <?php if ( $link ) : 
                        $link_url = $link['url'];
                        $link_target = $link['target'] ? $link['target'] : '_self';    
                    ?>
                    <a href="<?php echo esc_url( $link_url ); ?>" class="hownd-list-charities__image <?php echo get_sub_field( 'image' ) ? '' : 'placeholder'; ?>" target="<?php echo esc_attr( $link_target ); ?>">
                    <?php else : ?>
                    <div class="hownd-list-charities__image <?php echo get_sub_field( 'image' ) ? '' : 'placeholder'; ?>">  
                    <?php endif; ?>  
                        <?php echo $image; ?>
                    <?php if ( $link ) : ?>
                    </a>
                    <?php else : ?>
                    </div>  
                    <?php endif; ?>  
                    <?php echo $title ? '<h3 class="hownd-list-charities__title">'.$title.'</h3>' : ''; ?>
                    <?php echo $text; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>