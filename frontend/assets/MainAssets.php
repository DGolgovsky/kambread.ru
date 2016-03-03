<?
namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class MainAsset extends  AssetBundle{

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'source/style.css',
        'source/owl-carousel/owl.carousel.css',
        'source/owl-carousel/owl.theme.css',
        'source/slitslider/css/style.css',
        'source/slitslider/css/custom.css'
    ];

    public $js = [
        'source/script.js',
        'source/owl-carousel/owl.carousel.js',
        'source/slitslider/js/modernizr.custom.79639.js',
        'source/slitslider/js/jquery.ba-cond.min.js',
        'source/slitslider/js/jquery.slitslider.js',
        'source/js/google_analytics_auto.js'
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