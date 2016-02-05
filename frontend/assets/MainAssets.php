<?
namespace frontend\assets;


use yii\web\AssetBundle;
use yii\web\View;

class MainAsset extends  AssetBundle{

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/style.css',
        'css/bootstrap.min.css',
        'css/lightbox.css',
    ];

    public $js = [
        'js/bootstrap.min.js',
        'js/jquery.countTo.js',
        'js/jquery.waypoints.min.js',
        'js/lightbox.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset', // yii.js, jquery.js
        'yii\bootstrap\BootstrapAsset', // bootstrap.css
        'yii\bootstrap\BootstrapPluginAsset' // bootstrap.js
    ];

    public $jsOptions = [
        'position' =>  View::POS_HEAD,
    ];


}