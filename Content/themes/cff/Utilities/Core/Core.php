<?php
/**
 * Theme core. treat like the kernal.
 *
 * @package proagrica
 */

namespace CFF\Utilities\Core;

use CFF\Utilities\Twig;

/**
 * Core loader class
 * Loads subclasses.
 */
class Core {

	/**
	 * Init the theme.
	 */
	function __construct() {
	
		new Acf;
		new Menus;
		new Enqueue;
		new Twig\Functions;
		new Twig\GlobalContext;
		
	}
}
