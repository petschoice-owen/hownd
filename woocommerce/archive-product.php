<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
do_action( 'woocommerce_shop_loop_header' );

if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

$category_id = get_queried_object()->term_id;
$template = get_field( 'hownd_pc_template', 'product_cat_'.$category_id );
if( is_tax( 'product_cat' ) && 'template1' === $template ) {
	?>
	<?php if ( have_rows( 'hownd_pc_checklist_section', 'product_cat_'.$category_id ) ) : ?>
		<?php while ( have_rows( 'hownd_pc_checklist_section', 'product_cat_'.$category_id ) ) : the_row(); ?>
			<div class="wp-block-group pc-checklist-section alignfull">
				<div class="container">
					<div class="row">
						<div class="col-lg-4">
							<?php echo get_sub_field( 'heading' ) ? '<h2 class="heading">'.get_sub_field( 'heading' ).'</h2>' : ''; ?>
							<?php echo get_sub_field( 'content' ); ?>
						</div>
						<div class="col-lg-8">
							<?php if ( have_rows( 'list' ) ) : ?>
								<div class="row">
									<?php while ( have_rows( 'list' ) ) : the_row(); ?>
										<div class="col-md-6 list-item">
											<img class="check-icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-check.webp" alt="check" width="72" height="72">
											<?php echo get_sub_field( 'title' ) ? '<h3 class="title">'. get_sub_field( 'title' ) .'</h3>' : ''; ?>
											<?php echo get_sub_field( 'text' ) ? '<div class="text">'. get_sub_field( 'text' ) .'</div>' : ''; ?>
										</div>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="small-text"><?php echo get_sub_field( 'bottom_text' ); ?></div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
	<?php if ( have_rows( 'hownd_pc_customer_review_section', 'product_cat_'.$category_id ) ) : ?>
		<?php while ( have_rows( 'hownd_pc_customer_review_section', 'product_cat_'.$category_id ) ) : the_row(); ?>
			<div class="wp-block-group pc-review-section alignfull">
				<div class="container">
					<div class="row">
						<div class="col-md-6 pc-review-section__content">
							<?php echo get_sub_field( 'content' ); ?>
						</div>
						<div class="col-md-6">
							<?php if ( get_sub_field( 'image' ) ) : ?>
							<div class="pc-review-section__image">
								<?php echo wp_get_attachment_image( get_sub_field( 'image' ), 'large' ); ?>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
	<?php if ( have_rows( 'hownd_pc_feeding_guide_section', 'product_cat_'.$category_id ) ) : ?>
		<?php while ( have_rows( 'hownd_pc_feeding_guide_section', 'product_cat_'.$category_id ) ) : the_row(); ?>
			<div class="wp-block-group pc-feeding-guide-section alignfull">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<?php echo get_sub_field( 'heading' ) ? '<h2>'. get_sub_field( 'heading' ) .'</h2>' : ''; ?>
							<div class="difference">
								<div class="item">
									<?php echo wp_get_attachment_image( get_sub_field( 'current_image' ), 'medium' ); ?>
									<div class="text"><?php echo get_sub_field( 'current_label' ); ?></div>
								</div>
								<div class="item">
									<?php echo wp_get_attachment_image( get_sub_field( 'hownd_image' ), 'medium' ); ?>
									<div class="text"><?php echo get_sub_field( 'hownd_label' ); ?></div>
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<?php if ( have_rows( 'list' ) ) : ?>
								<div class="row feeding-list">
									<?php while ( have_rows( 'list' ) ) : the_row(); ?>
										<div class="col-6 col-md-3 feeding-list__item">
											<?php echo wp_get_attachment_image( get_sub_field( 'image' ), 'medium' ); ?>
											<?php echo get_sub_field( 'text' ) ? '<h3 class="title">'. get_sub_field( 'text' ) .'</h3>' : ''; ?>
											<?php echo get_sub_field( 'subtext' ) ? '<div class="text">'. get_sub_field( 'subtext' ) .'</div>' : ''; ?>
										</div>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="bottom-text"><?php echo get_sub_field( 'bottom_text' ); ?></div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
	<div class="pt-4 text-center">
		<a href="#" class="btn-primary text-white js-scrolltop"><?php echo __( 'Back to Top', 'hownd' ); ?></a>
	</div>
	<?php
} else {
	echo do_shortcode( '[recently_viewed_products]' );
}
get_footer( 'shop' );
	