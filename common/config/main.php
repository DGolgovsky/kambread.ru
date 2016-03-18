<?php
return [
    'name' => 'ОАО Камышинский хлебокомбинат',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Hide index.php
            'showScriptName' => false,
            // Use pretty URLs
            'enablePrettyUrl' => true,
            'rules' => [
//                '<alias:contact|about>' => 'main/<alias>',
//                '<alias:product>/<id:\w+>' => 'main/<alias>',
//                '<controller:\w+>/<id:\w+>' => '<controller>',
//                '<controller:\w+>/<action:\w+>/<id:\w+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
    ],
];
