<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;

AppAsset::register($this);

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        html, body {
            height: 100%;
        }

        #main {
            display: table;
            height: 100%;
        }

        #main > form {
            display: table-cell;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div id="main" role="main">

        <!-- MAIN CONTENT -->

        <form class="lockscreen animated flipInY" action="index.html">
            <div>
                <div>
                    <?= $content ?>
                </div>

            </div>
            <p class="font-xs margin-top-5">
                Made by <a href="https://www.fl.ru/users/dustyo_o/">Alexandr Shleyko</a>. 2017
            </p>
        </form>

    </div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>