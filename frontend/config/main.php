<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    //'defaultRoute' => 'main',
    'components' => [
        /*'cache' => [
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => '85.174.63.230',
                    'port' => 11211,
                    'weight' => 60,
                ],
            ],
        ],
        */
        'common' => [
            'class' => 'frontend\components\Common',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/site/login',
            'as UpdateLastLoginDateBehavior' => [
                'class' => 'common\components\behaviors\UpdateLastLoginDateBehavior',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'controllers' => [
                    'cabinet/default',
                    'cabinet/news',
                    'cabinet/product',
                    'cabinet/vacancy',
                ],
                'allow' => false,
                'roles' => ['?'],
            ],
            [
                'allow' => true,
            ],
            [
                'actions' => ['login', 'error'],
                'allow' => true,
            ],
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],
    'params' => $params,
];
