<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use app\assets\ToastAsset;
use common\widgets\Alert;

AppAsset::register($this);
ToastAsset::register($this);

if ($success = Yii::$app->session->getFlash('success'))
{
    $this->registerJs(<<<JS
    const SUCCESS_COLOR = '#71843f';

    $.toast({
        heading: 'Success',
        text: '{$success}',
        icon: 'success',
        loader: false,
        loaderBg: SUCCESS_COLOR,
        position: 'top-right'
    });
JS
    );
}
if ($error = Yii::$app->session->getFlash('error'))
{
    $this->registerJs(<<<JS
    const ERROR_COLOR = '#a90329';

    $.toast({
        heading: 'Error',
        text: '{$error}',
        icon: 'error',
        loader: false,
        loaderBg: ERROR_COLOR,
        position: 'top-right'
    });
JS
    );
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body<?= isset($this->params['body-class']) ? ' class="' . $this->params['body-class'] . '"' : '' ?>>

<!-- #HEADER -->
<header id="header">
    <div id="logo-group">

        <!-- PLACE YOUR LOGO HERE -->
        <a href="<?= Url::to(['site/index']) ?>"><span id="logo"> <img src="/img/merlin-logo.jpg"> Merlin CRM </span></a>
        <!-- END LOGO PLACEHOLDER -->

    </div>

    <!-- #PROJECTS: projects dropdown -->
    <section class="logout">
        <a href="<?= Url::to(['user/change-password']) ?>"><i class="fa fa-2x fa-key"></i></a>
        <a href="<?= Url::to(['site/logout']) ?>" data-method="post"><i class="fa fa-2x fa-sign-out"></i></a>
    </section>
    <!-- end projects dropdown -->


</header>
<!-- END HEADER -->

<!-- #NAVIGATION -->
<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">

    <!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as it -->

            <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                <i class="fa fa-2x fa-user-circle"></i>
                <span>
                <?= Yii::$app->user->identity->username ?>
                </span>
            </a>

        </span>
    </div>
    <!-- end user info -->

    <nav>
        <ul>
            <li>
                <a href="<?= Url::to(['customer/list']) ?>" title="Customers"><i class="fa fa-lg fa-fw fa-male"></i> Customers</a>
            </li>
            <li>
                <a href="<?= Url::to(['subcontractor/list']) ?>" title="HR & Subcontractors"><i class="fa fa-lg fa-fw fa-handshake-o"></i> HR & Subcontractors</a>
            </li>
            <li>
                <a href="<?= Url::to(['service/list']) ?>" title="Service"><i class="fa fa-lg fa-fw fa-wrench"></i> Service & Maintenance</a>
            </li>
        </ul>
    </nav>
</aside>
<!-- END NAVIGATION -->

<!-- MAIN PANEL -->
<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">

        <span class="ribbon-button-alignment">
            <span id="refresh" class="btn btn-ribbon" onclick="javascript: document.location.reload();">
                <i class="fa fa-refresh"></i>
            </span>
        </span>

        <?php
        $links = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [];

        if (count($links) > 0)
        {
            echo Breadcrumbs::widget([
                'itemTemplate' => "<li>{link}</li>\n", // template for all links
                'links' => $links
            ]);
        }
        ?>

    </div>
    <!-- END RIBBON -->

    <!-- MAIN CONTENT -->
    <div id="content">

        <?= $content ?>

    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->

<!-- PAGE FOOTER -->
<div class="page-footer">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <span class="txt-color-white"><span class="hidden-xs">Designed & built by </span><a href="https://www.fl.ru/users/dustyo_o/">Alexandr Shleyko</a> &copy; 2017</span>
        </div>
    </div>
</div>
<!-- END PAGE FOOTER -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>