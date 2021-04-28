<?php
/**
 * URI Specific functions, we have a few as we are rerouting the default
 * WordPress paths. We're disabling PHPCS for missing namespace as these are
 * pure functions.
 *
 * @phpcs:disable HM.Functions.NamespacedFunctions.MissingNamespace
 *
 * @package proagrica
 */

/**
 * Get Image Directory Uri
 *
 * @return string
 */
function theme_image_directory_uri() {
	return get_template_directory_uri() . '/Public/assets';
}

/**
 * Get Style (CSS) Directory Uri
 *
 * @return string
 */
function theme_style_directory_uri() {
	return get_template_directory_uri() . '/Public/assets/css';
}

/**
 * Get Script (JS) Directory Uri
 *
 * @return string
 */
function theme_script_directory_uri() {
	return get_template_directory_uri() . '/Public/assets/js';
}
