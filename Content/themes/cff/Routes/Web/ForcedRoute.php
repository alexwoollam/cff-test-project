<?php
/**
 * Forced router.
 *
 * You can use this to pass a route to any given controller.
 * Use this for forced pages that dont nessesarily need WordPress content
 * control and are a bit more advanced. e.g. running a SPA React app on a
 * sub., e.g. blah.com/gallery
 *
 * We then dont need to clutter the WordPress dash with blank pages.
 *
 * @package proagrica
 * @package upstatement/routes
 */

Routes::map( 'blah/', function() {
	Routes::load( THEME_PATH . 'App/Controller/Forced/blah.php' );
});
