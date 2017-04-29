<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\assets\Select2Asset;
use app\assets\DateTimePickerAsset;
use app\assets\DropzoneAsset;

/* @var $this \yii\web\View */
/* @var $subcontractor \common\models\Subcontractor */
/* @var $subcontractor_statuses \common\models\SubcontractorStatus[] */
/* @var $subcontractor_positions \common\models\SubcontractorPosition[] */
/* @var $subcontractor_other1_labels \common\models\SubcontractorOther1Label[] */
/* @var $subcontractor_other2_labels \common\models\SubcontractorOther2Label[] */
/* @var $subcontractor_other3_labels \common\models\SubcontractorOther3Label[] */
/* @var $subcontractor_first_aids \common\models\SubcontractorFirstAid[] */

$this->title = $subcontractor->id ? 'Subcontractor ' . $subcontractor->company_name : 'New';

$this->params['breadcrumbs'][] = [
    "url" => Url::to(['subcontractor/list']),
    "label" => "HR & Subcontractors"
];
$this->params['breadcrumbs'][] = $this->title;

$model_add_ajax_url = Url::to(['ajax/model-add']);
$upload_documents_ajax_url = Url::to(['ajax/document-upload']);
$remove_documents_ajax_url = Url::to(['ajax/document-remove']);
$document_download_url = Url::to(['documents/download', 'id' => '']);

$_csrf = Yii::$app->request->getCsrfToken();

$subcontractor_dropzone_data = [];
foreach ($subcontractor->documents as $subcontractor_document)
{
    /* @var $subcontractor_document \common\models\Documents */
    $subcontractor_dropzone_data[] = [
        'id' => $subcontractor_document->id,
        'name' => $subcontractor_document->filename,
        'size' => $subcontractor_document->getFileSize()
    ];
}

$subcontractor_dropzone_json = json_encode($subcontractor_dropzone_data);

Select2Asset::register($this);
DateTimePickerAsset::register($this);
DropzoneAsset::register($this);

$this->registerJsFile('/js/input-plugins-init.js', ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile('/js/dropzone-documents-init.js', ['depends' => ['yii\web\JqueryAsset']]);

$this->registerJs(<<<JS
var subcontractorDocuments = {$subcontractor_dropzone_json};

$('.datepicker-input').datetimepicker({
    format: 'DD.MM.YYYY'
});

Dropzone.autoDiscover = false;

new Dropzone('.photo-dropzone', {
    url: '{$upload_documents_ajax_url}',
    paramName: 'Documents[file]',
    acceptedFiles: 'image/*',
    sending: function(file, xhr, formData) {
        formData.append('_csrf-frontend', '{$_csrf}');
    },
    success: function(file, response) {
        if (response) {
            $('input[name="Subcontractor[photo_id]"]').val(response.id);
        }
        
        $('.photo-dropzone').css('background-image', "url('".concat('{$document_download_url}', response.id, "')"));
        this.removeFile(file);
    }
});

initPopovers('{$model_add_ajax_url}');
initDocumentsDropzone('subcontractor', subcontractorDocuments, '{$upload_documents_ajax_url}', 
    '{$document_download_url}', '{$remove_documents_ajax_url}', '{$_csrf}');
JS
);

$this->registerCss(<<<CSS
.photo-dropzone {
    background-size: cover;
}
CSS
);

$dropdown_template = $this->render('/construct/dropdown', []);
$dropdown_template_no_title = $this->render('/construct/dropdown-no-title', []);
?>

<div class="row">
    <!-- NEW WIDGET START -->
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php
        $form = ActiveForm::begin(['options' => ['method' => 'post', 'class' => 'customer-form']]);

        if ($subcontractor->id) {
            echo $form->field($subcontractor, 'id')->hiddenInput()->label(false);
        }
        ?>

        <div class="jarviswidget">
            <header>
                <span class="widget-icon"> <i class="fa fa-briefcase"></i> </span>
                <h2>Information</h2>
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
                                    $form->field($subcontractor, 'name',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-male' ])])
                                        ->textInput(['placeholder' => 'Steve Defries'])
                                    ?>
                                    <?=
                                    $form->field($subcontractor, 'company_name',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-building-o' ])])
                                        ->textInput()
                                    ?>
                                    <?=
                                    $form->field($subcontractor, 'date_of_commencement',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-calendar-check-o' ])])
                                        ->textInput(['placeholder' => '23.11.2019', 'class' => 'datepicker-input form-control'])
                                    ?>

                                </div>
                                <div class="col-md-6 address-container">
                                    <?=
                                    $form->field($subcontractor, 'address', ['template' => '<h3>{label}</h3>{input}'])
                                        ->textarea()
                                    ?>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'status_id', ['template' => $dropdown_template])
                                        ->dropDownList(ArrayHelper::map($subcontractor_statuses, 'id', 'title'),
                                            ['prompt' => 'Choose one...']);
                                    ?>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'telephone',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-phone' ])])
                                        ->textInput(['placeholder' => '+1 044 7899 004 44'])
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'mobile',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-mobile' ])])
                                        ->textInput(['placeholder' => '+1 044 7899 004 44'])
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'email',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-envelope-o' ])])
                                        ->textInput(['placeholder' => 'customer@gmail.com'])
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'ni_number',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-info' ])])
                                        ->textInput([])
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'staff_number',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-users' ])])
                                        ->textInput([])
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'position_id', ['template' => $dropdown_template])
                                        ->dropDownList(ArrayHelper::map($subcontractor_positions, 'id', 'title'),
                                            ['prompt' => 'Choose one...']);
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'vehicle_reg',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-truck' ])])
                                        ->textInput([])
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'ipaf',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-building' ])])
                                        ->textInput([])
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'cscs',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-credit-card-alt' ])])
                                        ->textInput([])
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'driving_license',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-id-card-o' ])])
                                        ->textInput([])
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'other1_label_id', ['template' => $dropdown_template_no_title])
                                        ->dropDownList(ArrayHelper::map($subcontractor_other1_labels, 'id', 'title'),
                                            ['prompt' => 'Choose one...']);
                                    ?>
                                    <?=
                                    $form->field($subcontractor, 'other1', ['template' => '
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    {input}
                                </div>
'])->textInput()
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'other2_label_id', ['template' => $dropdown_template_no_title])
                                        ->dropDownList(ArrayHelper::map($subcontractor_other2_labels, 'id', 'title'),
                                            ['prompt' => 'Choose one...']);
                                    ?>
                                    <?=
                                    $form->field($subcontractor, 'other2', ['template' => '
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    {input}
                                </div>
'])->textInput()
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'first_aid_id', ['template' => $dropdown_template])
                                        ->dropDownList(ArrayHelper::map($subcontractor_first_aids, 'id', 'title'),
                                            ['prompt' => 'Choose one...']);
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'subcontractor_pack',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-calendar-o' ])])
                                        ->textInput(['placeholder' => '11.03.2017', 'class' => 'datepicker-input form-control'])
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'other3_label_id', ['template' => $dropdown_template_no_title])
                                        ->dropDownList(ArrayHelper::map($subcontractor_other3_labels, 'id', 'title'),
                                            ['prompt' => 'Choose one...']);
                                    ?>
                                    <?=
                                    $form->field($subcontractor, 'other3', ['template' => '
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    {input}
                                </div>
'])->textInput()
                                    ?>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <?=
                                    $form->field($subcontractor, 'training_courses', ['template' => '<h3>{label}</h3>{input}'])
                                        ->textarea()
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <?=
                                    $form->field($subcontractor, 'qualifications', ['template' => '<h3>{label}</h3>{input}'])
                                        ->textarea()
                                    ?>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Documents</h3>
                                    <div class="dropzone subcontractor-documents"></div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'insurance_expire',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-calendar-times-o' ])])
                                        ->textInput(['placeholder' => '11.03.2017', 'class' => 'datepicker-input form-control'])
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'screening',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-calendar' ])])
                                        ->textInput(['placeholder' => '11.03.2017', 'class' => 'datepicker-input form-control'])
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($subcontractor, 'hs_pack',
                                        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-calendar-plus-o' ])])
                                        ->textInput(['placeholder' => '11.03.2017', 'class' => 'datepicker-input form-control'])
                                    ?>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-8 address-container">
                                    <?=
                                    $form->field($subcontractor, 'notes', ['template' => '<h3>{label}</h3>{input}'])
                                        ->textarea()
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <h3>Photo</h3>
                                    <div class="dropzone photo-dropzone"<?php
                                    if ($subcontractor->photo_id) {
                                        echo 'style="background-image: url(\'' .
                                            $document_download_url . $subcontractor->photo_id . '\')"';
                                    }
                                    ?>></div>
                                </div>
                            </div>
                            <?= $form->field($subcontractor, 'photo_id')->hiddenInput()->label(false); ?>
                        </fieldset>
                    </div>
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </div>
        <!-- end widget -->
        <button class="btn btn-primary btn-lg save-button" type="submit"><i class="fa fa-save"></i> Save</button>
        <a href="<?= Url::to(['service/list']) ?>" class="btn btn-default btn-lg" type="reset">Cancel</a>
        <a href="<?= Url::to(['service/delete', 'id' => $subcontractor->id]) ?>" class="btn btn-danger pull-right delete-btn">
            <i class="fa fa-trash-o"></i> Delete
        </a>
        <?php
        ActiveForm::end();
        ?>
    </article>
    <!-- WIDGET END -->
</div>
