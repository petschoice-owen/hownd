<?php
/**
 * Product taxonomy archive header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !is_tax() ) return;

$category_id = get_queried_object()->term_id;
$category = get_term_by('id', $category_id, 'product_cat');
$thumbnail_id = get_woocommerce_term_meta( $category_id, 'thumbnail_id', true );
$image = wp_get_attachment_image( $thumbnail_id, 'large' );
if (($category && !empty($category->description)) || $image) :
?>
    <div class="product-tax-header">
        <?php if ( !empty($category->description) ) : ?>
            <div class="product-tax-header__text">
                <div class="term-description">
                    <?php the_archive_description();
                    /**
                     * Hook: woocommerce_archive_description.
                     *
                     * @since 1.6.2.
                     * @hooked woocommerce_taxonomy_archive_description - 10
                     * @hooked woocommerce_product_archive_description - 10
                     */
                    // do_action( 'woocommerce_archive_description' );
                    ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if ( !empty($image) ) : ?>
            <div class="product-tax-header__image">
                <?php echo $image; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>