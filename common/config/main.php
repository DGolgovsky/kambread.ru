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
                '<alias:(about|contact|login|signup|partners|index)>' => 'site/<alias>',
                '<alias:(/site/index)>' => '/',
                'products/view-product/<id:\d+>' => 'products/default/view-product',
                'products/<propert:\w+>&<price:\d+>&<type:\w+>' => 'products',
                'cabinet/product/<action_cabinet:(view|update)>/<id:\d+>' => 'cabinet/product/<action_cabinet>',
                '<action_products:(index)>' => 'products/<action_products>',
                'cabinet/<action_cabinet:(settings|change-password)>' => 'cabinet/default/<action_cabinet>',
                'cabinet/<action_cabinet:(news|vacancy)>' => 'cabinet/<action_cabinet>'
            ],
        ],
    ],
];
