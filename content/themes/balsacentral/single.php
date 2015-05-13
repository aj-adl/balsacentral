<?php
/* Single Post Template */

global $bcent_sb_pos, $bcent_ad_above, $bcent_hide_post_meta, $bcent_hide_tags, $bcent_ss_sharing, $bcent_ss_sharing_heading, $bcent_author, $bcent_rp, $bcent_rp_taxonomy, $bcent_rp_style, $bcent_ad_below;
get_header(); ?>
<div id="content"<?php if ( $bcent_sb_pos == 'left' ) echo (' class="content-right"'); ?> role="main">
	<?php show_breadcrumbs();
    if (have_posts()) :
		while (have_posts()) : the_post();
			$post_opts = get_post_meta( $post->ID, 'post_options', true );
			$ad_above = (isset($post_opts['ad_above'])) ? $post_opts['ad_above'] : '';
			$ad_below = (isset($post_opts['ad_below'])) ? $post_opts['ad_below'] : '';
			$ad_above_check = (isset($post_opts['ad_above_check'])) ? $post_opts['ad_above_check'] : '';
			$ad_below_check = (isset($post_opts['ad_below_check'])) ? $post_opts['ad_below_check'] : '';
			$hide_meta = (isset($post_opts['hide_meta'])) ? $post_opts['hide_meta'] : '';
			if($ad_above_check == '') {
				if( !empty($bcent_ad_above) && $ad_above == '' ) { ?>
                    <div class="ad_code">
                    <?php echo do_shortcode(stripslashes($bcent_ad_above)); ?>
                    </div>
				<?php } // Global ad
				elseif( !empty($ad_above) ) { ?>
                    <div class="ad_code">
                    <?php echo do_shortcode(stripslashes($ad_above)); ?>
                    </div>
				<?php } //Ad Above
			} ?>
			<article id="post-<?php the_ID();?>" <?php post_class('entry clearfix'); ?> >
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <?php if($bcent_hide_post_meta != 'true') {
                if($hide_meta != 'true') {  ?>
                    <aside id="meta-<?php the_ID();?>" class="entry-meta"><?php balsacentral_post_meta(); ?></aside>
                <?php } // Hide Post meta on individual post
                } // Globally hide post meta
                if('audio' == get_post_format())
					get_template_part( 'formats/single-format', 'audio' );
                elseif('video' == get_post_format())
					get_template_part( 'formats/single-format', 'video' );
                elseif('gallery' == get_post_format())
					get_template_part( 'formats/single-format', 'gallery' );
                the_content();
                wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'balsacentral' ), 'after' => '</div>' ) );
                if ( $bcent_hide_tags != 'true' ) {
					if(get_the_tag_list()) {
					printf( __( '<span class="tag-label">Tagged</span> %1$s', 'balsacentral' ), get_the_tag_list('<ul class="tag-list"><li>','</li><li>','</li></ul>') );
					}
                } // Hide Tags ?>
			</article><!-- #post-<?php the_ID();?> -->
			<?php if($bcent_ss_sharing == 'true') { ?>
                <div class="ss_sharing_container clearfix">
					<?php if(!empty($bcent_ss_sharing_heading)) echo stripslashes('<h4>'.$bcent_ss_sharing_heading.'</h4>');
                    ss_sharing(); ?>
                </div><!-- .ss_sharing_container -->
			<?php } // Social Sharing
			if ( $bcent_author == 'true' ):
				if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
                    <div class="entry clearfix">
                        <div id="author-avatar">
							<?php $dir = get_template_directory_uri();
                            $default_avatar = $dir . '/images/default_avatar.jpg';
                            echo get_avatar( get_the_author_meta( 'user_email' ), $size='80', $default = $default_avatar ); ?>
                        </div><!-- #author-avatar -->
                        <div id="author-description">
                            <h4><?php printf( esc_attr__( 'About %s', 'balsacentral' ), get_the_author() ); ?></h4>
                            <p><?php the_author_meta( 'description' ); ?></p>
                            <p><a class="more-link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php printf( __( 'View all posts by %s &rarr;', 'balsacentral' ), get_the_author() ); ?></a></p>
                        </div><!-- #author-description -->
                    </div><!-- .entry author-->
				<?php endif; // Has Bio
			endif; // Show Author Bio
			if ( $bcent_rp == 'true' )
				balsacentral_related_posts( $bcent_rp_taxonomy, $bcent_rp_style );
			if($ad_below_check == '') {
				if( !empty($bcent_ad_below) && $ad_below == '' ) { ?>
                    <div class="ad_code">
                    <?php echo do_shortcode(stripslashes($bcent_ad_below)); ?>
                    </div>
				<?php } // Global ad
				elseif( !empty($ad_below) ) { ?>
                    <div class="ad_code">
                    <?php echo do_shortcode(stripslashes($ad_below)); ?>
                    </div>
				<?php } // Ad below
			} // Show ad below
			comments_template( '', true );
		endwhile;
    else : ?>
    <h2><?php _e( 'Not Found', 'balsacentral' ); ?></h2>
    <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'balsacentral' ); ?></p>
    <?php endif; ?>
</div><!-- #content -->
<?php get_sidebar(); ?>
</div><!-- #primary .wrap -->
</div><!-- #primary -->
<?php get_footer(); ?>