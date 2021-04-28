<?php

namespace CFF\App\Controller;

use Timber\Timber;

/**
 * Front page constructor/presentor.
 */
class FrontPage implements PageInterface {

	/**
	 * Undocumented variable
	 *
	 * @var array
	 */
	public $static = [
		'title'    => 'This is the home page',
		'subtitle' => 'hit homepage',
		'content'  => 'you hit the home page, welldone',
	];

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
		Timber::render( [ 'homepage.twig' ], $provide );
	}

}

new FrontPage;
