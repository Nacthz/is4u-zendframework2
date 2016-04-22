<?php
return array(
	'controllers' => array(
		'invokables' => array(
			'Cart\Controller\Cart' => 'Cart\Controller\CartController',
		),
	),
	'router' => array(
		'routes' => array(
			'cart' => array(
				'type'    => 'segment',
				'options' => array(
					'route'    => '/cart[/:action]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'Cart\Controller\Cart',
						'action'     => 'index',
					),
				),
			),
		),
	),
	'view_manager' => array(
		'template_path_stack' => array(
			'cart' => __DIR__ . '/../view',
		),
	),
);