<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/share.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// do_action( 'woocommerce_share' ); // Sharing plugins can hook into here.
?>
<div class="social-share">
    <a href="//www.facebook.com/sharer.php?u=<?php echo get_the_permalink(); ?>" class="fab fa-square-facebook" target="_blank"><span class="visually-hidden">Facebook</span></a>
    <a href="//twitter.com/share?text=<?php echo get_the_title(); ?>&amp;url=<?php echo get_the_permalink(); ?>" class="fab fa-square-x-twitter" target="_blank"><span class="visually-hidden">X/Twitter</span></a>
    <a href="//pinterest.com/pin/create/button/?url=<?php echo get_the_permalink(); ?>&amp;media=<?php echo get_the_post_thumbnail_url(); ?>&amp;description=<?php echo get_the_title(); ?>" class="fab fa-square-pinterest" target="_blank"><span class="visually-hidden">Pinterest</span></a>
</div>
