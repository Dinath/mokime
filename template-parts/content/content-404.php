<?php

$recent_posts = get_the_last_posts( 3 );

if ( $recent_posts ) {

	echo '<h2 class="title has-text-weight-light has-margin-bottom-0">' . __( 'Nos derniers articles', 'mokime' ) . '</h2>';
	echo '<div class="wp-block-columns">';

	foreach ( $recent_posts as $index => $post ) {

		if ( $index !== 0 && ( $index % 3 ) === 0 ) {
			echo '</div><!-- .wp-block-columns --><div class="has-margin-top-3 wp-block-columns">';
		}

		setup_postdata( $post );
		get_template_part( 'template-parts/entry/entry-article' );
	}

	wp_reset_postdata();

	echo '</div><!-- .wp-block-columns -->';
}

wp_reset_query();
