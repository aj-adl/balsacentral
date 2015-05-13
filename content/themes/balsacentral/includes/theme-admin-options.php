<?php
/* balsacentral Theme Options */

// load theme textdomain for translation
load_theme_textdomain( 'balsacentral', get_template_directory() . '/languages' );

$themename = 'balsacentral';
$shortname = 'bcent';
$options = array (
				array(	"type" => "wrap_start" ),

				array(	"type" => "tabs_start" ),

				array(	"name" => __( 'General', 'balsacentral' ),
						"id" => $shortname."_general",
						"type" => "heading"),

				array(	"name" => __( 'Header', 'balsacentral' ),
						"id" => $shortname."_header_area",
						"type" => "heading"),

				array(	"name" => __( 'Blog', 'balsacentral' ),
						"id" => $shortname."_blog",
						"type" => "heading"),

				array(	"type" => "tabs_end" ),

				array(	"type" => "tabbed_start",
						"id" => $shortname."_general" ),

				array(	"name" => __( 'General Settings for the theme', 'balsacentral' ),
						"type" => "subheading" ),

				array(  "name" => __( 'Use minified JS', 'balsacentral' ),
						"desc" => __( 'Check to load the static concat/minified JS file (developer option, proceed with caution)', 'balsacentral' ),
						"id" => $shortname."_custom_min_js",
						"type" => "checkbox",
						"std" => false),

				array(  "name" => __( 'Use minified CSS', 'balsacentral' ),
						"desc" => __( 'Check to load the static concat/minified CSS file (developer option, proceed with caution)', 'balsacentral' ),
						"id" => $shortname."_custom_min_css",
						"type" => "checkbox",
						"std" => false),

				array(	"name" => __( 'Color Scheme Variation', 'balsacentral' ),
						"desc" => __( 'Select a color scheme variation for the theme. This will be applied to the navigation bar, footer and some highlights.', 'balsacentral' ),
						"id" => $shortname."_scheme",
						"std" => "default",
						"type" => "select",
						"options" => array("default", "blue", "cherry", "cyan", "green")),

				array(	"name" => __( 'Global Sidebar Placement', 'balsacentral' ),
						"desc" => __( 'Select a global sidebar placement for blog, archives, author, single, etc.', 'balsacentral' ),
						"id" => $shortname."_sb_pos",
						"std" => "right",
						"type" => "select",
						"options" => array("right", "left")),

				array(	"name" => __( 'Contact e-mail', 'balsacentral' ),
						"desc" => __( 'Enter an e-mail address to which mail should be received from contact page. If left blank, your blog admin email is used.', 'balsacentral' ),
						"id" => $shortname."_email",
						"std" => "",
						"type" => "text"),

				array(	"name" => __( 'Contact Page custom Markup<br/>(Can be used for Google Maps)', 'balsacentral' ),
						"desc" => __( 'Visit maps.google.com and copy your map location iFrame code. Paste it here. This will be shown on contact page template. Recommended dimensions for iframe <code>width="100%" height="320px"</code><br/>Tip: You can also use any custom markup or HTML here instead of Google Maps.', 'balsacentral' ),
						"id" => $shortname."_google_map",
						"std" => "",
						"type" => "textarea"),

				array(	"name" => __( 'Mail Sent Message:', 'balsacentral' ),
						"desc" => __( 'Enter a message that should be displayed when the mail is successfully sent.', 'balsacentral' ),
						"id" => $shortname."_success_msg",
						"std" => __( '<h4>Thank You! Your message has been sent.</h4>', 'balsacentral' ),
						"type" => "textarea"),

				array(	"name" => __( 'Custom Footer Text (Left)', 'balsacentral' ),
						"desc" => __( 'Enter custom text for left side of the footer. You can use <code>HTML</code> here.', 'balsacentral' ),
						"id" => $shortname."_footer_left",
						"std" => "&copy; 2012 CompanyName. All rights reserved.",
						"type" => "textarea"),

				array(	"name" => __( 'Custom Footer Text (Right)', 'balsacentral' ),
						"desc" => __( 'Enter custom text for right side of the footer. You can use <code>HTML</code> here.', 'balsacentral' ),
						"id" => $shortname."_footer_right",
						"std" => "Some other credits here.",
						"type" => "textarea"),

				array(  "name" => __( 'Hide Breadcrumbs', 'balsacentral' ),
						"desc" => __( 'Check to hide Breadcrumbs permanently.', 'balsacentral' ),
						"id" => $shortname."_hide_crumbs",
						"type" => "checkbox",
						"std" => false),

				array(  "name" => __( 'Hide Secondary Widget Area', 'balsacentral' ),
						"desc" => __( 'Check to hide secondary widget area on archives, category, search, author etc. You can control individual setting for Pages and Posts inside their options panel.', 'balsacentral' ),
						"id" => $shortname."_hide_secondary",
						"type" => "checkbox",
						"std" => false),

				array(	"type" => "tabbed_end" ),

				array(	"type" => "tabbed_start",
						"id" => $shortname."_header_area" ),

				array(	"name" => __( 'Header Settings', 'balsacentral' ),
						"type" => "subheading" ),

				array(	"name" => __( 'Custom head markup', 'balsacentral' ),
						"desc" => __( 'Use this section for inserting any custom CSS or script markup inside head node of the site. For example, Google Analytics code, Google font CSS, or custom scripts.', 'balsacentral' ),
						"id" => $shortname."_custom_head_code",
						"std" => "",
						"type" => "textarea"),

				/**
				 * 
				 * These options are disabled as they are hardcoded into header.php for better performance
				 *
				 */

				/*
				array(  "name" => __( 'Disable Top Navigation Bar ', 'balsacentral' ),
						"desc" => __( 'Check to disable top navigation bar.', 'balsacentral' ),
						"id" => $shortname."_top_bar_hide",
						"type" => "checkbox",
						"std" => false),

				array(	"name" => __( 'Top-right Callout Text', 'balsacentral' ),
						"desc" => __( 'Enter custom text that should appear on right side of top navigation bar.', 'balsacentral' ),
						"id" => $shortname."_cb_top_text",
						"std" => "Avail up to 70% discounts with our <a href=\"#\"><b>Coupon</b></a> and <a href=\"#\"><b>Affiliate</b></a> programs",
						"type" => "textarea"),

				array(  "name" => __( 'Disable Header Callout Bar ', 'balsacentral' ),
						"desc" => __( 'Check to disable the Callout bar.', 'balsacentral' ),
						"id" => $shortname."_cb_hide",
						"type" => "checkbox",
						"std" => false),

				array(	"name" => __( 'Header Callout Text', 'balsacentral' ),
						"desc" => __( 'Enter custom text that should appear on the Callout Bar.', 'balsacentral' ),
						"id" => $shortname."_cb_text",
						"std" => "This optional callout text can be set inside Appearance > balsacentral Options > Header.",
						"type" => "textarea"),

				array(  "name" => __( 'Display Blog Name', 'balsacentral' ),
						"desc" => __( 'Check to display blog name and description in place of Logo.', 'balsacentral' ),
						"id" => $shortname."_blog_name",
						"type" => "checkbox",
						"std" => false),

				array(	"name" => __( 'Custom Logo URL', 'balsacentral' ),
						"desc" => __( 'Enter full URL of your Logo image.', 'balsacentral' ),
						"id" => $shortname."_logo",
						"std" => "",
						"type" => "text"),

				array(	"name" => __( 'Logo Alignment', 'balsacentral' ),
						"desc" => __( 'Select an alignment for Logo. You can set margins inside style.css file.', 'balsacentral' ),
						"id" => $shortname."_logo_align",
						"std" => "left",
						"type" => "select",
						"options" => array("left", "right")),
				*/
				
				array(	"type" => "tabbed_end" ),

				array(	"type" => "tabbed_start",
						"id" => $shortname."_blog" ),

				array(	"name" => __( 'Archive Settings', 'balsacentral' ),
						"type" => "subheading" ),

				array(	"name" => __( 'Archives Template', 'balsacentral' ),
						"desc" => __( 'Select a template for default blog and archives.', 'balsacentral' ),
						"id" => $shortname."_archive_template",
						"std" => "grid_style",
						"type" => "select",
						"options" => array("grid_style", "list_style")),

				array(  "name" => __( 'Hide Post Meta', 'balsacentral' ),
						"desc" => __( 'Check to hide post meta information on blog archives and single post.', 'balsacentral' ),
						"id" => $shortname."_hide_post_meta",
						"type" => "checkbox",
						"std" => false),

				array(	"name" => __( 'Single Post Settings', 'balsacentral' ),
						"type" => "subheading" ),

				array(  "name" => __( 'Show Author Bio', 'balsacentral' ),
						"desc" => __( 'Check to display Author bio on single posts.', 'balsacentral' ),
						"id" => $shortname."_author",
						"type" => "checkbox",
						"std" => false),

				array(  "name" => __( 'Show related posts', 'balsacentral' ),
						"desc" => __( 'Check to display related posts on single posts.', 'balsacentral' ),
						"id" => $shortname."_rp",
						"type" => "checkbox",
						"std" => false),

				array(	"name" => __( 'Related posts taxonomy', 'balsacentral' ),
						"desc" => __( 'Select a taxonomy for related posts.', 'balsacentral' ),
						"id" => $shortname."_rp_taxonomy",
						"std" => "tags",
						"type" => "select",
						"options" => array("tags", "category")),

				array(	"name" => __( 'Related posts display style', 'balsacentral' ),
						"desc" => __( 'Select a display style for related posts.', 'balsacentral' ),
						"id" => $shortname."_rp_style",
						"std" => "thumbnail",
						"type" => "select",
						"options" => array("thumbnail", "list")),

				array(  "name" => __( 'Hide Tag List', 'balsacentral' ),
						"desc" => __( 'Check to hide tag list on Single Posts.', 'balsacentral' ),
						"id" => $shortname."_hide_tags",
						"type" => "checkbox",
						"std" => false),

				array(	"name" => __( 'Social Sharing Button Settings', 'balsacentral' ),
						"type" => "subheading" ),

				array(  "name" => __( 'Show Social Sharing Buttons', 'balsacentral' ),
						"desc" => __( 'Check to display social sharing on single posts.', 'balsacentral' ),
						"id" => $shortname."_ss_sharing",
						"type" => "checkbox",
						"std" => false),

				array(	"name" => __( 'Social Sharing Heading', 'balsacentral' ),
						"desc" => __( 'Enter a heading for sharing buttons. Example, Share this post.', 'balsacentral' ),
						"id" => $shortname."_ss_sharing_heading",
						"std" => "",
						"type" => "text"),

				array(  "name" => __( 'Facebook', 'balsacentral' ),
						"desc" => __( 'Check to display Facebook Like button.', 'balsacentral' ),
						"id" => $shortname."_ss_fb",
						"type" => "checkbox",
						"std" => false),

				array(  "name" => __( 'Twitter', 'balsacentral' ),
						"desc" => __( 'Check to display Twitter button.', 'balsacentral' ),
						"id" => $shortname."_ss_tw",
						"type" => "checkbox",
						"std" => false),

				array(	"name" => __( 'Twitter Username (optional)', 'balsacentral' ),
						"desc" => __( 'Write your twitter username without @', 'balsacentral' ),
						"id" => $shortname."_ss_tw_usrname",
						"std" => "",
						"type" => "text"),

				array(  "name" => __( 'Google Plus', 'balsacentral' ),
						"desc" => __( 'Check to display Google Plus button.', 'balsacentral' ),
						"id" => $shortname."_ss_gp",
						"type" => "checkbox",
						"std" => false),

				array(  "name" => __( 'Pinterest', 'balsacentral' ),
						"desc" => __( 'Check to display Pinterest button.', 'balsacentral' ),
						"id" => $shortname."_ss_pint",
						"type" => "checkbox",
						"std" => false),

				array(  "name" => __( 'LinkedIn', 'balsacentral' ),
						"desc" => __( 'Check to display LinkedIn button.', 'balsacentral' ),
						"id" => $shortname."_ss_ln",
						"type" => "checkbox",
						"std" => false),

				array(	"name" => __( 'Global Single Post Advertisements', 'balsacentral' ),
						"type" => "subheading" ),

				array(	"name" => __( 'Advertisement above the post', 'balsacentral' ),
						"desc" => __( 'Enter custom HTML or advertisement code that should appear above the post. Short codes are supported. The markup used here will apply to all posts globally.<br/>You can override or hide this ad on individual posts.', 'balsacentral' ),
						"id" => $shortname."_ad_above",
						"std" => "",
						"type" => "textarea"),

				array(	"name" => __( 'Advertisement below the post', 'balsacentral' ),
						"desc" => __( 'Enter custom HTML or advertisement code that should appear below the post. Short codes are supported. The markup used here will apply to all posts globally.<br/>You can override or hide this ad on individual posts.', 'balsacentral' ),
						"id" => $shortname."_ad_below",
						"std" => "",
						"type" => "textarea"),

				array(	"type" => "tabbed_end" ),
				array(	"type" => "wrap_end" )
);

function mytheme_add_admin() {
	global $themename, $shortname, $options;
		if ( isset($_GET['page']) && ($_GET['page'] == basename(__FILE__)) ) {
		 if ( isset($_REQUEST['action']) && ('save' == $_REQUEST['action']) ) {
				foreach ($options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
				header("Location:themes.php?page=theme-admin-options.php&saved=true");
				die;
		} else if( isset($_REQUEST['action']) && ('reset' == $_REQUEST['action'] )) {
			foreach ($options as $value) {
				delete_option( $value['id'] ); }
			header("Location:themes.php?page=theme-admin-options.php&reset=true");
			die;
		}
	}
	$hookname = add_theme_page( sprintf( __( '%1$s Options', 'balsacentral' ), $themename ), sprintf( __( '%1$s Options', 'balsacentral' ), $themename ), 'edit_theme_options', basename( __FILE__ ), 'mytheme_admin' );
	add_action( 'admin_print_scripts-' . $hookname, 'mytheme_admin_scripts' );
}
function mytheme_admin_scripts(){
	global $themename, $shortname, $options;
	// Load admin styling files.
	$file_dir = get_template_directory_uri();
	wp_enqueue_style("theme-admin-css", $file_dir."/css/admin.css", false, "1.0", "all");
	wp_enqueue_script("theme-admin-js", $file_dir."/js/admin.js", false, "1.0");
}
function mytheme_admin() {
    global $themename, $shortname, $options;
    if ( isset( $_REQUEST['saved'] ) && $_REQUEST['saved'] ) { ?>
		<div id="message" class="updated fade">
            <p><?php printf( __( '%1$s settings saved.', 'balsacentral' ), $themename ); ?></p>
        </div>
	<?php }
    if ( isset( $_REQUEST['reset'] ) && $_REQUEST['reset'] ) { ?>
		<div id="message" class="updated fade">
            <p><?php printf( __( '%1$s settings reset.', 'balsacentral' ), $themename ); ?></p>
        </div>
	<?php } ?>
<div class="wrap">
<div id="icon-themes" class="icon32"></div>
    <h2 class="settings-title"><?php echo $themename; ?> settings</h2>
    <form method="post">
		<?php foreach ($options as $value) {
            switch ( $value['type'] ) {

                case "wrap_start": ?>
                <div class="ss_wrap">
                <?php break;

                case "wrap_end": ?>
                </div>
                <?php break;

                case "tabs_start": ?>
                <ul class="tabs clear">
                <?php break;

                case "tabs_end": ?>
                </ul>
                <?php break;

                case "tabbed_start": ?>
                <div class="tabbed" id="<?php echo $value['id']; ?>">
                <?php break;

                case "tabbed_end": ?>
                </div>
                <?php break;

                case "heading": ?>
                <li><a href="#<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></li>
                <?php break;

                case "subheading": ?>
                <div class="subheading"><?php echo $value['name']; ?></div>
                <?php break;

                case 'select': ?>
                <ul class="item_row">
                    <li class="left_col"><?php echo $value['name']; ?></li>
                    <li class="mid_col">
                        <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                            <?php foreach ($value['options'] as $option) { ?>
                            <option <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
                            <?php } ?>
                        </select>
                    </li>
                    <li class="right_col">
                        <small><?php echo $value['desc']; ?></small>
                    </li>
                </ul>
                <?php break;

                case 'text':
                ?>
                <ul class="item_row">
                    <li class="left_col"><?php echo $value['name']; ?></li>
                    <li class="mid_col">
                        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
                    </li>
                    <li class="right_col">
                        <small><?php echo $value['desc']; ?></small>
                    </li>
                </ul>
                <?php break;

				case 'color_text':
                ?>
                <ul class="item_row">
                    <li class="left_col"><?php echo $value['name']; ?></li>
                    <li class="mid_col">
                        <input class="mycolor" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
                    <div id="pick_ico_<?php echo $value['id']; ?>" class="picker_ico">
                      <div></div>
                    </div>
                    </li>
                    <li class="right_col">
                        <small><?php echo $value['desc']; ?></small>
                    </li>
                </ul>

                <?php break;
                case 'textarea':
                ?>
                <ul class="item_row">
                    <li class="left_col"><?php echo $value['name']; ?></li>
                    <li class="mid_col">
                        <textarea class="code" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="30" rows="6"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo $value['std'];} ?></textarea>
                    </li>
                    <li class="right_col">
                        <small><?php echo $value['desc']; ?></small>
                    </li>
                </ul>
                <?php break;

                case "checkbox":
                ?>
                <ul class="item_row">
                    <li class="left_col"><?php echo $value['name']; ?></li>
                    <li class="mid_col">
                        <?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                    </li>
                    <li class="right_col">
                        <small><?php echo $value['desc']; ?></small>
                    </li>
                </ul>
                <?php break;
                }
            }
            ?>
            <p class="submit">
                <input class="button button-primary" name="save" type="submit" value="<?php _e( 'Save Settings', 'balsacentral' ); ?>" />
                <input type="hidden" name="action" value="save" />
            </p>
    </form>
    <form method="post">
        <p class="submit">
        <input class="button" name="reset" type="submit" value="<?php _e( 'Reset all Settings', 'balsacentral' ); ?>" />
        <input class="button button-primary" type="hidden" name="action" value="reset" />
        </p>
    </form>
</div>
<?php }
add_action('admin_menu', 'mytheme_add_admin'); ?>