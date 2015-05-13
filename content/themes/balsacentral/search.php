<?php
/* Search Template */

global $bcent_sb_pos;
get_header(); ?>
<div id="content"<?php if ( $bcent_sb_pos == 'left' ) echo (' class="content-right"'); ?> role="main">
	<?php show_breadcrumbs();
    if ( have_posts() ) :
		while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" class="entry clearfix">
            <h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
            <?php the_excerpt(); ?>
            </article><!-- #post-<?php the_ID(); ?> -->
		<?php endwhile; // End the loop
		if ( $wp_query->max_num_pages > 1 ) :?>
			<?php if ( function_exists( 'wp_pagenavi' ) ) wp_pagenavi();
            else { ?>
                <div class="navigation">
                    <div class="nav-previous"><?php next_posts_link( __( '&larr; Older Posts', 'balsacentral' ) ) ?></div>
                    <div class="nav-next"><?php previous_posts_link( __( 'Newer Posts &rarr;', 'balsacentral' ) ) ?></div>
                </div><!-- .navigation -->
            <?php }
		endif;
    else : ?>
        <div id="post-0" class="post no-results not-found">
            <h2 class="entry-title"><?php _e( 'Nothing Found!', 'balsacentral' ); ?></h2>
            <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'balsacentral' ); ?></p>
            <?php get_search_form(); ?>
        </div><!-- .post -->
    <?php endif; ?>
</div><!-- #content -->
<?php get_sidebar(); ?>
</div><!-- #primary .wrap -->
</div><!-- #primary -->
<?php get_footer(); ?>