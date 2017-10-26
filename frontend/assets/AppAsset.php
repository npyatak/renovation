<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/ProximaNova.css',
        'css/owl.carousel.min.css',
        'uw/stylesheets/style.css', 
    ];
    public $js = [
        'js/masonry.pkgd.min.js',
        'js/owl.carousel.min.js',
        'js/uw.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
