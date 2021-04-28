<?php
/**
 * Use this file to add global contexts to the view.
 *
 * @package proagrica
 */

namespace CFF\Utilities\Twig;

/**
 * Add custom global variables to the view.
 */
class GlobalContext {

	/**
	 * Autofire class.
	 */
	function __construct() {
		add_filter( 'timber_context', [ $this, 'add_to_context' ] );
	}

	/**
	 * Add global variables to twig function
	 *
	 * @param [type] $context whatever we return here will be in the global context.
	 * @return mixed returns back to timber.
	 */
	function add_to_context( $context ) {
		$context['demo_context'] = 'Simple demo of global context.';
		return $context;
	}
}
