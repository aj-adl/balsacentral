<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * WooCommerce_Google_Address_Plugin_Back
 * Class for backend.
 * @since 1.3
 */

if ( ! class_exists( 'WooCommerce_Google_Address_Plugin_Back' ) ) {

	class WooCommerce_Google_Address_Plugin_Back
	{	

		private $endpoint = 'http://localhost/updater/?item=7208221';

		//on plugins loaded
		function __construct()
		{
			$this->endpoint = apply_filters('woogoogad_updater_endpoint', $this->endpoint);

			if(!class_exists('lc_update_notifier')) {
		        include_once(dirname(__FILE__).'/includes/lc-update-notifier/lc_update_notifier.php');
		    }
		    
		    $lcun = new lc_update_notifier(plugin_dir_path(__FILE__).'index.php', $this->endpoint);

		} //__construct
		
		
	} // WooCommerce_Google_Address_Plugin_Back
}