<?php

namespace CFF\App\Controller;

use Timber\Timber;

class Index implements PageInterface {

    
    public $static = [
        'title'    => 'default router page',
        'subtitle' => 'hit index',
        'content'  => 'you hit the index page, check the routing',
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
	private function render() {
		Timber::render( [ 'index.twig' ], $this->provide );
	}

}

new Index;
