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
    'bootstrap' => ['log', 'debug'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'main',
    'modules' => [
        'main' => [
            'class' => 'app\modules\main\Module',
        ],
        'cabinet' => [
            'class' => 'app\modules\cabinet\Module',
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.95', '192.168.0.39'] // adjust this to your needs
        ],
        'debug' => [
            'class' => 'yii\debug\Module',
        ],
    ],

    'components' => [
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => '85.174.63.230',
                    'port' => 11211,
                    'weight' => 60,
                ],
            ],
        ],

        'mail' => [
            'class'            => 'zyx\phpmailer\Mailer',
            'viewPath'         => '@common/mail',
            'useFileTransport' => false,
            'config'           => [
                'mailer'     => 'smtp',
                'host'       => 'smtp.mail.ru',
                'port'       => '465',
                'smtpsecure' => 'ssl',
                'smtpauth'   => true,
                'username'   => 'web.notify@kambread.ru',
                'password'   => '^axJH6g9olGX',
                'ishtml'     => true,
                'charset'    => 'UTF-8',
            ],
        ],

        'common' => [
            'class' => 'frontend\components\Common',
        ],

        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/main/main/login'
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
