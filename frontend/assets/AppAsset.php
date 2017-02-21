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
        'css/smartadmin-production-plugins.min.css',
        'css/smartadmin-production.min.css',
        'css/smartadmin-skins.min.css',
        'css/smartadmin-rtl.min.css',
        'http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700', // TODO make local open sans asset
        'css/font-awesome.min.css',
        'css/site.css',
    ];
    public $js = [
        'js/app.config.js',
        'js/notification/SmartNotification.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}