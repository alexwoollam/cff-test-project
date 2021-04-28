<?php

namespace CFF\App\Controller;

use Timber\Timber;

/**
 * Front page constructor/presentor.
 */
class FourOhFour implements PageInterface {

	/**
	 * Undocumented variable
	 *
	 * @var array
	 */
	public $static = [
		'title'    => '404, Page not found',
		'subtitle' => 'hit 404 page',
		'content'  => 'you hit the 404 page.. hopefully on purpose',
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
		Timber::render( [ '404.twig' ], $this->provide );
	}

}

new FourOhFour;

