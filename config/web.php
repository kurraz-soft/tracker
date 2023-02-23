<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    'language' => 'ru',
    'aliases' => require(__DIR__.'/aliases.php'),
    'components' => [
        'i18n' => [
            'translations' => [
                'admin*' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'fileMap' => [
                        'admin' => 'admin.php',
                    ],
                ],
            ],
        ],
        'storage' => [
            'class' => \app\components\storage\bdb\BerkeleyDbConnector::class,
            'path' => '@runtime/bdb/base.db',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'WXQupRHt7TalGVvnyNEO47SvoQfXI2Dq',
        ],
        'cache' => [
            //'class' => 'yii\caching\FileCache',
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => 'localhost',
                    'port' => 11211,
                    'weight' => 100,
                ]
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['auth/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),

        /*
         * Url manager
         *
         */
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => require(__DIR__ . '/url_rules.php'),
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
        'generators' => [
            'crud' =>[
                'class' => \yii\gii\generators\crud\Generator::class,
                'templates' => [
                    'admin' => '@app/gii/generators/crud/admin',
                ],
            ]
        ],
    ];
}

return $config;
