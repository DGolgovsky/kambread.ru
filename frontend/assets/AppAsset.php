<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'source/style.css',
        'source/owl-carousel/owl.carousel.min.css',
        'source/owl-carousel/owl.theme.min.css',
        'source/slitslider/css/style.min.css',
        'source/slitslider/css/custom.min.css',
    ];

    public $js = [
        'source/script.min.js',
        'source/owl-carousel/owl.carousel.min.js',
        'source/slitslider/js/modernizr.custom.79639.min.js',
        'source/slitslider/js/jquery.ba-cond.min.min.js',
        'source/slitslider/js/jquery.slitslider.min.js',
        'source/js/google_analytics_auto.min.js',
        'source/js/yandex_metrika.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset', // yii.js, jquery.js
        'yii\bootstrap\BootstrapAsset', // bootstrap.css
        'yii\bootstrap\BootstrapPluginAsset' // bootstrap.js
    ];

    public $jsOptions = [
        'position' =>  View::POS_END,
    ];
}
