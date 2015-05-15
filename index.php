<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);


/**
 * For if we've put WP in a sub dir
 *
 * Must have leading slash
 *
 * eg '/wp'
 *
 * @var $_app_path_to_core
 */
$_app_path_to_core = '';

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . $_app_path_to_core . '/wp-blog-header.php' );
