<?php
/**
 * This file add filters and functions to view.
 * There is a additional folder we can add functions to also in this dir.
 *
 * @package proagrica
 */

namespace CFF\Utilities\Twig;

use Timber\Twig_Filter;

/**
 * Add custom timber/twig functions in here.
 */
class Functions {

	/**
	 * Autofire function.
	 */
	function __construct() {
		add_filter( 'get_twig', [ $this, 'add_to_twig' ] );
	}

	/**
	 * Add function or filter to view
	 *
	 * @param [type] $twig is timber.
	 * @return mixed
	 */
	function add_to_twig( $twig ) {
		// Adding a demo function.
		$twig->addFilter( new Twig_Filter( 'whateverify', function( $text ) {
			$text .= ' or whatever';
			return $text;
		} ) );
		return $twig;
	}
}
