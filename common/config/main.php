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
//            'suffix' => '.do',
            'rules' => [
//                '<alias:contact|about>' => '/site/<alias>',
//                '<alias:product>/<id:\w+>' => 'main/<alias>',
//                '<controller:\w+>/<id:\w+>' => '<controller>',
//                '<controller:\w+>/<action:\w+>/<id:\w+>' => '<controller>/<action>',
//               '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//                '<view:[a-zA-Z0-9-]+>' => 'site/<view>',
                '<alias:(about|login|signup)>' => 'site/<alias>',
                '<alias:register>' => 'main/main/<alias>',
                'view-product/<id:\d+>' => 'main/main/view-product',
                'catalog/<propert:\w+>&<price:\d+>&<type:\w+>' => 'catalog',
                'cabinet/product/<action_cabinet:(view|update)>/<id:\d+>' => 'cabinet/product/<action_cabinet>',
                '<action_main:(catalog)>' => 'main/main/<action_main>',
                'cabinet/<action_cabinet:(settings|change-password)>' => 'cabinet/default/<action_cabinet>'
            ],
        ],
    ],
];
