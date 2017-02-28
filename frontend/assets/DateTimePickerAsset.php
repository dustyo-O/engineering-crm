<?php
/**
 * Created by PhpStorm.
 * User: dusty
 * Date: 24.02.17
 * Time: 1:02
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DateTimePickerAsset extends AssetBundle
{
    public $sourcePath = '@bower/eonasdan-bootstrap-datetimepicker/build';

    public $css = [
        'css/bootstrap-datetimepicker.css'
    ];
    public $js = [
        'js/bootstrap-datetimepicker.min.js'

    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\MomentAsset'
    ];
}