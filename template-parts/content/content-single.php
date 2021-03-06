<?php
/**
 *
 * @package mokime
 */

/**
 * The column width if sidebar exists.
 */
$column_width = is_active_sidebar( 'sidebar-single' ) ? 70 : 100; ?>

<article <?php post_class( 'post' ); ?> id="post-<?php the_ID(); ?>">

	<header class="article-header">
		<?php get_template_part( 'template-parts/entry/entry-header' ); ?>
		<?php $header_image = get_the_post_thumbnail_url( null, 'large' ); ?>
	</header><!-- .article-header -->

	<?php mokime_the_ads( 'advertising_global_top' ); ?>

	<div class="entry-content">

		<div class="wp-block-columns">

			<div class="wp-block-column wp-block-column-<?php echo esc_html( $column_width ); ?>">

				<div class="wp-block-columns">

					<div class="wp-block-column wp-block-column-70">
						<?php get_template_part( 'template-parts/entry/entry-breadcrumb' ); ?>
					</div><!-- .wp-block-column-70 -->

					<div class="wp-block-column wp-block-column-30 has-text-align-right">
						<?php get_template_part( 'template-parts/entry/entry-comment-number' ); ?>
					</div><!-- .wp-block-column-30 -->

				</div><!-- .wp-block-columns -->

				<div class="post-inner">
					<?php the_content(); ?>
				</div><!-- .post-inner -->

				<footer class="section-inner post-metadata">
					<?php
					get_template_part( 'template-parts/entry/entry-article-dates' );
					if ( (bool) get_theme_mod( 'single_post_nav_posts', true ) ) {
						get_template_part( 'template-parts/navigation' );
					}
					get_template_part( 'template-parts/entry/entry-author-bio' );
                    mokime_the_ads( 'advertising_post_comments_top' );
					?>
				</footer><!-- .post-metadata -->

				<?php
				if ( ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
					?>
					<div class="comments-wrapper section-inner">
						<?php comments_template(); ?>
					</div><!-- .comments-wrapper -->
					<?php
				}
				?>
			</div><!-- .wp-block-column -->

			<?php if ( is_active_sidebar( 'sidebar-single' ) ) : ?>

				<aside role="complementary" id="widget" class="widget-single wp-block-column wp-block-column-30">

					<div
						<?php
						if ( (bool) get_theme_mod( 'single_post_sidebar_sticky', false ) ) :
							?>
							class="sticky"<?php endif ?>>

						<?php dynamic_sidebar( 'sidebar-single' ); ?>

					</div>

				</aside><!-- widget-single -->

			<?php endif; ?>

		</div><!-- .wp-block-columns -->

	</div><!-- .entry-content -->

</article><!-- .post -->
