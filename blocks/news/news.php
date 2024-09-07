<?php

/**
 * News Template.
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
*/

$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'hownd-news',
        'id'    =>  isset($block['anchor']) ? $block['anchor'] : ''
    ]
);
?>
<?php if ( isset($block['data']['preview_news']) ) :
    echo '<img src="'. get_template_directory_uri() .'/assets/blocks-preview/news.jpg" style="width:100%; height:auto;">';
else : ?>
    <?php if ( have_rows('hownd_news') ) : ?>
        <div <?php echo $wrapper_attributes; ?>>
            <div class="news-wrapper">
                <?php while( have_rows('hownd_news') ): the_row(); 
                    $image = get_sub_field( 'hownd_news_image' );
                    ?>
                    <div class="item">
                        <div class="wrapper">
                            <?php if( have_rows('description') ): ?>
                                <?php while( have_rows('description') ): the_row(); ?>
                                    <?php if( get_sub_field('hownd_news_link') ): ?>
                                        <a href="<?php echo get_sub_field( 'hownd_news_link' ); ?>" class="news-link" target="_blank">
                                            <img src="<?php echo $image; ?>" class="news-image" alt="<?php echo get_sub_field( 'hownd_news_title' ); ?>" />
                                        </a>
                                    <?php else: ?>
                                        <div class="news-image-wrapper">
                                            <img src="<?php echo $image; ?>" class="news-image" alt="<?php echo get_sub_field( 'hownd_news_title' ); ?>" />
                                        </div>
                                    <?php endif; ?>
                                    <p class="news-title"><?php echo get_sub_field( 'hownd_news_title' ); ?></p>
                                        <p class="news-description"><?php echo get_sub_field( 'hownd_news_description' ); ?></p>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>