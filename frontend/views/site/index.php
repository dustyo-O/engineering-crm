<?php
/* @var $this \yii\web\View */
/* @var $customers \common\models\Customer[] */

use yii\helpers\Url;

$this->title = 'Welcome';

$this->params['body-class'] = 'welcome-page';
$this->registerCss(<<<CSS
html { height: 100% }
CSS
);
?>
<div class="index-menu">
    <h1>Welcome</h1>
    <a href="<?= Url::to(['customer/list']) ?>" class="btn btn-primary btn-large btn-block">
        <i class="fa fa-lg fa-male"></i> Customers
    </a>
    <a href="<?= Url::to(['subcontractor/list']) ?>" class="btn btn-primary btn-large btn-block">
        <i class="fa fa-lg fa-handshake-o"></i> Subcontractors
    </a>
    <a href="<?= Url::to(['service/list']) ?>" class="btn btn-primary btn-large btn-block">
        <i class="fa fa-lg fa-wrench"></i> Services
    </a>
</div>