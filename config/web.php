<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Hg8pq9dGOz_jrOIyXkobZCwwFecFrJWZ',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
		 	'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.gmail.com',
			'username' => 'arivazhagan0117@gmail.com',
            'password' => 'Arivu@!@#Vega',
            'port' => '587',
            'encryption' => 'tls', 
                        ],  
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'awssdk' => [
            'class' => 'fedemotta\awssdk\AwsSdk',
            'credentials' => [ //you can use a different method to grant access
                'key' => 'AKIAJTJ744YGDWF7CXDQ',
                'secret' => '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',
            ],
            'region' => 'us-west-2', //i.e.: 'us-east-1'
            'version' => 'latest', //i.e.: 'latest'
        ],
        'urlManager' => [            
            'enablePrettyUrl' => true,
            'showScriptName' => false,            
            'rules' => [                          
            ],
        ],
        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
