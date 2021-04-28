<?php
/**
 * General page generator, if the page requested dosnt exist.
 *
 * TODO: Build page content if using Gutenberg.
 *
 * @package: proagrica
 */

namespace CFF\App\Model\Pages;

/**
 * Page class
 */
class Page {

	/**
	 * Generate function
	 *
	 * @param [string] $title - the page title.
	 * @return void
	 */
	public static function generate( $title ) {
		$check_if_the_page_exists = get_page_by_title( $title, 'OBJECT', 'page' );
		if ( ! $check_if_the_page_exists ) {
			$post_details = [
				'post_title'    => $title,
				'post_content'  => 'Content of your page',
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_type'     => 'page',
			];
			wp_insert_post( $post_details );
		}
	}
}
