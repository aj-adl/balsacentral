<?php
/* WooCommerce custom hooks and functions used by the theme */

// Disable WooCommerce styles
define('WOOCOMMERCE_USE_CSS', false);

// Update cart contents when added via AJAX */
add_filter('add_to_cart_fragments', 'woocommerce_update_cart');
if ( !function_exists( 'woocommerce_update_cart' ) ) :
	function woocommerce_update_cart( $fragments ) {
		global $woocommerce;
		ob_start(); ?>
        <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'balsacentral' ); ?>"><span class="cart-label"><?php echo sprintf( _n( '%d item<br/>in cart', '%d items<br/>in cart', $woocommerce->cart->cart_contents_count, 'balsacentral' ), $woocommerce->cart->cart_contents_count); ?></span><?php echo $woocommerce->cart->get_cart_subtotal(); ?></a>
		<?php
		$fragments['a.cart-contents'] = ob_get_clean();
		return $fragments;
	}
endif;


// Set WooCommerce image dimensions upon theme activation
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' )
	add_action('init', 'custom_woocommerce_image_dimensions', 1);

if ( !function_exists( 'custom_woocommerce_image_dimensions' ) ) :
	function custom_woocommerce_image_dimensions() {
		// Image sizes
		update_option( 'woocommerce_thumbnail_image_width', '90' ); // Image gallery thumbs
		update_option( 'woocommerce_thumbnail_image_height', '999' );
		update_option( 'woocommerce_single_image_width', '370' ); // Featured product image
		update_option( 'woocommerce_single_image_height', '999' );
		update_option( 'woocommerce_catalog_image_width', '240' ); // Product category thumbs
		update_option( 'woocommerce_catalog_image_height', '999' );

		// Hard Crop [0 = false, 1 = true]
		update_option( 'woocommerce_thumbnail_image_crop', 0 );
		update_option( 'woocommerce_single_image_crop', 0 );
		update_option( 'woocommerce_catalog_image_crop', 0 );
	}
endif;

// Redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
	woocommerce_related_products(4, 4);
}

// Redefine number of product thumbnail columns on single product page
add_filter ( 'woocommerce_product_thumbnails_columns', 'xx_thumb_cols' );
function xx_thumb_cols() {
	return 5; // .last class applied to every 5th thumbnail
}?>