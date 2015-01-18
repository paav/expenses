<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Expenses',
    'language'=>'ru',
    'defaultController' => 'expense',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'12345',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>false,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<expenseType:\w+>/<id:\d+>'=>'<controller>/<action>',
				'expense/<action:\w+>/<expenseType:\w+>'=>'expense/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
            'caseSensitive'=>true,
            'showScriptName'=>true,
		),
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=expenses',
			'emulatePrepare' => true,
            'enableParamLogging' => true,
			'username' => 'yii',
			'password' => '12345',
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
				array(
					'class'=>'CWebLogRoute',
                    //'showInFireBug'=>true,
				),
			),
		),
        'helper' => array(
            'class' => 'ext.PaavHelper',
        ),
        'format'=>array(
            'class'=>'application.extensions.MyFormatter',
            'dateFormat'=>'d.m.Y',
            'numberFormat'=>array(
                'decimals'=>2,
                'decimalSeparator'=>',',
                'thousandSeparator'=>' ',
            ),
        ),
        'widgetFactory'=>array(
            'widgets'=>array(
                'CGridView'=>array(
                    'enableSorting'=>false,
                    'summaryText'=>'{start}–{end} из {count}',
                ),
                'CJuiDatePicker'=>array(
                    'language'=>'ru',
                    'options'=>array(
                        'dateFormat'=>'dd.mm.yy',
                        'showOtherMonths'=>true,
                        'selectOtherMonths'=>true,
                        'changeYear'=>true,
                    ),
                ),
                'PaavPager' => array(
                    'cssFile' => false,
                    'nextPageCssClass' => 'btn btn-default',
                    'previousPageCssClass' => 'btn btn-default',
                    'hiddenPageCssClass' => 'disabled',
                    'buttonsCssClass' => 'btn-group',
                    'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
                    'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
                    'htmlOptions' => array('class' => 'paavpager pull-right'),
                ),
            ),
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
        'encryptionKey' => 'dkflbdjcnjr2000',
	),
);
