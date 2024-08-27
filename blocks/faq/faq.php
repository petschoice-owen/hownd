<?php

/**
 * FAQ Template.
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
*/

$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'hownd-faq',
        'id'    =>  isset($block['anchor']) ? $block['anchor'] : ''
    ]
);
?>
<?php if ( isset($block['data']['preview_faq']) ) :
    echo '<img src="'. get_template_directory_uri() .'/assets/blocks-preview/faq.jpg" style="width:100%; height:auto;">';
else : ?>
    <?php if ( have_rows( 'hownd_faq_accordion_groups' ) ) : $counter = 1; ?>
        <div <?php echo $wrapper_attributes; ?>>
            <?php if( get_field( 'hownd_faq_show_sidebar' ) ) : ?>
                <div class="hownd-faq__sidebar d-none d-xl-block">
                    <h4 class="hownd-faq__sidebar-title"><?php echo __( 'Categories', 'hownd' ); ?></h4>
                    <ul class="list-unstyled">
                        <?php while ( have_rows( 'hownd_faq_accordion_groups' ) ) : the_row();?>
                            <li><a href="<?php echo '#' . $block['id'] . '-faq-' .get_row_index(); ?>"><?php echo get_sub_field( 'heading' ); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if( get_field( 'hownd_faq_show_search' ) ) : ?>
                <div class="hownd-faq__search">
                    <input type="text" name="accordion-list" class="hownd-faq__search-input js-faq-search" placeholder="<?php echo __( 'Start typing...', 'hownd' ); ?>" />
                    <span class="hownd-faq__search-icon">
                        <svg width="16px" height="15px" viewBox="0 0 16 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Toolkit" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="UI2.0_Toolkit" transform="translate(-1169.000000, -132.000000)" stroke="#000000" stroke-width="1.8">
                                    <g id="Group-7" transform="translate(1170.000000, 133.000000)">
                                        <g id="Group">
                                            <circle id="Oval" cx="5.5" cy="5.5" r="5.5"></circle>
                                            <line x1="10" y1="9" x2="14" y2="13" id="Path-7"></line>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </span>
                </div>
            <?php endif; ?>
            <div class="hownd-faq__groups">
                <?php while ( have_rows( 'hownd_faq_accordion_groups' ) ) : the_row(); ?>
                    <div class="hownd-faq__group">
                        <?php echo get_sub_field( 'heading' ) ? '<h4 id="'.$block['id'].'-cat-'.get_row_index().'" class="hownd-faq__group-title">'. get_sub_field( 'heading' ) .'</h4>' : ''; ?>
                        <?php if ( have_rows( 'list' ) ) : ?>
                            <?php while ( have_rows( 'list' ) ) : the_row(); ?>
                                <div class="hownd-faq__item">
                                    <div id="faq-<?php echo $counter; ?>" class="hownd-faq__item-header" data-bs-toggle="collapse" data-bs-target="#faq-content-<?php echo $counter; ?>" aria-expanded="false">
                                        <?php echo get_sub_field( 'title' ); ?>
                                        <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M17.409 8.929h-6.695V2.258c0-.566-.506-1.029-1.071-1.029s-1.071.463-1.071 1.029v6.671H1.967C1.401 8.929.938 9.435.938 10s.463 1.071 1.029 1.071h6.605V17.7c0 .566.506 1.029 1.071 1.029s1.071-.463 1.071-1.029v-6.629h6.695c.566 0 1.029-.506 1.029-1.071s-.463-1.071-1.029-1.071z"></path></svg></span>
                                    </div>
                                    <div id="faq-content-<?php echo $counter; ?>" class="collapse">
                                        <div class="hownd-faq__item-content">
                                            <?php echo get_sub_field( 'content' ); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php $counter++; endwhile; ?>
                        <?php endif; ?>
                        <?php if ( get_sub_field( 'text' ) || get_sub_field( 'button' ) ) : ?>
                            <div class="hownd-faq__group-content">
                                <?php echo get_sub_field( 'text' ); ?>
                                <?php 
                                $link = get_sub_field( 'button' );
                                if( $link ): 
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                    <a class="btn-primary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <?php if( get_field( 'hownd_faq_show_search' ) ) : ?>
            <?php
                $faq_items = [];
                $faq_counter = 1;
                while ( have_rows( 'hownd_faq_accordion_groups' ) ) : the_row();
                    if ( have_rows( 'list' ) ) :
                        while ( have_rows( 'list' ) ) : the_row();
                            $text = strip_tags(get_sub_field( 'content' ));
                            $text = str_replace(array("\r", "\n"), ' ', $text);
                            $text = str_replace('"', '&apos;', $text);
                            $faq_items[] = array(
                                'value'     => get_sub_field( 'title' ),
                                'content'   => $text,
                                'data'      => 'faq-'.$faq_counter
                            );
                            $faq_counter++;
                        endwhile;
                    endif;
                endwhile;
            ?>
            <script type="text/javascript">
                jQuery(function($) {
                    var faq_items = <?php echo json_encode($faq_items); ?>;

                    if (typeof faq_items != "undefined") {
                        $(".js-faq-search").autocomplete({
                            lookup: faq_items,
                            lookupFilter: function(suggestion, query, queryLowerCase) {
                                var content = suggestion.content.toLowerCase(),
                                    value = suggestion.value.toLowerCase();
                    
                                return (
                                    content.indexOf(queryLowerCase) > -1 ||
                                    value.indexOf(queryLowerCase) > -1
                                );
                            },
                            onSelect: function(suggestion) {
                                //check if sticky header and set correct offset
                                if ($(".header").hasClass("fixed-header")) {
                                    scrollOffset = $(".header").outerHeight() + 18;
                                } else {
                                    scrollOffset = 117;
                                }
                                //scroll
                                $("html,body").animate(
                                    {
                                    scrollTop:
                                        $(".hownd-faq")
                                        .find("#" + suggestion.data ).offset().top - scrollOffset
                                    },
                                    800
                                );
                        
                                setTimeout(function() {
                                    if($("#" + suggestion.data).attr('aria-expanded') === 'false') {
                                        $("#" + suggestion.data).trigger('click');
                                    }
                                }, 800);
                        
                                $(this).val('');
                            }
                        });
                    }
                });
            </script>
        <?php endif; ?>
        <?php if( get_field( 'hownd_faq_show_sidebar' ) ) : ?>
            <script type="text/javascript">
                jQuery(function($) {
                    var $sidebar = $('.hownd-faq__sidebar');
                    var $container = $('.hownd-faq');
                    var $header = $('.header');
                    var headerHeight = $header.outerHeight();

                    $(window).on('scroll', function() {
                        var containerTop = $container.offset().top - headerHeight;
                        var containerBottom = $container.offset().top + $container.outerHeight() - headerHeight;
                        var sidebarHeight = $sidebar.outerHeight();
                        var scrollTop = $(window).scrollTop();
                        if (scrollTop + headerHeight + sidebarHeight > containerBottom) {
                            $sidebar.css({
                                'position': 'absolute',
                                'top': containerBottom - sidebarHeight - headerHeight
                            });
                        } else if (scrollTop < containerTop) {
                            $sidebar.css({
                                'position': 'absolute',
                                'top': 0
                            });
                        } else {
                            $sidebar.css({
                                'position': 'fixed',
                                'top': 120
                            });
                        }
                    });
                });

            </script>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>