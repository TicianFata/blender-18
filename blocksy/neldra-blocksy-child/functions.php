<?php
/**
 * Neldra (Blocksy Child) — functions.
 *
 * @package NeldraBlocksyChild
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load the parent (Blocksy) styles, then this child's style.css so your
 * tweaks always win. This is the update-safe place for custom CSS/PHP.
 */
add_action( 'wp_enqueue_scripts', function () {
	// Blocksy prints its own styles independently; we just add the child sheet.
	wp_enqueue_style(
		'neldra-child',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}, 20 );

/**
 * Add your custom PHP here — e.g. extra shortcodes, Blocksy hooks, template
 * tweaks. Keep the animated sections in the "Neldra Sections" plugin so they
 * survive if you ever change themes.
 */
