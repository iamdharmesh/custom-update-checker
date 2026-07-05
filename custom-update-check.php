<?php
/**
 * Plugin Name:       Custom Update Check
 * Plugin URI:        https://github.com/iamdharmesh/custom-update-checker
 * Description:       Demo plugin for self-hosted updates via GitHub Releases and Plugin Update Checker.
 * Version:           0.1.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            iamdharmesh
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       custom-update-check
 * Update URI:        https://github.com/iamdharmesh/custom-update-checker
 *
 * @package CustomUpdateCheck
 */

defined( 'ABSPATH' ) || exit;

/*
 * wp.org transition release:
 * 1. Remove the Update URI header and the entire PUC block below.
 * 2. Bump Version to a number higher than the last self-hosted release
 *    (e.g. 1.0.0 → 1.0.1 if 1.0.0 was the final GitHub release).
 * 3. Publish that version via WordPress.org SVN; wp.org will take over updates.
 */

require_once __DIR__ . '/vendor/autoload.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$custom_update_check_updater = PucFactory::buildUpdateChecker(
	'https://github.com/iamdharmesh/custom-update-checker/',
	__FILE__,
	'custom-update-check'
);
$custom_update_check_updater->getVcsApi()->enableReleaseAssets( '/^custom-update-check\.zip$/' );

/**
 * Display plugin version in admin to confirm activation.
 */
function custom_update_check_admin_notice() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	printf(
		'<div class="notice notice-info"><p>%s</p></div>',
		esc_html(
			sprintf(
				/* translators: %s: plugin version */
				__( 'Custom Update Check is active (version %s).', 'custom-update-check' ),
				'0.1.0'
			)
		)
	);
}
add_action( 'admin_notices', 'custom_update_check_admin_notice' );
