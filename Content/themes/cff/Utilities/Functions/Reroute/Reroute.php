<?php

/**
 * Verify the theme
 */
$get_theme = get_option( 'template' );
if ( strtoupper( THEME_NAME ) !== strtoupper( $get_theme ) ) {
	var_dump( 'Theme mismatch - ejecting for our own safety.' );
	die;
}

add_filter( 'stylesheet_directory', function ( $stylesheet_dir, $stylesheet, $theme_root ) {
	return $stylesheet_dir . '/App/View';
}, 10, 3 );

/**
 * * Possible values for `$type` include: 'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date',
 * 'embed', 'home', 'frontpage', 'privacypolicy', 'page', 'paged', 'search', 'single', 'singular', and 'attachment'.
 */
add_filter( 'single_template_hierarchy', 'ha_single_template_hierarchy' );
add_filter( 'page_template_hierarchy', 'ha_page_template_hierarchy' );
add_filter( 'archive_template_hierarchy', 'ha_archive_template_hierarchy' );
add_filter( 'singular_template_hierarchy', 'change_template_hierarchy' );
add_filter( 'page_template_hierarchy', 'change_template_hierarchy' );
add_filter( '404_template_hierarchy', 'change_template_hierarchy' );
add_filter( 'frontpage_template_hierarchy', 'change_template_hierarchy' );
add_action( 'get_template_part', 'change_template_hierarchy' );


/**
 * Custom Single Template Path.
 * @param array $templates Templates
 *
 * @return array|mixed
 */
function ha_single_template_hierarchy( array $templates ) {
	if ( is_array( $templates ) ) {
		array_walk( $templates, function ( &$value, $key ) {
			if ( stripos( $value, 'App/Controller/' ) === false ) {
				$value = str_replace( 'single-', '', $value );
				$value = 'App/Controller/Single/' . $value;
			}
		} );
	}
	return $templates;
}

/**
 * Custom Page Template Path.
 * @param array $templates Templates
 *
 * @return array|mixed
 */
function ha_page_template_hierarchy( array $templates ) {
	if ( is_array( $templates ) ) {
		array_walk( $templates, function ( &$value, $key ) {
			if ( stripos( $value, 'App/Controller/' ) === false ) {
				$value = str_replace( 'page-', '', $value );
				$value = 'App/Controller/Page/' . $value;
			}
		} );
	}

	return $templates;
}

/**
 * Archive
 *
 * @param  array $templates
 *
 * @return array
 */
function ha_archive_template_hierarchy( array $templates ) {
	if ( is_array( $templates ) ) {
		array_walk( $templates, function ( &$value, $key ) {
			if ( stripos( $value, 'App/Controller/' ) === false ) {
				$value = str_replace( 'archive-', '', $value );
				$value = 'App/Controller/Archive/' . $value;
			}
		} );
	}

	return $templates;
}

/**
 * Change Template Hierarchy.
 *
 * @param  mixed $templates
 *
 * @return array|mixed
 */
function change_template_hierarchy( $templates ) {
	if ( is_array( $templates ) ) {
		array_walk( $templates, function ( &$value, $key ) {
			if ( stripos( $value, 'App/Controller/' ) === false ) {
				$value = 'App/Controller/' . $value;
			}
		} );
	}
	return $templates;
}

add_filter( 'theme_templates', function ( $post_templates, $object, $post, $post_type ) {
	$f = $object->get_files( 'php', - 1 );
	foreach ( $f as $file => $full_path ) {
		if ( ! preg_match( '|Template Name:(.*)$|mi', file_get_contents( $full_path ), $header ) ) {
			continue;
		}

		$types = [ 'page' ];
		if ( preg_match( '|Template Post Type:(.*)$|mi', file_get_contents( $full_path ), $type ) ) {
			$types = explode( ',', _cleanup_header_comment( $type[1] ) );
		}

		foreach ( $types as $type ) {
			$type = sanitize_key( $type );
			if ( ! isset( $post_templates[ $type ] ) ) {
				$post_templates[ $type ] = [];
			}

			$post_templates[ $type ][ $file ] = _cleanup_header_comment( $header[1] );
		}
	}

	return isset( $post_templates['page'] ) ? $post_templates['page'] : '';
}, 10, 4 );


$packagejson = ABSPATH . '/package.json';
if ( file_exists( $packagejson ) ) {
	$json_data      = file_get_contents( $packagejson );
	$package_return = json_decode( $json_data, true );
	if ( $package_return['version'] ) {
		define( 'PROJECT_VERSION', $package_return['version'] );
	} else {
		define( 'PROJECT_VERSION', '0.0.0null' );
	}
} else {
	define( 'PROJECT_VERSION', 'undefined - check node package' );
}
