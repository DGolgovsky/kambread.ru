<?php
return [
    'name' => 'ОАО Камышинский хлебокомбинат',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => require(dirname(__DIR__)."/config/db.php"),

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
//              '<alias:contact|about>' => 'site/<alias>',
//              '<alias:product>/<id:\w+>' => 'site/<alias>',
//              '<controller:\w+>/<id:\w+>' => '<controller>',
//              '<controller:\w+>/<action:\w+>/<id:\w+>' => '<controller>/<action>',
//              '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
    ],
];
