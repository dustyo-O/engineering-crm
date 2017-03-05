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
class DropzoneAsset extends AssetBundle
{
    public $sourcePath = '@bower/dropzone/dist';

    public $css = [
        'min/dropzone.min.css'
    ];
    public $js = [
        'min/dropzone.min.js'

    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}