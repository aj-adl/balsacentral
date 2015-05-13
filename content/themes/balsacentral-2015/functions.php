<?php 

add_action( 'init', 'balsacentral_theme_setup' );

function balsacentral_theme_setup(){
	// Hella Basic bitch but it's 2am

	remove_customizer();
}

function remove_customizer(){
	remove_filter( 'wp_head', 'mr_tailor_custom_styles', 100 );
}

add_action( 'woocommerce_before_main_content', 'shop_description_to_bottom');

function shop_description_to_bottom(){

	if(is_shop()) {
		remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description' );
		add_action( 'woocommerce_after_main_content', 'woocommerce_product_archive_description' );
	}
}

function mr_tailor_custom_styles() {
	/**
	 *
	 * Despite being unhooked above, this is just here in case T
	 * he parent theme will not be able to declare a function to output the cusomizer css
	 *
	 */
	return;
}

add_action( 'wp_enqueue_scripts', 'balsacentral_add_js_to_sheet_page', 100);

function balsacentral_add_js_to_sheet_page()
{
    global $post;

    if ( 251 === $post->ID ) {
        wp_enqueue_script( 'theme-js', get_stylesheet_directory_uri() . '/js/theme.js', array('jquery'), 1.1, true );
        wp_enqueue_style( 'js_composer_front' );
    }
}


/**
 * Strip date from permalink
 */
function wpdr_remove_dates_from_permalink_filter( $link, $post ) {
    $timestamp = strtotime( $post->post_date );
    return str_replace( '/' . date( 'Y', $timestamp ) . '/' . date( 'm', $timestamp ) . '/', '/', $link );

}
add_filter( 'document_permalink', 'wpdr_remove_dates_from_permalink_filter', 10, 2 );
/**
 * Strip date from rewrite rules
 */
function wpdr_remove_date_from_rewrite_rules( $rules ) {
    global $wpdr;
    $slug = $wpdr->document_slug();
    $rules = array();
    //documents/foo-revision-1.bar
    $rules[ $slug . '/([^.]+)-' . __( 'revision', 'wp-document-revisions' ) . '-([0-9]+)\.[A-Za-z0-9]{3,4}/?$'] = 'index.php?&document=$matches[1]&revision=$matches[2]';
    //documents/foo.bar/feed/
    $rules[ $slug . '/([^.]+)(\.[A-Za-z0-9]{3,4})?/feed/?$'] = 'index.php?document=$matches[1]&feed=feed';
    //documents/foo.bar
    $rules[ $slug . '/([^.]+)\.[A-Za-z0-9]{3,4}/?$'] = 'index.php?document=$matches[1]';
    // site.com/documents/ should list all documents that user has access to (private, public)
    $rules[ $slug . '/?$'] = 'index.php?post_type=document';
    $rules[ $slug . '/page/?([0-9]{1,})/?$'] = 'index.php?post_type=document&paged=$matches[1]';

    return $rules;
}
add_filter( 'document_rewrite_rules', 'wpdr_remove_date_from_rewrite_rules' );
//flush rewrite rules on activation
register_activation_hook( __FILE__, 'flush_rewrite_rules' );

