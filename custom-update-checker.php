<?php
/**
 * Plugin Name:       Custom Update Checker
 * Plugin URI:        https://github.com/iamdharmesh/custom-update-checker
 * Description:       Demo plugin for self-hosted updates via GitHub Releases and Plugin Update Checker.
 * Version:           0.1.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            iamdharmesh
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       custom-update-checker
 * Update URI:        https://github.com/iamdharmesh/custom-update-checker
 *
 * @package CustomUpdateChecker
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

// GH release based update checker
$custom_update_checker_updater = PucFactory::buildUpdateChecker(
	'https://github.com/iamdharmesh/custom-update-checker/',
	__FILE__,
	'custom-update-checker'
);
$custom_update_checker_updater->getVcsApi()->enableReleaseAssets( '/^custom-update-checker\.zip$/' );

// Info.json based update checker
// add_action( 'init', function () {
// 	$update_checker = PucFactory::buildUpdateChecker(
// 		// URL of the metadata file you host. Must be publicly reachable by the
// 		// client site.
// 		'https://raw.githubusercontent.com/iamdharmesh/custom-update-checker/refs/heads/main/info.json',
// 		__FILE__,
// 		'custom-update-checker'
// 	);
// } );

/**
 * Display plugin version in admin to confirm activation.
 */
function custom_update_checker_admin_notice() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	printf(
		'<div class="notice notice-info"><p>%s</p></div>',
		esc_html(
			sprintf(
				/* translators: %s: plugin version */
				__( 'Custom Update Checker is active (version %s).', 'custom-update-checker' ),
				'0.1.0'
			)
		)
	);
}
add_action( 'admin_notices', 'custom_update_checker_admin_notice' );
