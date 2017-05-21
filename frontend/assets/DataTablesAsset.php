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
class DataTablesAsset extends AssetBundle
{
    public $sourcePath = '@bower/datatables/media';

    public $css = [
        'css/dataTables.bootstrap.min.css'
    ];
    public $js = [
        'js/jquery.dataTables.min.js',
        'js/dataTables.bootstrap.min.js'

    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\MomentAsset'
    ];
}