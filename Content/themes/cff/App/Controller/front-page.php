<?php

namespace CFF\App\Controller;

use Timber\Timber;

/**
 * Front page constructor/presentor.
 */
class FrontPage implements PageInterface {

	public string $cacheKey;
	public $home_page_content;
	
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
		$this->cacheKey = 'home_page';
		$this->home_page_content = wp_cache_get( $this->cacheKey );		
		if(!$this->home_page_content){
			$this->home_page_content = $this->static;
			wp_cache_set( $this->cacheKey, $this->home_page_content );
		}

		$this->provide         = Timber::get_context();
		$this->provide['page'] = $this->home_page_content;
		$this->render();
	}

	/**
	 * Render function.
	 * This defines where we send the frontend.
	 *
	 * @return void
	 */
	public function render(): void {
		Timber::render( [ 'homepage.twig' ], $this->provide );
	}

}

new FrontPage;
