<?php
/**
 * Custom comment walker for this theme.
 *
 * @package WordPress
 * @subpackage MokiMe
 * @from Twenty_Twenty
 * @since 1.0.0
 */

if ( ! class_exists( 'MokiMe_Walker_Comment' ) ) {
	/**
	 * CUSTOM COMMENT WALKER
	 * A custom walker for comments, based on the walker in Twenty Nineteen.
	 */
	class MokiMe_Walker_Comment extends Walker_Comment {

		/**
		 * Outputs a comment in the HTML5 format.
		 *
		 * @see wp_list_comments()
		 * @see https://developer.wordpress.org/reference/functions/get_comment_author_url/
		 * @see https://developer.wordpress.org/reference/functions/get_comment_author/
		 * @see https://developer.wordpress.org/reference/functions/get_avatar/
		 * @see https://developer.wordpress.org/reference/functions/get_comment_reply_link/
		 * @see https://developer.wordpress.org/reference/functions/get_edit_comment_link/
		 *
		 * @param WP_Comment $comment Comment to display.
		 * @param int        $depth   Depth of the current comment.
		 * @param array      $args    An array of arguments.
		 */
		protected function html5_comment( $comment, $depth, $args ) {

			$tag            = ( 'div' === $args['style'] ) ? 'div' : 'li';
			$comment_author = get_comment_author( $comment );

			echo '<' . $tag; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>

			<article id="div-comment-<?php comment_ID(); ?>" class="media comment-body">

				<?php $avatar = get_avatar( $comment, 48, '', $comment_author ); ?>
				<?php if ( 0 !== $args['avatar_size'] ) : ?>
					<figure class="media-left">
						<p class="image">
							<?php echo wp_kses_post( $avatar ); ?>
						</p> <!-- .image -->
					</figure><!-- .media-left -->
				<?php endif; ?>

				<div class="media-content">

					<?php

					$post_author    = '';
					$by_post_author = mokime_is_comment_by_post_author( $comment );

					if ( $by_post_author ) {
						$post_author = ' <span class="by-post-author tag tag-primary">' . __( 'Post Author', 'mokime' ) . '</span>';
					}

					/* Translators: 1 = comment date, 2 = comment time */
					$comment_timestamp = sprintf( __( '%1$s at %2$s', 'mokime' ), get_comment_date( 'l j F Y', $comment ), get_comment_time() );

					ob_start();

					?>
					<small class="tag">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php echo esc_html( $comment_timestamp ); ?>
						</time>
					</small>
					<?php

					$output = ob_get_contents();

					ob_get_clean();

					printf(
						'<p><span>%1$s</span><span >%2$s</span> %3$s</p>',
						esc_html( $comment_author ),
						//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						$output,
						//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						$post_author
					);

					?>
					<span>
						<?php comment_text(); ?>
					</span>

					<?php

					if ( '0' === $comment->comment_approved ) :
						?>
					<p class="comment-awaiting-moderation">
						<?php __( 'Your comment is awaiting moderation.', 'mokime' ); ?>
					</p>
					<?php endif; ?>

					<div class="comment-metadata">
						<?php

						$comment_reply_link = get_comment_reply_link(
							array_merge(
								$args,
								array(
									'add_below' => 'div-comment',
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
									'before'    => '<span class="comment-reply has-regular-font-size">',
									'after'     => '</span>',
								)
							)
						);
						?>
						<p>
							<?php
							if ( get_edit_comment_link() ) {
								printf(
									'<a class="comment-edit-link has-regular-font-size" href="%s">%s</a> <span aria-hidden="true">&bull;</span> ',
									esc_url( get_edit_comment_link() ),
									esc_html__( 'Edit', 'mokime' )
								);
							}

							if ( $comment_reply_link ) {
								echo wp_kses_post( $comment_reply_link );
							}

							echo sprintf(
								' &bull; <a href="%1$s" class="has-regular-font-size">%2$s</a>',
								esc_url( get_comment_link( $comment, $args ) ),
								esc_html__( 'Link to the comment', 'mokime' )
							);
							?>
						</p>

					</div><!-- .comment-metadata -->

				</div><!-- .media-content -->

			</article><!-- .comment-body -->

			<?php
		}
	}
}
