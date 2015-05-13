<?php
/* 404 Template */
global $bcent_sb_pos;
get_header(); ?>
<div id="content"<?php if ( $bcent_sb_pos == 'left' ) echo (' class="content-right"'); ?> role="main">
<?php show_breadcrumbs(); ?>
    <div id="post-0" class="post error404 not-found">
        <h2><?php _e( 'Not Found!', 'balsacentral' ); ?></h2>
        <p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'balsacentral' ); ?></p>
        <?php get_search_form(); ?>
    </div><!-- #post-0 -->
</div><!-- #content -->
<?php get_sidebar(); ?>
</div><!-- #primary .wrap -->
</div><!-- #primary -->
<?php get_footer(); ?>