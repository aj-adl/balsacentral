<?php
/*
Plugin Name: bc-functions
Version: 0.1-alpha
Description: PLUGIN DESCRIPTION HERE
Author: YOUR NAME HERE
Author URI: YOUR SITE HERE
Plugin URI: PLUGIN SITE HERE
Text Domain: bc-functions
Domain Path: /languages
*/

/**
 *
 * Tweaks from the old theme that need to be integrated in
 *
 * We'll do this in a more robust way but they need to be up ASAP atm
 *
 *
 */

add_filter('woocommerce_shipping_local_pickup_is_available', 'bc_local_pickup_for_sa');

function bc_local_pickup_for_sa( $package ) {
	$is_available = false;
	$state = $package['destination']['state'];
	if ( 'SA' == $state  || 'South Australia' == $state ){
		$is_available = true;
	}
	return $is_available;
}
function bc_address_no_postcodes_wc( $fields ) {
	$fields['billing']['billing_address_2']['label'] = 'Please note our courier is unable to ship to P.O Boxes';
	$fields['shipping']['shipping_address_2']['label'] = 'Please note our courier is unable to ship to P.O Boxes';
	return $fields;
}
add_filter('woocommerce_checkout_fields', 'bc_address_no_postcodes_wc');


function bc_address_no_postcodes_ga() {
	$label = 'Address <abbr class="required" title="required">*</abbr>';
	$label .= '<span class="bc-no-postcode"> - Our courier is unable to ship to P.O Boxes</span>';
	return $label;
}

add_filter('woogoogad_shipping_address_label_filter', 'bc_address_no_postcodes_ga');
add_filter('woogoogad_billing_address_label_filter', 'bc_address_no_postcodes_ga');

function wd_mandrill_woo_order( $message ) {
	if ( in_array( 'wp_WC_Email->send', $message['tags']['automatic'] ) ) {
		$message['html'] = $message['html'];
	} else {
		$message['html'] = nl2br( $message['html'] );
	}

	return $message;
}

add_filter( 'mandrill_payload', 'wd_mandrill_woo_order' );

add_action('woocommerce_after_checkout_validation', 'deny_pobox_postcode');

function deny_pobox_postcode( $posted ) {
	global $woocommerce;

	// Put postcode, address 1 and address 2 into an array
	$check_address  = array();
	$check_address[] = isset( $posted['shipping_postcode'] ) ? $posted['shipping_postcode'] : $posted['billing_postcode'];
	$check_address[] = isset( $posted['shipping_address_1'] ) ? $posted['shipping_address_1'] : $posted['billing_address_1'];
	$check_address[] = isset( $posted['shipping_address_2'] ) ? $posted['shipping_address_2'] : $posted['billing_address_2'];

	// Implode address, make lowercase, and remove spaces and full stops
	$check_address = strtolower( str_replace( array( ' ', '.' ), '', implode( '-', $check_address ) ) );

	if ( strstr( $check_address, 'pobox' ) || strstr( $check_address, 'lockedbag') ) {
		$woocommerce->add_error( "Sorry, we are unable ship to PO BOX or Locked Bag addresses." );
	}
}