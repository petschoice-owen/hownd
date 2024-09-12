<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

?>
<div class="hownd-login-form">
	<form class="woocommerce-form woocommerce-form-login login" method="post" <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?>>
		<h1>Login</h1>
		<?php do_action( 'woocommerce_login_form_start' ); ?>

		<?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?>

		<p class="form-row form-row-first">
			<label for="username"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span></label>
			<input type="text" class="input-text" name="username" id="username" autocomplete="username" required aria-required="true" placeholder="Email" />
		</p>
		<p class="form-row form-row-last">
			<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span></label>
			<input class="input-text woocommerce-Input" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true" placeholder="Password" />
		</p>
		<div class="clear"></div>

		<?php do_action( 'woocommerce_login_form' ); ?>

		<p class="form-row">
			<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
			<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ); ?>" />
			<button type="submit" class="btn-primary2 woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Sign In', 'woocommerce' ); ?>"><?php esc_html_e( 'Sign In', 'woocommerce' ); ?></button>
		</p>
		<p class="form-row">
			<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
				<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
			</label>
		</p>
		<p class="lost_password">
			<a href="<?php echo wc_get_page_permalink( 'myaccount' ) . '/register'; ?>">Create account</a> / <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
		</p>

		<div class="clear"></div>

		<?php do_action( 'woocommerce_login_form_end' ); ?>

	</form>
</div>
