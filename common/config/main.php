<?php
return [
    'name' => 'АО Камышинский хлебокомбинат',
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
                '<alias:(about|contact|login|signup|partners|index|disclosure|mail)>' => 'site/<alias>',
                '<alias:(/site/index)>' => '/',

                'products/<action_products:(index|default)>' => 'products/<action_products>',
                'products/view-product/<id:\d+>' => 'products/default/view-product',
                'products/' => 'products/default/index',
                'vacancy/' => 'vacancy/default/index',
                '<propert:\w+>&<price:\d+>&<type:\w+>' => '/',
                'news/view/<id:\d+>' => 'news/default/view-news',

                'cabinet/product/<action_cabinet:(view|create|update|addimg)>/<id:\d+>' => 'cabinet/product/<action_cabinet>',
                'cabinet/news/<action_cabinet:(view|create|update|addimg)>/<id:\d+>' => 'cabinet/news/<action_cabinet>',
                'cabinet/vacancy/<action_cabinet:(view|update|create)>/<id:\d+>' => 'cabinet/vacancy/<action_cabinet>',
                'cabinet/<action_cabinet:(settings|change-password)>' => 'cabinet/default/<action_cabinet>',
                'cabinet/<action_cabinet:(news|product|vacancy)>' => 'cabinet/<action_cabinet>'
            ],
        ],
    ],
];
