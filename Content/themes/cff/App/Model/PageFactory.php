<?php
/**
 * Page factory, This is scaffold/generate pages listed here.
 * Mostly for blank installs, and tests. remove once happy.
 *
 * @package proagrica 
 */

namespace CFF\App\Model;

use CFF\App\Model\Pages;

/**
 * PageFactory class
 */
class PageFactory {

	/**
	 * List pages you want to create here.
	 *
	 * @var array
	 */
	public $pages_to_generate = [
		'About',
		'Contact',
		'History',
	];

	/**
	 * Autofire function
	 */
	function __construct() {
		$frontpage = new Pages\FrontPage;
		$frontpage->generate();

		foreach ( $this->pages_to_generate as $page_title ) {
			$page = new Pages\Page;
			$page->generate( $page_title );
		}
	}
}
