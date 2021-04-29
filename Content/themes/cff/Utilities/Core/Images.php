<?php

namespace CFF\Utilities\Core;

class Images implements ImagesInterface
{

	public function __construct() {
		
	}

    public function getImage( $image_url, $args = [] ): ?string
    {
		$valid_uri = filter_var( $image_url, FILTER_SANITIZE_URL );
		$valid_uri ? $src = 'src="' . $valid_uri . '"': null;
		$args['classes'] ? $classes = 'class="' . $args['classes'] . '"': null;
		$args['alt'] ? $alt = 'alt="' . $args['alt'] . '"': null;
		$args['lazy'] ? $lazy = 'loading="lazy"': null;

		if( !$valid_uri ){
			return null;
		}

		return '<img ' . $lazy . $class . $src . $alt . '/>';
    }

}