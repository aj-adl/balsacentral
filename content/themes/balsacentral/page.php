<?php
/* Page Template */

global $bcent_sb_pos;
get_header(); ?>
<div id="content"<?php if ( $bcent_sb_pos == 'left' ) echo (' class="content-right"'); ?> role="main">
	<?php show_breadcrumbs();
    if (have_posts()) :
		while (have_posts()) : the_post(); ?>
			<?php the_content( __( 'More &rarr;', 'balsacentral' ) );
            wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'balsacentral' ), 'after' => '</div>' ) );
		endwhile;
    else : ?>
    <h2><?php _e( 'Not Found', 'balsacentral' ); ?></h2>
    <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'balsacentral' ); ?></p>
<?php endif;?>
</div><!-- #content -->
<?php get_sidebar(); ?>
</div><!-- #primary .wrap -->
</div><!-- #primary -->
<?php get_footer(); ?>