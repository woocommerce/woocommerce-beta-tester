<?php
/**
 * Missing WooCommerce notice.
 *
 * @package WC_Beta_Tester\Admin\Views
 */

defined( 'ABSPATH' ) || exit;

$is_installed = false;

if ( function_exists( 'get_plugins' ) ) {
	$all_plugins  = get_plugins();
	$is_installed = ! empty( $all_plugins['woocommerce/woocommerce.php'] );
}

?>

<div class="notice notice-error">
	<p>
		<?php
		// Translators: %s Plugin name.
		echo sprintf( esc_html__( '%s requires WooCommerce to be installed and activated in order to serve updates.', 'woocommerce-beta-tester' ), '<strong>' . esc_html__( 'WooCommerce Beta Tester', 'woocommerce-beta-tester' ) . '</strong>' );
		?>
	</p>

	<?php if ( $is_installed && current_user_can( 'activate_plugin', 'woocommerce/woocommerce.php' ) ) : ?>
		<p>
			<a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'plugins.php?action=activate&plugin=woocommerce/woocommerce.php&plugin_status=active' ), 'activate-plugin_woocommerce/woocommerce.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Activate WooCommerce', 'woocommerce-beta-tester' ); ?></a>
			<?php if ( current_user_can( 'deactivate_plugin', 'woocommerce-beta-tester/woocommerce-beta-tester.php' ) ) : ?>
				<a href="<?php echo esc_url( wp_nonce_url( 'plugins.php?action=deactivate&plugin=woocommerce-beta-tester/woocommerce-beta-tester.php&plugin_status=inactive', 'deactivate-plugin_woocommerce-beta-tester/woocommerce-beta-tester.php' ) ); ?>" class="button button-secondary"><?php esc_html_e( 'Turn off Beta Tester plugin', 'woocommerce-beta-tester' ); ?></a>
			<?php endif; ?>
		</p>
	<?php else : ?>
		<?php
		if ( current_user_can( 'install_plugins' ) ) {
			$url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' );
		} else {
			$url = 'http://wordpress.org/plugins/woocommerce/';
		}
		?>
		<p>
			<a href="<?php echo esc_url( $url ); ?>" class="button button-primary"><?php esc_html_e( 'Install WooCommerce', 'woocommerce-beta-tester' ); ?></a>
			<?php if ( current_user_can( 'deactivate_plugin', 'woocommerce-beta-tester/woocommerce-beta-tester.php' ) ) : ?>
				<a href="<?php echo esc_url( wp_nonce_url( 'plugins.php?action=deactivate&plugin=woocommerce-beta-tester/woocommerce-beta-tester.php&plugin_status=inactive', 'deactivate-plugin_woocommerce-beta-tester/woocommerce-beta-tester.php' ) ); ?>" class="button button-secondary"><?php esc_html_e( 'Turn off Beta Tester plugin', 'woocommerce-beta-tester' ); ?></a>
			<?php endif; ?>
		</p>
	<?php endif; ?>
</div>
