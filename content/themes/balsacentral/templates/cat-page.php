<?php
/*
Template Name: Market Category Page
*/

get_header(); ?>
<div id="content" class="full-width" role="main" >
    <?php show_breadcrumbs();
    if (have_posts()) {
        while (have_posts()) : the_post(); ?>
            <?php the_content( __( 'More &rarr;', 'balsacentral' ) );
            wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'balsacentral' ), 'after' => '</div>' ) );
        endwhile; ?>
</div><!-- #content2 -->
       <?php //meow
        $cats = get_field('product_categories');

        if ($cats) {

            $args = array(
                    'post_type' => 'product',
                    'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'terms'    => $cats,
                                    ),
                        ),
                );

            $cat_q = new WP_Query( $args );

            if ( $cat_q->have_posts() ) { ?>

<div id="content2" role="main" >

            <?php /**
                 * woocommerce_before_shop_loop hook
                 *
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action( 'woocommerce_before_shop_loop' );
                woocommerce_product_loop_start();

                woocommerce_product_subcategories();

                while ( $cat_q->have_posts() ) : $cat_q->the_post();

                    wc_get_template_part( 'content', 'product' );

                endwhile; // end of the loop.

                woocommerce_product_loop_end();
                /**
                 * woocommerce_after_shop_loop hook
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action( 'woocommerce_after_shop_loop' );
            } else {

                wc_get_template( 'loop/no-products-found.php' );
            }

            wp_reset_postdata();
        } 
    } else { ?>
        <h2><?php _e( 'Not Found', 'balsacentral' ); ?></h2>
        <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'balsacentral' ); ?></p>
    <?php } ?>
</div><!-- #content 1 or 2 depending on results -->
<?php get_sidebar(); ?>
</div><!-- #primary .wrap -->
</div><!-- #primary -->
<?php get_footer(); ?>