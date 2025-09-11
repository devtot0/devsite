<?php
/**
 * Add the Title & description meta box
 * @var [type]
 */
$class_metabox_qa = new WPAlchemy_MetaBox(
	array(
		'id'          => 'portfolio_custom_fields',
		'title'       => esc_html__( 'Custom Field', 'haru-pangja' ),
		'template'    => plugin_dir_path( __FILE__ ) . 'custom-field.php',
		'types'       => array( 'haru_portfolio' ), // post type
		'autosave'    => TRUE,
		'priority'    => 'low',
		'context'     => 'normal',
		'hide_editor' => FALSE
	)
);