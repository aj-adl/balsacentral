<?php
/* Index Template */

global $bcent_archive_template, $bcent_sb_pos;
get_header();
$content_id = ($bcent_archive_template == 'grid_style') ? 'content-grid' : 'content'; ?>
  <div id="<?php echo $content_id; ?>"<?php if ( $bcent_sb_pos == 'left' ) echo (' class="content-right"'); ?> role="main">
	<?php show_breadcrumbs();
    if( $bcent_archive_template == 'list_style' )
		get_template_part( 'content-list' );
    else
		get_template_part( 'content' ); ?>
</div><!-- #content -->
<?php get_sidebar(); ?>
</div><!-- #primary .wrap -->
</div><!-- #primary -->
<?php get_footer(); ?>