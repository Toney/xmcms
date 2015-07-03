<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
include dirname(__FILE__).'/../../config/db.php';
include dirname(__FILE__).'/../../config/config.php';

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'新麦CMS系统',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
// 	'session'=>array(
// 			'autoStart'=>true,
// 			'sessionName' => 'xmcrm',
//     		'cookieMode' => 'only',
// 			'savePath' => 'D:\xampp\tmp'
// 	),
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'admin'=>array(
				
		),'wap'=>array(

        ),'android'=>array(

        ),
        'restful'
        /*'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'123456',
            // 'ipFilters'=>array(...IP 列表...),
            // 'newFileMode'=>0666,
            // 'newDirMode'=>0777,
        )*/
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
        'session'=>array(
            'autoStart'=>true
        ),
        'request'=>array(
            'enableCsrfValidation'=>true,
            'enableCookieValidation'=>true
        ),
		// uncomment the following to enable URLs in path-format
/*		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),*/
        'cache'=>array(
            'class'=>'CFileCache',
        ),
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => $APP_DBSTR,
			'emulatePrepare' => true,
			'username' => $APP_USERNAME,
			'password' => $APP_PASSWORD,
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
        'messages'=>array(
            'class'=>'CDbMessageSource',
            'sourceMessageTable'=>'xm_sourcemessage',
            'translatedMessageTable'=>'xm_translatedmessage'
        )
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
    'theme'=>isset($APPCFG['theme'])?$APPCFG['theme']:"classic",
	'language'=>'zh_cn',
	'sourceLanguage'=>'en_us'
);