<?php

declare(strict_types=1);

return [
	'id' => 'app-common-tests',
	'basePath' => dirname(__DIR__),
	'components' => [
		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => 'pgsql:host=localhost;dbname=yii_plots_test',
			'username' => 'user',
			'password' => 'qweqwe',
			'charset' => 'utf8',
		],
		'ros_registry' => [
			'class' => 'common\components\rosRegistry\RosRegistryService',
		],
	],
];
