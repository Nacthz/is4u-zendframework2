<?php
return array(
	'mail' => array(
		'transport' => array(
			'options' => array(
				'host'              => 'smtp.gmail.com',
				'connection_class'  => 'plain',
				'port' => 587,
				'connection_config' => array(
					'username' => 'is4u.jukan@gmail.com',
					'password' => 'proyectomatador',
					'ssl' => 'tls'
				),
			),  
		),
	),
);