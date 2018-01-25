<?php

/**
 * Gets the contents of the Create React App manifest file
 *
 * @return array|bool|string
 */

function get_artism_manifest() {
	$manifest = file_get_contents( get_template_directory_uri() . '/frontend/build/asset-manifest.json' );
	$manifest = (array) json_decode( $manifest );
	return $manifest;
}

/**
 * Gets the path to the stylesheet compiled by Create React App
 *
 * @return string
 */

function get_artism_stylesheet() {
	$manifest = get_artism_manifest();
	return get_template_directory_uri() . '/frontend/build/' . $manifest['main.css'];
}

/**
 * Gets the path to the built javascript file compiled by Create React App
 *
 * @return string
 */

function get_artism_script() {
	$manifest = get_artism_manifest();
	return get_template_directory_uri() . '/frontend/build/' . $manifest['main.js'];
}

/**
 * Enqueues the scripts
 */
add_action( 'wp_enqueue_scripts', function() {
	enqueue_artism_portfolio();
} );

/**
 * Enqueues the stylesheet and js
 */
function enqueue_artism_portfolio() {
	wp_enqueue_script( 'artism-portfolio', get_artism_script(), array(), false, true );
	wp_enqueue_style( 'artism-portfolio', get_artism_stylesheet(), array(), false, false );
}