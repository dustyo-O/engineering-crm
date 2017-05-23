<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\assets\Select2Asset;
use app\assets\DateTimePickerAsset;
use app\assets\DropzoneAsset;

/* @var $this \yii\web\View */
/* @var $model frontend\models\ResetPasswordForm */

$user = \Yii::$app->user->identity;

$this->title = $user->username . ' change password ';

$this->params['breadcrumbs'][] = 'Change password';
?>

<div class="row">
    <!-- NEW WIDGET START -->
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php
        $form = ActiveForm::begin(['options' => ['method' => 'post', 'class' => 'password-form']]);
        ?>

        <div class="jarviswidget">
            <header>
                <span class="widget-icon"> <i class="fa fa-key"></i> </span>
                <h2>Change password</h2>
            </header>
            <!-- widget div-->
            <div>
                <!-- widget content -->
                <div class="widget-body">
                    <?=
                    $form->field($model, 'password',
                        ['template' => $this->render('/construct/input-hint', [ 'icon' => 'fa-lock' ])])
                        ->passwordInput()
                    ?>
                    <?=
                    $form->field($model, 'password_repeat',
                        ['template' => $this->render('/construct/input-hint', [ 'icon' => 'fa-lock' ])])
                        ->passwordInput()
                    ?>
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </div>
        <!-- end widget -->
        <button class="btn btn-primary btn-lg save-button" type="submit"><i class="fa fa-save"></i> Save</button>
        <a href="<?= Url::to(['site/index']) ?>" class="btn btn-default btn-lg" type="reset">Cancel</a>
        <?php
        ActiveForm::end();
        ?>
    </article>
    <!-- WIDGET END -->
</div>
