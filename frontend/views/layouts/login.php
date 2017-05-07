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
</head>

<head>
<body class="login animated fadeInDown">

<!-- #HEADER -->
<header id="header">
    <div id="logo-group">

        <!-- PLACE YOUR LOGO HERE -->
        <a href="<?= Url::to(['site/index']) ?>"><span id="logo"> <img src="/img/merlin-logo.jpg"> Merlin CRM </span></a>
        <!-- END LOGO PLACEHOLDER -->

    </div>
</header>
<!-- END HEADER -->
<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5 hidden-xs hidden-sm text-center">
                <h1 class="txt-color-red login-header-big">Merlin CRM System</h1>
                <div class="hero">

                    <img src="/img/kse-logo-on-black.jpg">

                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-6">
                <div class="well no-padding">
<?= $content ?>
                </div>


            </div>
        </div>
    </div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>