<?php

/**
 *
 * Load a local config file
 *
 * These should be present in ALL contexts/instances
 *
 * wp-local-config-sample.php will be checked in to the repo, so you can base it off that
 *
 * - Keeps sensitive data out of the git repo
 * - Allows changes in config per context (local / staging / production )
 * - Work in progress, our git flow and deployment practices are in flux atm
 *
 * Local config is in charge of DB credentials, salts, $table_prefix etc
 * + $_app_url (to fix for WP_CLI)
 * + $_app_content_folder (easy changing if necessary)
 * + $_app_path_to_core (easy to change dir structure if necessary)
 *
 */

/* Handles WP-CLI where index.php is not used */
if (! isset($_app_path_to_core ) ) $_app_path_to_core = '';

if ( file_exists( dirname( __FILE__ ) . '/../.app-config/wp-config-local.php' ) ) {

	include( dirname( __FILE__ ) . '/../.app-config/wp-config-local.php' );

} elseif ( file_exists( dirname( __FILE__ ) . '/wp-config-local.php' ) ) {

	include( dirname( __FILE__ ) . '/wp-config-local.php' );

} else {

	// SRS BUSINESS - THESE CONFIG FILES ARE NOT OPTIONAL
	die( 'The application is missing configuration data, please ensure all configuration files are present and in the correct directories.');
}


/**
 *
 * Common Settings
 *
 * By default these apply across all instances
 *
 * Thanks to the 'defined()' check before hand any one of these
 * can be overridden on a per site basis in the local-config file
 *
 */

// No plugin / theme editing in admin
if ( ! defined('DISALLOW_FILE_EDIT') ) define( 'DISALLOW_FILE_EDIT', true );

// Custom content directories for life yo.. ('content' or 'app' suggested as default)
// $_app_url MUST be defined in the local config.
// $_app_content_folder MUST be defined in local config

if ( ! defined('WP_CONTENT_DIR') ) define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/' . $_app_content_folder );
if ( ! defined('WP_CONTENT_URL') ) define( 'WP_CONTENT_URL', $_app_url . '/' .$_app_content_folder  );

// Define the default memory limit - higher limits recommended on WooCommerce stores, don't be cheap!
if ( ! defined('WP_MEMORY_LIMIT') ) define( 'WP_MEMORY_LIMIT', '512M');

/**
 * For developersWordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
// Enable WP_DEBUG mode
if ( ! defined('WP_DEBUG') ) define('WP_DEBUG', false);

// Enable Debug logging to the /wp-content/debug.log file
if ( ! defined('WP_DEBUG_LOG') ) define('WP_DEBUG_LOG', false);

// Disable display of errors and warnings
if ( ! defined('WP_DEBUG_DISPLAY') ) {
	define( 'WP_DEBUG_DISPLAY', false );
	@ini_set( 'display_errors', 0 );
}

/**
* WordPress Localized Language, defaults to English.
*
* Change this to localize WordPress. A corresponding MO file for the chosen
* language must be installed to wp-content/languages. For example, install
* de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
* language support.
*/
if ( ! defined('WPLANG') ) define('WPLANG', '');

if ( ! defined('FS_METHOD') ) define('FS_METHOD', 'direct');
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined('ABSPATH') ) {
	define( 'ABSPATH', dirname( __FILE__ ) . $_app_path_to_core . '/' );
}

/** If we're doing a subdirectory WP setup we need the site URL to be on point */

if (! defined( 'WP_SITEURL') && $_app_path_to_core !== '' ) define( 'WP_SITEURL', $_app_url . $_app_path_to_core);

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');