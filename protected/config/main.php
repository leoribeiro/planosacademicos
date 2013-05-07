<?php

$configPam = new ConfigApp();
$host = $configPam->host;
$usuario = $configPam->usuario;
$password = $configPam->password;
$basedados = $configPam->basedados;



// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Sistema de Planejamento de Etapa',
	'language' => 'pt_br',
	'sourceLanguage' => 'pt_br',

	// preloading 'log' component
	'preload'=>array('log','bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'RecursosHumanos.models.Professor',
		'RecursosHumanos.models.Servidor',
		'Requerimentos.models.Aluno',
		'Requerimentos.models.AlunoTecnico',
		'Requerimentos.models.AlunoGraduacao',
		'Requerimentos.models.CursoGraduacao',
		'Requerimentos.models.CursoTecnico',
		'RecursosHumanos.models.RH_ServidorStatus',
	),

	'theme'=>'bootstrap',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class' => 'WebUser',
		),

		'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
		'urlManager'=>array(
		     'urlFormat'=>'path',
				'rules'=>array(
					'<controller:\w+>/<id:\d+>'=>'<controller>/view',
					'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
					'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
					'<action:(login|logout|page|contact)>' => 'site/<action>',
				),
		     'showScriptName'=>false,

		),
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host='.$host.';dbname='.$basedados,
			'emulatePrepare' => true,
			'username' => $usuario,
			'password' => $password,
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);