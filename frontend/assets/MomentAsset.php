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
class MomentAsset extends AssetBundle
{
    public $sourcePath = '@bower/moment/min';

    public $css = [
    ];
    public $js = [
        'moment-with-locales.js'
    ];
    public $depends = [];
}