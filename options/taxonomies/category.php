<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$yolo_template_directory = get_template_directory_uri();

$options = array(
	'field_image_cover' => array(
		'type'        => 'upload',
		'label'       => __( 'Field image', 'yolo' ),
		'help'        => __( 'Select image of fields', 'yolo' ),
		'images_only' => true,
		'files_ext'   => array( 'jpg', 'png', 'jpeg' ),
	)
);
 