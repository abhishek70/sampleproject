<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	//'defaultController' => 'site/login',
	'theme'=>'storetheme1',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.ActiveRecords.*',
		'application.modules.rights.*',
        'application.modules.rights.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'abhi70',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'admin'=>array( 'import' => array('admin.components.*'),
                                                'layout' => 'main'),

		'shop' => array( 'debug' => 'true'),

		'rights'=>array(
				//'superuserName'=>'admin',
                		//'install'=>true,
        	),
		'customer'=>array(),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class'=>'RWebUser',
		),
		'authManager'=>array(
                'class'=>'RDbAuthManager',
                'connectionID'=>'db',
                'defaultRoles'=>array('Authenticated', 'Guest'),
        ),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'admin/' => 'admin',
				'rights/' => 'rights',
                'admin/<_c:([a-zA-z0-9-]+)>' => 'admin/<_c>/admin',
		  		'admin/<_c:([a-zA-z0-9-]+)>/<_a:([a-zA-z0-9-]+)>' => 'admin/<_c>/<_a>',
		  		'admin/<_c:([a-zA-z0-9-]+)>/<_a:([a-zA-z0-9-]+)>//*' => 'admin/<_c>/<_a>/',
				'rights/<_c:([a-zA-z0-9-]+)>' => 'rights/<_c>/rights',
		  		'rights/<_c:([a-zA-z0-9-]+)>/<_a:([a-zA-z0-9-]+)>' => 'rights/<_c>/<_a>',
		  		'rights/<_c:([a-zA-z0-9-]+)>/<_a:([a-zA-z0-9-]+)>//*' => 'rights/<_c>/<_a>/',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
                'showScriptName'=>false
		),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		/*'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=sampleproject',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => '',
		),*/
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		/*'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
				),
				
			),
		),*/
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'defaultPageSize' => 10,
		'pageSizeOptions'=>array(5=>5,10=>10,20=>20,50=>50,100=>100),
	),
);