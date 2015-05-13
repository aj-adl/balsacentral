<?php
/* Header Template */

global $bcent_scheme, $bcent_blog_name, $bcent_logo;
$dir = get_template_directory_uri(); ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?> class="no-js">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?> class="no-js">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<meta name="p:domain_verify" content="7a9f6dd56a1ac792a7f36c7db1253c10"/>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-34958731-1', 'balsacentral.com');
  ga('require', 'linkid', 'linkid.js');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>
</head>
<?php $new_body_class = ' no-border'; ?>
<body <?php body_class($new_body_class); ?>>
    <nav id="top-menu" class="ss_nav_top">
        <div class="wrap clearfix">
        <?php wp_nav_menu( array( 'container' => false, 'menu_class' => 'nav2', 'theme_location' => 'secondary', 'fallback_cb' => 'menu_reminder', 'walker' => new Arrow_Walker_Nav_Menu ) ); ?>
        <?php if (class_exists( 'woocommerce' ))
                get_template_part('woocommerce/account-bar'); ?> <!-- #account-bar -->
        </div><!-- #top-menu .wrap -->
    </nav><!-- #top-menu-->
    <div id="container">
        <div id="utility">
            <div class="wrap clearfix"></div> <!-- #utlity .wrap -->
        </div><!-- #utility //left for future use (callouts, flash sales etc) -->
        <div id="header">
            <div class="wrap clearfix">
                <div class="brand" role="banner">
                    <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="http://img.balsacentral.net/balsa-central-logo.jpg" alt="Online Balsa Wood Store – Balsacentral.com" /></a></h1>
                </div><!-- .brand -->
                <?php get_template_part('includes/header-widget-area'); ?>
            </div><!-- #header .wrap -->
        </div><!-- #header -->
        <nav id="access" class="ss_nav clearfix" role="navigation">
            <div class="wrap clearfix">
            <?php //Display primary menu, with check for optional "Second Row" of the primary menu for manual splitting
                wp_nav_menu( array( 'container' => false, 'menu_class' => 'nav1', 'theme_location' => 'primary', 'fallback_cb' => 'menu_reminder', 'walker' => new Arrow_Walker_Nav_Menu ) ); 
                if (has_nav_menu('primary-second-row')){
                    wp_nav_menu( array( 'container' => false, 'menu_class' => 'nav1 second_row', 'theme_location' => 'primary-second-row', 'fallback_cb' => 'menu_reminder', 'walker' => new Arrow_Walker_Nav_Menu ) );
                }
            ?>
            </div><!-- #access .wrap -->
        </nav><!-- #access -->
        <div id="primary">
        <div class="wrap clearfix">