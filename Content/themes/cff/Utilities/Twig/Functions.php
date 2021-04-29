<?php
/**
 * This file add filters and functions to view.
 * There is a additional folder we can add functions to also in this dir.
 *
 * @package proagrica
 */

namespace CFF\Utilities\Twig;

use CFF\Utilities\Core\Images;
use Timber\Twig_Filter;
use Timber\Twig_Function;

/**
 * Add custom timber/twig functions in here.
 */
class Functions {

	/**
	 * Autofire function.
	 */
	function __construct() {
		add_filter( 'get_twig', [ $this, 'add_to_twig' ] );
		add_filter( 'get_twig', [ $this, 'add_twig_image' ] );
	}

	/**
	 * Add function or filter to view
	 *
	 * @param [type] $twig is timber.
	 * @return mixed
	 */
	function add_to_twig( $twig ): \Twig\Environment
	{
		// Adding a demo function.
		$twig->addFilter( new Twig_Filter( 'whateverify', function( $text ) {
			$text .= ' or whatever';
			return $text;
		} ) );
		return $twig;
	}

	/**
	 * Add image function.
	 */
	function add_twig_image( $twig ): \Twig\Environment
	{
		$twig->addFunction( new Twig_Function( 'image', function( int $id ) {
			
			$img = wp_get_attachment_image_src( $id );
			$image_url = $img[0];
			dd((new Images)->getImage( $image_url ));
			$image = new Images;
			$image->getImage( $image_url );			

		} ) );
		return $twig;
	}
}
