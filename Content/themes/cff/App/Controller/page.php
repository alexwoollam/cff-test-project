<?php
/**
 * Default Page
 * The default page layout.
 *
 * @package proagrica
 */

namespace CFF\App\Controller;

use Timber\Timber;

/**
 * Page class
 */
class Page implements PageInterface {

	/**
	 * Adding static content for demo and fallback sake. (take this from the design.)
	 *
	 * @var array
	 */
	public $static = [
		'title'    => 'page fallback',
		'subtitle' => 'fallback subtitle',
		'content'  => 'fallback content',
	];

	/**
	 * Passing variable, all of this goes to the front end.
	 *
	 * @var [array] Mixed content sent to the front end.
	 */
	protected $provide;

	/**
	 * Autofire function
	 */
	public function __construct() {
		$this->provide             = Timber::get_context();
		$this->provide['fallback'] = $this->static;
		$this->render();
	}

	/**
	 * Render function.
	 * This defines where we send the frontend.
	 *
	 * @return void
	 */
	public function render(): void {
		Timber::render( [ 'index.twig' ], $this->provide );
	}
}

new Page;
