<?php
/**
 * Forced route demo - Dosnt nesseseraily need to be in this folder.
 *
 * @package proagrica
 */
namespace CFF\App\Controller\Forced;

use Timber\Timber;

/**
 * ForedRoiute class template
 */
class ForcedRoute {

	/**
	 * Remove this, static text demo.
	 *
	 * @var array
	 */
	public $static = [
		'title'    => 'Forced route page',
		'subtitle' => 'hit forced route',
		'content'  => 'Good for static pages',
	];

	/**
	 * Context variable
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
	 * Render function
	 * Pass variables to render view file.
	 *
	 * @return void
	 */
	public function render() {
		Timber::render( 'page.twig', $this->provide );
	}

}

new ForcedRoute;
