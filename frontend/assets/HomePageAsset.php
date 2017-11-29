<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class HomePageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/home_page.css',
        'css/styles.pref.css',
    ];
    public $js = [
        'js/home_page.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
