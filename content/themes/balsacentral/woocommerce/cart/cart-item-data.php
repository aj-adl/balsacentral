<?php
/**
 * Cart item data (when outputting non-flat)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 	2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<dl class="variation">
	<?php

		$dimensions = array();
		$variations_output = '';

		foreach ( $item_data as $data ) :
			$key = sanitize_text_field( $data['key'] );

			if ( $data['key'] === 'Height' || $data['key'] === 'Width' || $data['key'] === 'Length') {
				$dimensions[ $data['key'] ] = $data['value'];
			} 

			else {
				$variations_output .= '<dt class="variation-'.sanitize_html_class( $key ).'">'.wp_kses_post( $data['key'] ).':</dt>';

			$variations_output .= '<dd class="variation-'.sanitize_html_class( $key ).'">'.wp_kses_post( wpautop( $data['value'] ) ).'</dd>';
			}
		endforeach;

		if ( $dimensions ) {

			$d_html = '<dt class="variation-size">Size:</dt><dd class="variation-size"><p>';
			$d_html .= '<span>'.wp_kses_post( $dimensions['Height'] ).'</span>';
			if ( $dimensions['Height'] && $dimensions['Width'] ) {
				$d_html .= ' x ';
			}
			$d_html .= '<span>'.wp_kses_post( $dimensions['Width'] ).'</span>';
			if ( $dimensions['Width'] && $dimensions['Length'] ) {
				$d_html .= ' x ';
			}
			$d_html .= '<span>'.wp_kses_post( $dimensions['Length'] ).'</span>';
			$d_html .= '</p></dd>';
		}

		echo $d_html;
		echo $variations_output;

		?>
</dl>
