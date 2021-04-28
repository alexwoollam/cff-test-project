<?php
/**
 * About page. Demo page.
 *
 * @package proagrica
 */

namespace CFF\App\Controller\Page;

use CFF\App\Controller\PageInterface;
use Timber\Timber;

/**
 * About class, fleshes out the about page.
 */
class About implements PageInterface {

	/**
	 * Static demo content.
	 * remove this.
	 *
	 * @var array
	 */
	public $static = [
		'title'    => 'about page',
		'subtitle' => 'hit about index',
		'content'  => 'you hit the about page, check the routing',
	];

	/**
	 * This variable provides the context to view.
	 *
	 * @var [array]
	 */
	public $provide;

	/**
	 * Autofire function
	 */
	public function __construct() {
		$this->provide = Timber::get_context();
		$this->provide['fallback'] = $this->static;
		$this->render();
	}

	/**
	 * Render function, points at the view file to render,
	 * with the context variables provided.
	 *
	 * @return void
	 */
	public function render(): void {
		Timber::render( [ 'about.twig' ], $this->provide );
	}
}

new About;
