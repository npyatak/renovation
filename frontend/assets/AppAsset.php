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
        'css/colorbox.css',
        'css/font-awesome.min.css',
        'uw/stylesheets/header.css',
        'uw/stylesheets/uw.css',
        'uw/stylesheets/front.css',
        'uw/stylesheets/gallery.css',
        'uw/stylesheets/compare.css',
        'uw/stylesheets/renovation.css',
        'uw/stylesheets/footer.css',
    ];
    public $js = [
        'js/masonry.pkgd.min.js',
        'js/wow.min.js',
        'js/player/jwplayer.js',
        'js/owl.carousel.min.js',
        'js/jquery.colorbox-min.js',
        'js/uw.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
