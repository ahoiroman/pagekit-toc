<?php

use Pagekit\Application;

return [
	'name' => 'toc',
	'type' => 'extension',
	'main' => function( Application $app ) {
	
	},
	
	'autoload' => [
		'Spqr\\Toc\\' => 'src'
	],
	
	'nodes' => [
	],
	
	'routes' => [
	],
	
	'widgets' => [
	],
	
	'menu' => [
	],
	
	'permissions' => [
		'toc: manage settings' => [
			'title' => 'Manage settings'
		]
	],
	
	'settings' => '@toc/settings',
	
	'resources' => [
		'toc:' => ''
	],
	
	'config' => [
	],
	
	'events' => [
	]
];