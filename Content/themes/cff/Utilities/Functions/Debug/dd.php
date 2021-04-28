<?php
/**
 * DD - Dump & Die, lifted straight from Laravel,
 * This handy snippit will make var_dump useable.
 * run with dd( $thing_here );
 *
 * We're disabling PHPCS for missing namespace as this is a global function.
 *
 * @phpcs:disable HM.Functions.NamespacedFunctions.MissingNamespace
 *
 * @package proagrica
 */
function dd( $passed ) {
	echo '<pre>';
	var_dump( $passed );
	die;
	echo '<pre/>';
}

// TODO: Add filter for this so it cant accidently be fired in production.
