<?php
return [
	'aliases' => [
		'@bower' => '@vendor/bower-asset',
		'@npm'   => '@vendor/npm-asset',
	],
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'components' => [
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => 'pgsql:host=localhost;dbname=yii_plots',
			'username' => 'user',
			'password' => 'qweqwe',
			'charset' => 'utf8',
		],
	],
];
