<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\assets\ToastAsset;

/* @var $this \yii\web\View */
/* @var $service \common\models\Service */
/* @var $service_call_types \common\models\ServiceCallType[] */

$dropdown_template = $this->render('/construct/dropdown', []);

?>

<div class="row">
    <!-- NEW WIDGET START -->
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php
        $form = ActiveForm::begin(['options' => ['method' => 'post', 'class' => 'customer-form']]);

        if ($service->id) {
            echo $form->field($service, 'id')->hiddenInput()->label(false);
        }
        ?>

        <div class="jarviswidget">
            <header>
                <span class="widget-icon"> <i class="fa fa-briefcase"></i> </span>
                <h2>Service information</h2>
            </header>
            <!-- widget div-->
            <div>
                <!-- widget content -->
                <div class="widget-body">
                    <div>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <?=
                                    $form->field($service, 'customer',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-male' ])])
                                        ->textInput(['placeholder' => 'Steve Defries'])
                                    ?>
                                    <?=
                                    $form->field($service, 'contact',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-id-card-o' ])])
                                        ->textInput()
                                    ?>
                                    <?=
                                    $form->field($service, 'telephone',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-phone' ])])
                                        ->textInput(['placeholder' => '+4 66 558-999-00'])
                                    ?>

                                </div>
                                <div class="col-md-6 address-container">
                                    <?=
                                    $form->field($service, 'address', ['template' => '<h3>{label}</h3>{input}'])
                                        ->textarea()
                                    ?>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-4">
                                    <?=
                                    $form->field($service, 'call_type_id', ['template' => $dropdown_template])
                                        ->dropDownList(ArrayHelper::map($service_call_types, 'id', 'title'), ['prompt' => 'Choose one...']);
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($service, 'date',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-calendar-o' ])])
                                        ->textInput(['placeholder' => '23.11.2017'])
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($service, 'time',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-clock-o' ])])
                                        ->textInput()
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?=
                                    $form->field($service, 'problem_reported',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-bolt' ])])
                                        ->textInput()
                                    ?>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </div>
        <!-- end widget -->
        <button class="btn btn-primary btn-lg save-button" type="submit"><i class="fa fa-save"></i> Save</button><a href="<?= Url::to(['service/list']) ?>" class="btn btn-default btn-lg" type="reset">Cancel</a><a href="<?= Url::to(['service/delete', 'id' => $service->id]) ?>" class="btn btn-danger pull-right delete-btn"><i class="fa fa-trash-o"></i> Delete</a>
        <?php
        ActiveForm::end();
        ?>
    </article>
    <!-- WIDGET END -->
</div>
