<?php

namespace CFF\App\Controller;

/**
 * Page interface.
 */
interface PageInterface {


	/**
	 * Render function, this generally points to the nessesery view (twig temple)
	 *
	 * @return void
	 */
	function render(): void;
}
