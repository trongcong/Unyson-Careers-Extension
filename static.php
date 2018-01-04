<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( ! is_admin() ) {
	global $template;
	/**
	 * @var FW_Extension_Careers $careers
	 */
	$careers = fw()->extensions->get( 'careers' );

	if ( is_singular( $careers->get_post_type_name() ) ) {

	}
}



