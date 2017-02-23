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
class Select2Asset extends AssetBundle
{
    public $sourcePath = '@bower/select2/dist';

    public $css = [
        'css/select2.min.css'
    ];
    public $js = [
        'js/select2.full.min.js'

    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}