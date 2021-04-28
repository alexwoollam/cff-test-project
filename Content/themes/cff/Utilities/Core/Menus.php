<?php
/**
 * Menus.
 * Generates default menus.
 * Feel free to deactivate in production,
 * or update to live case once in used.
 *
 * @package proagrica
 */

namespace CFF\Utilities\Core;

/**
 * Menus class
 */
class Menus {

	/**
	 * Setting the titles for the default menu locations.
	 *
	 * @var array
	 */
	public $default_location_names = [
		'primary',
		'footer',
	];

	/**
	 * Setting name of the default primary menu.
	 *
	 * @var string
	 */
	public $default_menu_name = 'primary menu';

	/**
	 * Add menu items here (lowercase).
	 *
	 * @var array
	 */
	public $default_menu_items = [
		'home',
		'about',
		'history',
		'contact',
	];

	/**
	 * Autofire
	 * iterates location array, to build locations.
	 * iterates menu items, adds them to the default menu.
	 */
	function __construct() {
		add_theme_support( 'menus' );

		foreach ( $this->default_location_names as $default_location_name ) {
			$this->set_locations( $default_location_name );
		}

		if ( ! wp_get_nav_menu_object( $this->default_menu_name ) ) {
			$this->generate_default_menu();
		}
	}

	/**
	 * Set locations function
	 *
	 * Generates the menu locations.
	 *
	 * @param [string] $location_name - these are the location names.
	 * @return void
	 */
	function set_locations( $location_name ) {
		if ( ! has_nav_menu( $location_name ) ) {
			register_nav_menu( $location_name, $location_name );
		}
	}

	/**
	 * Generate default menus function
	 *
	 * Scaffolds the default menu based on menu items array set in this file.
	 *
	 * @return void
	 */
	function generate_default_menu() {
		$menu_id = wp_create_nav_menu( $this->default_menu_name );
		foreach ( $this->default_menu_items as $item ) {
			wp_update_nav_menu_item(
				$menu_id, 0, [
					'menu-item-title'   => ucwords( $item ),
					'menu-item-classes' => strtolower( $item ),
					'menu-item-url'     => home_url( '/' . strtolower( $item ) ),
					'menu-item-status'  => 'publish',
				]
			);
		}

		if ( ! has_nav_menu( 'primary' ) ) {
			$locations            = get_theme_mod( 'nav_menu_locations' );
			$locations['primary'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}
}
