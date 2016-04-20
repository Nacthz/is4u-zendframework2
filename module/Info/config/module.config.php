<?php
return array(
	'controllers' => array(
		'invokables' => array(
			'Info\Controller\Info' => 'Info\Controller\InfoController',
		),
	),
	'router' => array(
		'routes' => array(
			'info' => array(
				'type'    => 'segment',
				'options' => array(
					'route'    => '/info[/:action]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'Info\Controller\Info',
						'action'     => 'index',
					),
				),
			),
		),
	),
	'view_manager' => array(
		'template_path_stack' => array(
			'info' => __DIR__ . '/../view',
		),
	),
);