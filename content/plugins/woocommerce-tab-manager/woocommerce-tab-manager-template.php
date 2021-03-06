<?php
/**
 * WooCommerce Tab Manager
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce Tab Manager to newer
 * versions in the future. If you wish to customize WooCommerce Tab Manager for your
 * needs please refer to http://docs.woothemes.com/document/tab-manager/
 *
 * @package     WC-Tab-Manager/Templates
 * @author      SkyVerge
 * @copyright   Copyright (c) 2012-2015, SkyVerge, Inc.
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

/**
 * WooCommerce Tab Manager Template Functions
 *
 * Functions used in the template files to output content - in most cases
 * hooked in via the template actions. All functions are pluggable.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if ( ! function_exists( 'woocommerce_tab_manager_tab_content' ) ) {

	/**
	 * Render the product/global tab content.  Templates are loaded in the
	 * following order:
	 *
	 * theme / woocommerce / single-product / tabs / content-{tab-name-slug}.php
	 * theme / woocommerce / single-product / tabs / content.php
	 * woocommerce-tab-manager / templates / single-product / tabs / content.php
	 *
	 * $tab structure:
	 * Array(
	 *   'title'    => (string) Tab title,
	 *   'priority' => (string) Tab priority,
	 *   'callback' => (mixed) callback function,
	 *   'id'       => (int) tab post identifier,
	 * )
	 *
	 * @access public
	 * @since 1.0.5
	 * @global WC_Tab_Manager wc_tab_manager()
	 * @global WC_Product $product
	 *
	 * @param string $key tab key, this is the sanitized tab title with possibly a numerical suffix to avoid key clashes
	 * @param array $tab tab data
	 */
	function woocommerce_tab_manager_tab_content( $key, $tab ) {
		global $product;

		$tab = wc_tab_manager()->get_product_tab( $product->id, $tab['id'], true );

		if ( $tab ) {

			// first look for a template specific for this tab
			$template_name = "single-product/tabs/content-{$tab['name']}.php";

			$located = locate_template(
				array(
					trailingslashit( WC()->template_path() ) . $template_name,
					$template_name
				)
			);

			// if not found, fallback to the general template
			if ( ! $located ) {
				$template_name = 'single-product/tabs/content.php';
			}

			wc_get_template(
				$template_name,
				array( 'tab' => $tab ),
				'',                                                 // template path (use WC core template path)
				wc_tab_manager()->get_plugin_path() . '/templates/'  // default path
			);

		}
	}
}
