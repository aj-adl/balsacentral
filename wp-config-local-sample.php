<?php
/** Setup app variables */

/**
 *
 * Set Content folder - relative to the wp-config.php file
 *
 * Default WordPress Setup = 'wp-content'
 *
 * My preferred = "app" or "content"
 *
 * NO TRAILING SLASH
 *
 */
$_app_content_folder = 'wp-content';

/**
 *
 * Path to core WP files
 *
 * Needs to be set in index.php if you want to
 * Use WP in a subdirectory / different directory
 *
 * If set in index.php that value will remain
 *
 */
if ( !$_app_path_to_core ) $_app_path_to_core = '';

/**
 *
 * Set URL, I just did this to stop getting
 * annoying errors in WP-CLI to be honest...
 *
 */

if ( array_key_exists( 'HTTP_HOST', $_SERVER ) ) {

	// Will work in 99% of cases
	$_app_url = 'http://' . $_SERVER[ 'HTTP_HOST' ];
} else {

	// You can hardcode it here for a backup or to avoid errors when using WP-CLI..
	$_app_url = 'http://%%SITENAME%%';
}

/**
 *
 * Define Options here for WP-Hard-Options plugin
 *
 * Allows us to override things in options table via constants
 * Serialized or Unserialized data is fine (maybe_unserialize is run on the values)
 *
 * Example:
 *
 * option key 'admin_email' in DB translates to constant of  'WP_OPTIONS_ADMIN_EMAIL'
 * - note case change and prefix
 *
 */

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'database_name_here');

/** MySQL database username */
define('DB_USER', 'username_here');

/** MySQL database password */
define('DB_PASSWORD', 'password_here');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';