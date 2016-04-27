<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Payments\Controller\Payments' => 'Payments\Controller\PaymentsController',
        )
    ),
    'router' => array(
        'routes' => array(
            'payments' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/payments',
                    'defaults' => array(
                        'controller' => 'Payments\Controller\Payments',
                        'action'     => 'index',
                    ),
                ),
            ),
            'payments-read' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/payments/[:id]',
                    'constraints' => array(
                        'id' => '[0-9a-zA-Z]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Payments\Controller\Payments',
                        'action'     => 'read',
                    ),
                ),
            ),
            'payments-create' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/payments/create',
                    'defaults' => array(
                        'controller' => 'Payments\Controller\Payments',
                        'action'     => 'create',
                    ),
                ),
            ),
            'payments-finish' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/payments/finish',
                    'defaults' => array(
                        'controller' => 'Payments\Controller\Payments',
                        'action'     => 'finish',
                    ),
                ),
            ),
            'payments-failure' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/payments/failure',
                    'defaults' => array(
                        'controller' => 'Payments\Controller\Payments',
                        'action'     => 'failure',
                    ),
                ),
            ),
        ),
    ),
    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo'
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    )
);