<?php
namespace CustomTheme\Blocks;

/**
 * Load Blocks
 */
function load_blocks() {
	$theme  = wp_get_theme();
	$blocks = get_blocks();
	$version = '1';
	foreach( $blocks as $block ) {
		if ( file_exists( get_template_directory() . '/blocks/' . $block . '/block.json' ) ) {
			register_block_type( get_template_directory() . '/blocks/' . $block . '/block.json' );
			if ( file_exists( get_template_directory() . '/blocks/' . $block . '/style.min.css' ) ) {
				wp_register_style( 'block-' . $block, get_template_directory_uri() . '/blocks/' . $block . '/style.min.css', array(), $version );
				add_action( 'wp_enqueue_scripts', function() use ($block) {
					wp_enqueue_style( 'block-' . $block );
				}, 5 );
			}
			if ( file_exists( get_template_directory() . '/blocks/' . $block . '/script.js' ) ) {
				wp_register_script( 'block-' . $block, get_template_directory_uri() . '/blocks/' . $block . '/script.js', array(), $version, array(
					'strategy'  => 'defer',
					'in_footer' => true
				) );
			}
		}
	}
}
add_action( 'init', __NAMESPACE__ . '\load_blocks', 5 );

/**
 * Load ACF field groups for blocks
 */
function load_acf_field_group( $paths ) {
	$blocks = get_blocks();
	foreach( $blocks as $block ) {
		$paths[] = get_template_directory() . '/blocks/' . $block;
	}
	return $paths;
}
add_filter( 'acf/settings/load_json', __NAMESPACE__ . '\load_acf_field_group' );

/**
 * Get Blocks
 */
function get_blocks() {
    $blocks = scandir( get_template_directory() . '/blocks/' );
    $blocks = array_values( array_diff( $blocks, array( '..', '.', '.DS_Store', '_base-block' ) ) );
	return $blocks;
}

/**
 * Block categories
 *
 */
function block_categories( $categories ) {
	$include = true;
	foreach( $categories as $category ) {
		if( 'hownd-blocks' === $category['slug'] ) {
			$include = false;
		}
	}

	if( $include ) {
        // Prepend custom category to appear first
        array_unshift($categories, array(
            'slug'  => 'hownd-blocks',
			'title' => 'Hownd'
        ));
    }

	return $categories;
}
add_filter( 'block_categories_all', __NAMESPACE__ . '\block_categories' );
add_filter( 'should_load_separate_core_block_assets', '__return_true' );


add_action('init', function() {
	register_block_style('acf/hownd-tc-first-col',
		[
			'name' => 'align-center',
			'label' => __('Align Center', 'hownd'),
		]
	);

	register_block_style('acf/hownd-tc-second-col',
		[
			'name' => 'align-center',
			'label' => __('Align Center', 'hownd'),
		]
	);

	register_block_style('acf/hownd-tc-third-col',
		[
			'name' => 'align-center',
			'label' => __('Align Center', 'hownd'),
		]
	);

	register_block_style('acf/hownd-wrapper',
		[
			'name' => 'with-padding',
			'label' => __('With Padding', 'hownd'),
		]
	);

	register_block_style('core/list',
		[
			'name' => 'paws',
			'label' => __('Paws', 'hownd'),
		]
	);

	register_block_style('core/button',
		[
			'name' => 'paws-link',
			'label' => __('Link with Paws', 'hownd'),
		]
	);
});