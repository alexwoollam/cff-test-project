<?php
/**
 * Build front page if it dosnt exist.
 * This will build the frontpage if its  fresh install/new db.
 *
 * @package proagrica
 */

namespace CFF\App\Model\Pages;

/**
 * FrontPage class
 */
class FrontPage {

	/**
	 * Generate function
	 *
	 * @return void
	 */
	public static function generate() {
		$check_if_the_page_exists = get_page_by_title( 'Home Page', 'OBJECT', 'page' );
		if ( ! $check_if_the_page_exists ) {
			$post_details = [
				'post_title'    => 'Home Page',
				'post_content'  => 'Content of your page',
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_type'     => 'page',
			];
			wp_insert_post( $post_details );
		}
	}
}
