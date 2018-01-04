<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * Replace the content of the current template with the content of careers view
 *
 * @param string $the_content
 *
 * @return string
 */
function _filter_fw_ext_careers_the_content( $the_content ) {
	/**
	 * @var FW_Extension_Careers $careers
	 */
	$careers = fw()->extensions->get( 'careers' );

	return fw_render_view( $careers->locate_view_path( 'content' ), array( 'the_content' => $the_content ) );
}

/**
 * Check if the there are defined views for the careers templates, otherwise are used theme templates
 *
 * @param string $template
 *
 * @return string
 */
function _filter_fw_ext_careers_template_include( $template ) {

	/**
	 * @var FW_Extension_Careers $careers
	 */
	$careers = fw()->extensions->get( 'careers' );

	if ( is_singular( $careers->get_post_type_name() ) ) {

		if ( preg_match( '/single-' . '.*\.php/i', basename( $template ) ) === 1 ) {
			return $template;
		}

		if ( $careers->locate_view_path( 'single' ) ) {
			return $careers->locate_view_path( 'single' );
		} else {
			add_filter( 'the_content', '_filter_fw_ext_careers_the_content' );
		}
	} else if ( is_tax( $careers->get_taxonomy_name() ) && $careers->locate_view_path( 'taxonomy' ) ) {

		if ( preg_match( '/taxonomy-' . '.*\.php/i', basename( $template ) ) === 1 ) {
			return $template;
		}

		return $careers->locate_view_path( 'taxonomy' );
	} else if ( is_post_type_archive( $careers->get_post_type_name() ) && $careers->locate_view_path( 'archive' ) ) {
		if ( preg_match( '/archive-' . '.*\.php/i', basename( $template ) ) === 1 ) {
			return $template;
		}

		return $careers->locate_view_path( 'archive' );
	}

	return $template;
}

add_filter( 'template_include', '_filter_fw_ext_careers_template_include' );

function _filter_fw_ext_careers_register_post_options( $options, $post_type ) {
	$careers = fw()->extensions->get( 'careers' );
	if ( $post_type == $careers->get_post_type_name() ) {
		return $careers->get_post_options( 'post' );
	}

	return $options;
}

add_filter( 'fw_post_options', '_filter_fw_ext_careers_register_post_options', 10, 2 );

function _filter_fw_ext_careers_register_category_options( $options, $taxonomy ) {
	$careers = fw()->extensions->get( 'careers' );
	if ( $taxonomy == $careers->get_taxonomy_name() ) {
		return $careers->get_taxonomy_options( 'category' );
	}

	return $options;
}

add_filter( 'fw_taxonomy_options', '_filter_fw_ext_careers_register_category_options', 10, 2 );
 