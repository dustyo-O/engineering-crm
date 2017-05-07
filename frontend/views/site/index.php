<?php
/* @var $this \yii\web\View */
/* @var $customers \common\models\Customer[] */

use yii\helpers\Url;

$this->title = 'Welcome';

$this->params['body-class'] = 'welcome-page';
$this->registerCss(<<<CSS
html { height: 100% }

.index-menu a.btn {
    overflow: hidden;
    text-overflow: ellipsis;
}

.index-menu h4 {
    margin-top: -50px;
}


@media all and (orientation: landscape) {
    html { min-height: unset }
    
    .welcome-page .index-menu {
        display: block;
    }

    .index-menu h4 {
        margin-top: 0;
    }

    #ribbon, .page-footer {
        display: none;
    }
}
CSS
);
?>
<div class="index-menu">
    <h4>Welcome to Merlin</h4>
    <h5>The Key Solution Customer Portal</h5>
    <a href="<?= Url::to(['customer/list']) ?>" class="btn btn-primary btn-large btn-block">
        <i class="fa fa-lg fa-male"></i> Customers
    </a>
    <a href="<?= Url::to(['subcontractor/list']) ?>" class="btn btn-primary btn-large btn-block">
        <i class="fa fa-lg fa-handshake-o"></i> HR & Subcontractors
    </a>
    <a href="<?= Url::to(['service/list']) ?>" class="btn btn-primary btn-large btn-block">
        <i class="fa fa-lg fa-wrench"></i> Service & Maintenance
    </a>
</div>