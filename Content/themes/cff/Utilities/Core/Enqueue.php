<?php
/**
 * Enqueue all styles and scripts.
 * TODO: We could probably refactor this a bit slicker.
 * 
 * @package proagrica
 */

namespace CFF\Utilities\Core;

use function theme_script_directory_uri;
use function theme_style_directory_uri;

/**
 * Enqueue class.
 * Loads all of our JS and styles.
 */
class Enqueue {

	/**
	 * Autofire function.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'scripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
	}

	/**
	 * Enque admin scripts function
	 *
	 * @return mixed
	 */
	public function admin_scripts() {
		wp_enqueue_style(
			'select2', theme_style_directory_uri() . '/select2.css', [], THEME_VERSION
		);

		wp_enqueue_script(
			'select2', theme_script_directory_uri() . '/select2.js', [ 'jquery' ],
			THEME_VERSION, true
		);

		wp_enqueue_script(
			'home-again-custom-js', theme_script_directory_uri() . '/custom.js', [],
			THEME_VERSION, true
		);
	}

	/**
	 * Enqueue frontend scripts and styles.
	 *
	 * @return mixed
	 */
	public function scripts() {
		global $post;
		wp_enqueue_style( 'site-style', theme_style_directory_uri() . '/site.css' . '?v=' . time() );
	}

	// TODO: look at a better cache busting method.
}

new Enqueue;
