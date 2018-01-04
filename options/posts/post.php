<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$yolo_template_directory = get_template_directory_uri();

$options = array(
	'main' => array(
		'type'    => 'box',
		'title'   => __( 'Careers Parameters', 'yolo' ),
		'options' => array(
			'post_career_param' => array(
				'type'          => 'multi',
				'label'         => false,
				'inner-options' => array(
					'career_number'   => array(
						'type'  => 'text', 
						'label' => __( 'Job Number', 'yolo' ),
						'desc'  => __( 'ex: 5', 'yolo' ),
					),
					'career_location' => array(
						'type'  => 'text',
						'label' => __( 'Location', 'yolo' ),
						'desc'  => __( 'ex: United States' ),
					),
					'career_exp'      => array(
						'type'  => 'text',
						'value' => 'All',
						'label' => __( 'Years’ Experience', 'yolo' ),
						'desc'  => __( 'ex: 2', 'yolo' ),
					),
					'career_expired'  => array(
						'type'            => 'datetime-picker',
						'value'           => '',
						'label'           => __( 'Expired Time', 'yolo' ),
						'desc'            => __( 'Format default: d/m/Y H:i', 'yolo' ),
						'datetime-picker' => array(
							'format'     => 'd/m/Y H:i',
							'maxDate'    => false,
							'minDate'    => false,
							'timepicker' => true,
							'datepicker' => true,
						),
					),
				)
			),
		),
	)
);
 