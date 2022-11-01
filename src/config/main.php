<?php

return [
    'id' => 'main',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'app\controllers',
    'language' => getenv('LOCALE') ?? 'en',
    'aliases' => [
        '@tests' => dirname(__DIR__) . '/tests',
    ],
    'bootstrap' => [
        'log',
    ],
    'components' => [
        'db' => require __DIR__ . '/db.php',
        'request' => [
            'parsers' => [
                'application/json' => \yii\web\JsonParser::class,
            ],
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'user' => [
//            'identityClass' => 'app\models\User',
//            'enableAutoLogin' => true,
//        ],
        'errorHandler' => [
            'errorAction' => 'index/error',
        ],
//        'mailer' => [
//            'class' => \yii\symfonymailer\Mailer::class,
//            'viewPath' => '@app/mail',
//            // send all mails to a file by default.
//            'useFileTransport' => true,
//        ],
//        'log' => [
//            'traceLevel' => YII_DEBUG ? 3 : 0,
//            'targets' => [
//                [
//                    'class' => 'yii\log\FileTarget',
//                    'levels' => ['error', 'warning'],
//                ],
//            ],
//        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'verb' => ['get'],
                    'pattern' => '/',
                    'route' => 'sign-up/index',
                ],
                [
                    'verb' => ['post'],
                    'pattern' => '/sign-up',
                    'route' => 'sign-up/auth',
                ],
            ],
        ],
    ],
    'params' => require __DIR__ . '/params.php',
    'container' => [],
];
