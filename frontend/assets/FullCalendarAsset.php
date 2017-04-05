<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FullCalendarAsset extends AssetBundle
{
    public $sourcePath = '@bower/fullcalendar/dist';

    public $css = [
        'fullcalendar.css'
    ];
    public $js = [
        'fullcalendar.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\MomentAsset'
    ];
}