<?php
/**
 * Created by PhpStorm.
 * User: dusty
 * Date: 27.02.17
 * Time: 1:47
 */
namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ToastAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery-toast-plugin/dist';

    public $css = [
        'jquery.toast.min.css'
    ];
    public $js = [
        'jquery.toast.min.js'

    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}