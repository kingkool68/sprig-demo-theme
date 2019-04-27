<?php
/**
 * Various functions
 *
 * @package Russell Heimlich
 */

$files_to_require = array(
	'class-rh-helpers.php',
	'class-rh-archive-items.php',
	'class-rh-pagination.php',
);
foreach ( $files_to_require as $filename ) {
	$file = get_template_directory() . '/functions/' . $filename;
	if ( file_exists( $file ) ) {
		require_once $file;
	}
}

/**
 * Add the styleguide directory to the known directories Sprig should look
 * for Twig files to render
 *
 * @param  array  $paths Places Twig should look for Twig files
 * @return array         Modified paths
 */
function filter_sprig_roots( $paths = array() ) {
	$paths[] = get_template_directory() . '/styleguide';
	return $paths;
}
add_filter( 'sprig/roots', 'filter_sprig_roots' );

function action_wp_enqueue_scripts() {
	wp_enqueue_style( 'styles', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'action_wp_enqueue_scripts' );
