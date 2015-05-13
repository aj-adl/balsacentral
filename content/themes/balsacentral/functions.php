<?php
/* Theme Functions */

// Load widgets, options and include files
require_once('includes/cats-widget.php');
require_once('includes/recent-posts-widget.php');
require_once('includes/popular-posts-widget.php');
require_once('includes/minifolio-widget.php');
require_once('includes/flickr-widget.php');
require_once('includes/social-links-widget.php');
require_once('includes/twitter-widget.php');
require_once('includes/post-options.php');
require_once('includes/page-options.php');
require_once('includes/theme-admin-options.php');
require_once('includes/shortcodes/shortcodes.php');
require_once('includes/shortcodes/visual-shortcodes.php');
require_once('includes/breadcrumbs.php');
if (class_exists( 'woocommerce' )) {
	require_once('woocommerce/woocommerce-hooks.php');
}

// Set default content width
if ( !isset( $content_width ) )
	$content_width = 980;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * balsacentral supports.
 */
function balsacentral_setup() {

	// Makes theme available for translation.
	load_theme_textdomain( 'balsacentral', get_template_directory() . '/languages' );

	// Add visual editor stylesheet support
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Add post formats
	add_theme_support( 'post-formats', array( 'audio', 'gallery', 'video' ) );

	// Add navigation menus
	register_nav_menus( array(
		'secondary'	=> __( 'Secondary Top Menu', 'balsacentral' ),
		'primary'	=> __( 'Primary Menu', 'balsacentral' )
	) );

	// Add support for custom background and set default color
	/*
	add_theme_support( 'custom-background', array(
		'default-color' => '',
		'default-image' => ''
	) );
	*/

	// Add suport for post thumbnails and set default sizes
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 800, 9999 );

	// Add custom image sizes
	add_image_size( 'big', 9999, 9999);
	add_image_size( 'size_242', 242, 9999 ); // Blog Grid Style
	add_image_size( 'size_242_198', 242, 198, true ); // Blog List Style
	add_image_size( 'size_254_198', 254, 198, true ); // Portfolio Templates
	add_image_size( 'size_140_90', 140, 90, true ); // Related Posts
	add_image_size( 'size_90', 90, 999 ); // Recent Posts Widget
	add_image_size( 'size_90_90', 90, 90, true ); // MiniFolio Widget
	
	// Declare theme as WooCommerce compatible
	$template = get_option( 'template' );
	update_option( 'woocommerce_theme_support_check', $template );
}
add_action( 'after_setup_theme', 'balsacentral_setup' );

// Make theme options variables available for use
function load_theme_vars() {
	global $options;
	foreach ($options as $value) {
		if(isset($value['id']) && isset ($value['std'])) {
			global $$value['id'];
			if (get_option( $value['id'] ) === FALSE) {
				$$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] );
			}
		}
	}
}
add_action( 'init','load_theme_vars' );

// Register Widgets and Sidebars
add_action( 'widgets_init', 'balsacentral_widgets_init' );
	function balsacentral_widgets_init() {
		register_widget('balsacentral_Cat_Widget');
		register_widget('balsacentral_Recent_Posts');
		register_widget('balsacentral_Popular_Posts');
		register_widget('balsacentral_Mini_Folio');
		register_widget('balsacentral_Flickr_Widget');
		register_widget('balsacentral_Social_Widget');
		register_widget('balsacentral_Twitter_Widget');

		register_sidebar( array(
			'name' => __( 'Default Header Bar', 'balsacentral' ),
			'id' => 'default-headerbar',
			'description' => __( 'Header Bar', 'balsacentral' ),
			'before_widget' => '<aside id="%1$s" class="hwa_wrap %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="hwa-title">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Default Sidebar', 'balsacentral' ),
			'id' => 'default-sidebar',
			'description' => __( 'Sidebar', 'balsacentral' ),
			'before_widget' => '<aside id="%1$s" class="widgetwrap %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="sb-title">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Default Secondary Column 1', 'balsacentral' ),
			'id' => 'secondary-column-1',
			'description' => __( 'Secondary Column', 'balsacentral' ),
			'before_widget' => '<aside id="%1$s" class="widgetwrap %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="sc-title">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Default Secondary Column 2', 'balsacentral' ),
			'id' => 'secondary-column-2',
			'description' => __( 'Secondary Column', 'balsacentral' ),
			'before_widget' => '<aside id="%1$s" class="widgetwrap %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="sc-title">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Default Secondary Column 3', 'balsacentral' ),
			'id' => 'secondary-column-3',
			'description' => __( 'Secondary Column', 'balsacentral' ),
			'before_widget' => '<aside id="%1$s" class="widgetwrap %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="sc-title">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Default Secondary Column 4', 'balsacentral' ),
			'id' => 'secondary-column-4',
			'description' => __( 'Secondary Column', 'balsacentral' ),
			'before_widget' => '<aside id="%1$s" class="widgetwrap %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="sc-title">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Default Secondary Column 5', 'balsacentral' ),
			'id' => 'secondary-column-5',
			'description' => __( 'Secondary Column', 'balsacentral' ),
			'before_widget' => '<aside id="%1$s" class="widgetwrap %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="sc-title">',
			'after_title' => '</h3>',
		) );

		// Register exclusive widget areas for each page
		$mypages = get_pages();
		foreach($mypages as $pp) {
			$page_opts = get_post_meta( $pp->ID, 'page_options', true );
			$sidebar_a = isset($page_opts['sidebar_a']) ? $page_opts['sidebar_a'] : '';
			$sidebar_h = isset($page_opts['sidebar_h']) ? $page_opts['sidebar_h'] : '';

			if ( $sidebar_h == 'true' ){
				register_sidebar( array(
					'name' => sprintf(__( '%1$s Header Bar', 'balsacentral' ), $pp->post_title),
					'id' =>  $pp->ID.'-headerbar',
					'description' => 'Header Bar',
					'before_widget' => '<aside id="%1$s" class="hwa_wrap %2$s">',
					'after_widget' => "</aside>",
					'before_title' => '<h3 class="hwa-title">',
					'after_title' => '</h3>',
				) );
			};
			if ( $sidebar_a == 'true' ){
				register_sidebar( array(
					'name' => sprintf(__( '%1$s Sidebar', 'balsacentral' ), $pp->post_title),
					'id' => $pp->ID.'-sidebar',
					'description' => 'Sidebar',
					'before_widget' => '<aside id="%1$s" class="widgetwrap %2$s">',
					'after_widget' => "</aside>",
					'before_title' => '<h3 class="sb-title">',
					'after_title' => '</h3>',
				) );
			}
		}
	}
// Single Post Meta
if ( !function_exists( 'balsacentral_post_meta' ) ) :
	function balsacentral_post_meta() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span> <span class="sep"> in </span>%8$s ', 'balsacentral' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'balsacentral' ), get_the_author() ) ),
		get_the_author(),
		get_the_category_list( ', ' )
	);
	if ( comments_open() ) : ?>
			<span class="sep"><?php _e( ' with ', 'balsacentral' ); ?></span>
			<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( '0 Comments', 'balsacentral' ) . '</span>', __( '1 Comment', 'balsacentral' ), __( '% Comments', 'balsacentral' ) ); ?></span>
	<?php endif; // End if comments_open() ?>
    <?php edit_post_link( __( 'Edit', 'balsacentral' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' );
	}
endif;

// Masonry grid Post Meta
if ( !function_exists( 'balsacentral_small_meta' ) ) :
	function balsacentral_small_meta() {
	printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>', 'balsacentral' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	if ( comments_open() ) : ?>
			<span class="sep"><?php _e( 'with', 'balsacentral' );?></span>
			<span class="comments-link"><?php comments_popup_link( __( '0 Comments', 'balsacentral' ), __( '1 Comment', 'balsacentral' ), __( '% Comments', 'balsacentral' ) ); ?></span>
	<?php endif; // End if comments_open()
	}
endif;

// Attachment Post Meta
if ( !function_exists( 'balsacentral_attachment_meta' ) ) :
	function balsacentral_attachment_meta() {
		printf( __( '<span>%1$s</span> by %2$s', 'balsacentral' ), get_the_time(get_option('date_format')), sprintf( '<a href="%1$s" title="%2$s">%3$s</a>', get_author_posts_url( get_the_author_meta( 'ID' ) ), sprintf( esc_attr__( 'View all posts by %s', 'balsacentral' ), get_the_author() ), get_the_author() )); edit_post_link( __( 'Edit', 'balsacentral' ), ' &middot; ', '' );
		if ( wp_attachment_is_image() )
		{
			$metadata = wp_get_attachment_metadata();
			printf( __( ' &middot; Full size is %1$s pixels', 'balsacentral' ),
				sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
				wp_get_attachment_url(),
				esc_attr( __( 'Link to full-size image', 'balsacentral' ) ),
					$metadata['width'],
					$metadata['height']
				)
			);
		}
	}
endif;

// Shorten Any Text
if ( !function_exists( 'short' ) ) :
	function short($text, $limit)
	{
		$chars_limit = $limit;
		$chars_text = strlen($text);
		$text = strip_tags($text);
		$text = $text." ";
		$text = substr($text,0,$chars_limit);
		$text = substr($text,0,strrpos($text,' '));
		if ($chars_text > $chars_limit)
		{
			$text = $text."...";
		}
		return $text;
	}
endif;

// SS Social Sharing
if ( !function_exists( 'ss_sharing' ) ) :
	function ss_sharing() {
		$share_link = get_permalink();
		$share_title = get_the_title();
		$bcent_ss_fb = get_option('bcent_ss_fb');
		$bcent_ss_tw = get_option('bcent_ss_tw');
		$bcent_ss_tw_usrname = get_option('bcent_ss_tw_usrname');
		$bcent_ss_gp = get_option('bcent_ss_gp');
		$bcent_ss_pint = get_option('bcent_ss_pint');
		$bcent_ss_ln = get_option('bcent_ss_ln');
		$out = '';
		if( $bcent_ss_fb == 'true' ) {
			$out .= '<div class="fb-like" data-href="'.$share_link.'" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="arial"></div>';
		}
		if( $bcent_ss_tw == 'true' ) {
			if( !empty($bcent_ss_tw_usrname) ) {
				$out .= '<div class="ss_sharing_btn"><a href="http://twitter.com/share" class="twitter-share-button" data-url="'.$share_link.'"  data-text="'.$share_title.'" data-via="'.$bcent_ss_tw_usrname.'">Tweet</a></div>';
			}
			else {
				$out .= '<div class="ss_sharing_btn"><a href="http://twitter.com/share" class="twitter-share-button" data-url="'.$share_link.'"  data-text="'.$share_title.'">Tweet</a></div>';
			}
		}
		if( $bcent_ss_gp == 'true' ) {
			$out .= '<div class="ss_sharing_btn"><g:plusone size="medium" href="'.$share_link.'"></g:plusone></div>';
		}
		if( $bcent_ss_pint == 'true' ) {
			global $post;
			setup_postdata($post);
			$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'', '' );
			if ( has_post_thumbnail($post->ID) ) {
				$image = $src[0];
			}
			else {
				$image = get_template_directory_uri()."/images/post_thumb.jpg";
			}
			$description = short(get_the_excerpt(), 140);
			$share_link = get_permalink();
			$out .= '<div class="ss_sharing_btn"><a href="http://pinterest.com/pin/create/button/?url='.$share_link.'&media='.$image.'&description='.$description.'" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>';
			wp_reset_postdata();
		}
		if( $bcent_ss_ln == 'true' ) {
			$out .= '<div class="ss_sharing_btn"><script type="IN/Share" data-url="'.$share_link.'" data-counter="right"></script></div>';
		}
		echo $out;
	}
endif;

// Load facebook Script in footer
if ( !function_exists( 'ss_fb_script' ) ) :
	function ss_fb_script() {
		if( is_single() && get_option('bcent_ss_sharing') == 'true' && get_option('bcent_ss_fb') == 'true' ) { ?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	<?php }
	}
endif;
add_action('wp_footer', 'ss_fb_script');

// Add facebook Open Graph Meta tags
if ( !function_exists( 'add_facebook_open_graph_tags' ) ) :
	function add_facebook_open_graph_tags() {
		if( is_single() && get_option('bcent_ss_sharing') == 'true' && get_option('bcent_ss_fb') == 'true' ) {
			global $post;
			setup_postdata($post);
			$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'', '' );
			if ( has_post_thumbnail($post->ID) ) {
				$image = $src[0];
			}
			else {
				$image = get_template_directory_uri()."/images/post_thumb.jpg";
			}
			?>
			<meta property="og:title" content="<?php the_title(); ?>"/>
			<meta property="og:type" content="article"/>
			<meta property="og:image" content="<?php echo $image; ?>"/>
			<meta property="og:url" content="<?php the_permalink(); ?>"/>
			<meta property="og:description" content="<?php echo short(get_the_excerpt(), 140); ?>"/>
			<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
			<?php wp_reset_postdata();
		}
	}
endif;
add_action('wp_head', 'add_facebook_open_graph_tags', 99);

// Add Facebook language attributes inside html tag
if ( !function_exists( 'add_og_xml_ns' ) ) :
	function add_og_xml_ns($out) {
		if( is_single() && get_option('bcent_ss_sharing') == 'true' && get_option('bcent_ss_fb') == 'true' ) {
			return $out.' xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml" ';
		}
		else
			return $out;
	}
endif;
add_filter('language_attributes', 'add_og_xml_ns');

// Add arrow class to menus
class Arrow_Walker_Nav_Menu extends Walker_Nav_Menu {
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $id_field = $this->db_fields['id'];
        if (!empty($children_elements[$element->$id_field])) {
            $element->classes[] = 'arrow'; //enter any classname you like here!
        }
        Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}

// Menu Notifier when no menu is configured
if ( !function_exists( 'menu_reminder' ) ) :
function menu_reminder() {
	_e( '<span class="menu_notifier">Navigation Menu not configured yet. Please configure it inside WordPress <strong>Appearance > Menus</strong></span>', 'balsacentral' );
}
endif;

// Enable short codes inside Widgets
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

// Allow HTML in category and term descriptions
foreach ( array( 'pre_term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_filter_kses' );
}
foreach ( array( 'term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_kses_data' );
}

// Load scripts required by the theme
function ss_scripts() {
	global $bcent_archive_template, $bcent_scheme;
	
	/*
	 * Add JavaScript for threaded comments when required
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('tabber', get_template_directory_uri().'/js/general/tabs.js', array('jquery-ui-core', 'jquery-ui-tabs', 'jquery-ui-accordion'), '', true);
	wp_enqueue_script('pretty-photo', get_template_directory_uri().'/js/general/jquery.prettyPhoto.js', '', '', true);
	wp_enqueue_script('jq-carousel', get_template_directory_uri().'/js/general/jquery.jcarousel.min.js', '', '', true);
	wp_enqueue_script('jq-easing', get_template_directory_uri().'/js/general/jquery.easing.min.js', '', '', true);
	wp_enqueue_script('jq-hover-intent', get_template_directory_uri().'/js/general/jquery.hoverIntent.minified.js', '', '', true);
	wp_enqueue_script('jq-flex-slider', get_template_directory_uri().'/js/general/jquery.flexslider-min.js', '', '', true);

	// Only for filterable portfolio templates
	if( is_page_template('templates/port3-sb-filterable.php') || is_page_template('templates/port4-filterable.php') || is_page_template('templates/port4-sb-filterable.php') || is_page_template('templates/port5-filterable.php') ){
		wp_register_script( 'jq-quicksand', get_template_directory_uri().'/js/filterable/jquery.quicksand.js', '', '', true);
		wp_enqueue_script('jq-filterable', get_template_directory_uri().'/js/filterable/filterable.js', array('jq-quicksand'), '', true);
	}

	// Only for masonry grid templates
	if( is_page_template('templates/blog-grid.php') || ( ( $bcent_archive_template == 'grid_style' ) && ( is_home() || is_archive() ) ) ){
		wp_register_script( 'jq-masonry', get_template_directory_uri()."/js/masonry/jquery.masonry.min.js", '', '', true);
		wp_enqueue_script('jq-mason-init', get_template_directory_uri().'/js/masonry/mason_init.js', array('jq-masonry'), '', true);
	}

	// Only for contact page
	if( is_page_template('templates/page-contact.php') ){
		wp_enqueue_script('jq-validate', get_template_directory_uri().'/js/contact/jquery.validate.pack.js', '', '', true);
		wp_enqueue_script('contact-form', get_template_directory_uri().'/js/contact/form_.js', '', '', true);
	}

	// Load social sharing scripts in footer
	if( is_single() && get_option('bcent_ss_sharing') == 'true' ){
		if( get_option('bcent_ss_tw') == 'true' )
			wp_enqueue_script('twitter_share_script', 'http://platform.twitter.com/widgets.js', '', '', true);
		if( get_option('bcent_ss_gp') == 'true' )
			wp_enqueue_script('google_plus_script', 'http://apis.google.com/js/plusone.js', '', '', true);
		if( get_option('bcent_ss_pint') == 'true' )
			wp_enqueue_script('pinterest_script', '//assets.pinterest.com/js/pinit.js', '', '', true);
		if( get_option('bcent_ss_ln') == 'true' )
			wp_enqueue_script('linkedin_script', 'http://platform.linkedin.com/in.js', '', '', true);
	}

	// Load jPlayer Scripts
	if( is_page_template('templates/blog-grid.php') || is_page_template('templates/blog-list.php') || is_home() || is_archive() || ( is_single() && 'audio' == get_post_format()) ){
		wp_register_script( 'jq-jplayer', get_template_directory_uri()."/js/jquery.jplayer.min.js", '', '', true);
		wp_enqueue_script( 'jq-jplayer' );
		wp_register_style( 'jplayer', get_template_directory_uri() . '/css/jplayer_skin/jp_skin.css', '', '', 'all' );
		wp_enqueue_style( 'jplayer' );
	}

	// Miscellaneous
	wp_enqueue_script('custom', get_template_directory_uri().'/js/general/custom.js', '', '', true);
	wp_register_style( 'prettyphoto', get_template_directory_uri() . '/css/prettyPhoto.css', '', '', 'all' );
	wp_enqueue_style( 'prettyphoto' );
	
	// Main stylesheet
	wp_enqueue_style( 'balsacentral-style', get_stylesheet_uri() );
	
	if (class_exists( 'woocommerce' )) {
		wp_register_style( 'woo-custom', get_template_directory_uri() . '/woocommerce/woocommerce-custom.css', '', '', 'all' );
		wp_enqueue_style( 'woo-custom' );
	}
	if (class_exists('WP_eCommerce')) {
		wp_register_style( 'wpec-custom', get_template_directory_uri() . '/wpec-custom.css', '', '', 'all' );
		wp_enqueue_style( 'wpec-custom' );
	}
	if ( $bcent_scheme != '' && $bcent_scheme != 'default' ) {
		$scheme_url = get_template_directory_uri().'/css/schemes/'.$bcent_scheme.'.css';
		wp_register_style( $bcent_scheme.'-color-scheme', $scheme_url, '', '', 'all' );
		wp_enqueue_style( $bcent_scheme.'-color-scheme' );
	}
		wp_register_style( 'balsacentral-responsive', get_template_directory_uri() . '/responsive.css', '', '', 'all' );
		wp_enqueue_style( 'balsacentral-responsive' );

		wp_register_style( 'balsacentral-user', get_template_directory_uri() . '/user.css', '', '', 'all' );
		wp_enqueue_style( 'balsacentral-user' );
}
add_action( 'wp_enqueue_scripts', 'ss_scripts' );

// Add HTML5 JS for old browsers
add_action( 'wp_head', 'html5_js');
if (!function_exists('html5_js')):
function html5_js() { ?>
<!--[if lt IE 9]>
<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]--><?php }
endif;

// Add Custom Markup inside head section
add_action( 'wp_head', 'custom_head_code');
if (!function_exists('custom_head_code')):
function custom_head_code() {
global $bcent_custom_head_code;
if( $bcent_custom_head_code != '' ) echo stripslashes($bcent_custom_head_code);
}
endif;

// Add span tag to post count of categories and archives widget
function cats_widget_postcount_filter ($out) {
	$out = str_replace(' (', '<span class="count">(', $out);
	$out = str_replace(')', ')</span>', $out);
	return $out;
}
add_filter('wp_list_categories','cats_widget_postcount_filter');

function archives_widget_postcount_filter($out) {
	$out = str_replace('&nbsp;(', '<span class="count">(', $out);
	$out = str_replace(')', ')</span>', $out);
	return $out;
}
add_filter('get_archives_link', 'archives_widget_postcount_filter');

/**
 * Generate title for site pages
 */
function balsacentral_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'balsacentral' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'balsacentral_wp_title', 10, 2 );

/**
 *remove unnecessary crap from wp_head() - as this is not a blog
 */
remove_action('wp_head', 'feed_links_extra', 3); // Displays the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Displays the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Displays the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Displays the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // index link
remove_action('wp_head', 'parent_post_rel_link'); // prev link
remove_action('wp_head', 'start_post_rel_link'); // start link
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); // Displays relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Displays the XHTML generator that is generated on the wp_head hook, WP version

// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', 'balsacentral_products_per_page', 20 );

function balsacentral_products_per_page(){
	return 32;
}

add_filter('woocommerce_available_payment_gateways', 'balsacentral_filter_payment_gateways', 30 );

function balsacentral_filter_payment_gateways($_available_gateways){
	global $woocommerce;
	$bc_customer_country = $woocommerce->customer->get_country();
	if(defined('WOOCOMMERCE_CHECKOUT')) {
		$in_checkout = constant("WOOCOMMERCE_CHECKOUT");
	} else {
		$in_checkout = false;
	}
	if(is_checkout() || $in_checkout){
		if($bc_customer_country != 'AU'){
			$int_filtered = array('paypal');
			$bc_allowed_gateways = array_diff_key( $_available_gateways, array_flip( $int_filtered ) );
		}
		else {
			$aus_filtered = array('bacs');
			$bc_allowed_gateways = array_diff_key( $_available_gateways, array_flip( $aus_filtered ) );
		}
		$_available_gateways = $bc_allowed_gateways;
		return $_available_gateways;
	}
	else {
		return $_available_gateways;
	}

}

add_filter('woocommerce_new_badge_enqueue_styles', function() { return false; } );

add_action('wp_logout',create_function('','wp_redirect(home_url());exit();'));

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

//add_action('woocommerce_check_cart_items', 'bc_check_cart_value_including_tax', 9);
//add_action('woocommerce_check_cart_items', 'bc_reset_woocommerce_price_filter', 11); 

function bc_check_cart_value_including_tax() {
	add_filter('woocommerce_get_price', 'bc_return_price_including_tax', 10, 2);
}

function bc_reset_woocommerce_price_filter() {
	remove_filter('woocommerce_get_price', 'bc_return_price_including_tax');
}

function bc_return_price_including_tax($price, $thisproduct) {
	if( $price && $thisproduct ){
		$total_price = $thisproduct->get_price_including_tax(1, $price);
		return $total_price;

	} else {
		return $price;
	}
}

?>