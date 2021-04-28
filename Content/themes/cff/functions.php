<?php

/**
 * Define theme global variabels.
 */
(new CFF\Utilities\Core\ThemeDefinitions)->Init();

/**
 * Setup routing, internally and exturnally.
 */
require_once 'Routes/Web/ForcedRoute.php';
require_once 'Utilities/Functions/Reroute/Reroute.php';

/**
 * Load in core functionality.
 */
new CFF\Utilities\Core\Core;

if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
	new CFF\App\Model\PageFactory;
};
