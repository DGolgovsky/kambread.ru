<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

\Yii::setAlias('theme_view', '@frontend/themes/product/views');

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'main',
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
        ],*/
        'view' => [
            'theme' => [
                'class' => 'frontend\themes\product\Theme',
                'basePath' => '@app/',
                'baseUrl'  => '@web/',
            ],
        ],
        'common' => [
            'class' => 'frontend\components\Common',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/site/login',
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
    'params' => $params,
];
