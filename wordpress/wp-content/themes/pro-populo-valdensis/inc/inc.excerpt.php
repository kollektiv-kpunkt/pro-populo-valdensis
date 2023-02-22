<?php
function ppv_get_excerpt( $args = array() ) {

	// Default arguments.
	$defaults = array(
		'post'            => '',
        'length'          => 55,
		'readmore'        => false,
		'readmore_text'   => esc_html__( 'En savoir plus', 'ppv' ),
		'readmore_after'  => '',
		'custom_excerpts' => true,
		'disable_more'    => false,
	);

	// Parse arguments, takes the function arguments and combines them with the defaults.
	$args = wp_parse_args( $args, $defaults );

	// Apply filters to allow child themes mods.
	$args = apply_filters( 'ppv_excerpt_args', $args );

	// Extract arguments to make it easier to use below.
	extract( $args );

	// Get the current post.
    $post = get_post( $post );

	// Get the current post id.
	$post_id = $post->ID;

    // Create the readmore link.
    $readmore_link = '<a href="' . esc_url( get_permalink( $post_id ) ) . '" class="readmore">' . $readmore_text . $readmore_after . '</a>';

    // Check if the post has a custom excerpt.
    if ( $custom_excerpts && has_excerpt( $post_id ) ) {

        // Get the custom excerpt.
        $output = $post->post_excerpt;

        // Add the readmore text to the excerpt if enabled.
        if ( $readmore ) {

            $output .= apply_filters( 'ppv_readmore_link', $readmore_link );

        }

    }

    // No more tag defined so generate excerpt using wp_trim_words.
    else {

        // Generate an excerpt from the post content.
        $output = wp_trim_words( strip_shortcodes( $post->post_content ), $length, " [...]" );

        // Add the readmore text to the excerpt if enabled.
        if ( $readmore ) {

            $output .= apply_filters( 'ppv_readmore_link', $readmore_link );

        }

    }

	// Apply filters and return the excerpt.
	return apply_filters( 'ppv_excerpt', $output );

}