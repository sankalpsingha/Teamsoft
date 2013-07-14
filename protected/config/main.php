<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.



return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Fahrenheit',
	'defaultController' => 'user/index',


	'aliases' => array(
    'chartjs' => 'ext.chartjs',
),

	// preloading 'log' component
	'preload'=>array('log','bootstrap','chartjs'), // Preloading the bootstrap components.

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.message.*',
		'application.modules.rights.*', 
		'application.modules.rights.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'sankalp',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array(
         	 'bootstrap.gii'
      		 ),
		),
		
		'rights'=>array(
			'install'=>false,
			//'enableBizRule' => true,
			//'enableBizRuleData' => true,
			),
		'message' => array(
            'userModel' => 'User',
            'getNameMethod' => 'getFullName',
            'getSuggestMethod' => 'getSuggest',
        ),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'class'=>'RWebUser',
			'allowAutoLogin'=>true,
		),

		'authManager'=>array(
			'class'=>'RDbAuthManager',
			'connectionID' => 'db',
			'defaultRoles' => array('Guest'),
			),

		'bootstrap' => array(
	    	'class' => 'ext.bootstrap.components.Bootstrap',
	    	'responsiveCss' => true,
	    	'fontAwesomeCss' => true,
			),

		'chartjs' => array('class' => 'chartjs.components.ChartJs'),

		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' =>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'blog' => 'post/index',
				'resource' => 'resource/index',
				'gii' => 'gii',
				'admin' => 'user/admin',

				'moderator' => 'user/moderator',
				// '<controller>' => '<controller>',

				'<slug:[\w\_]+>'=>'user/view',
			),
		),

		'Date' => array(
			'class'=>'application.components.Date',
			//And integer that holds the offset of hours from GMT e.g. 4 for GMT +4
			'offset' => 4,
		),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			//'connectionString' => 'mysql:unix_socket=/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock;dbname=fahrenheit',
			'connectionString' => 'mysql:host=localhost;dbname=admin_fahrenheit',
			'emulatePrepare' => true,
			'username' => 'admin_admin',
			'password' => '#include<sankalp.h>',
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
				
				/*array(
					'class'=>'CWebLogRoute',
				),*/
				
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
