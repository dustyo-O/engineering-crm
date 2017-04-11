<?php
/* @var $this \yii\web\View */
/* @var $customer \common\models\Customer */
/* @var $customer_system_types \common\models\CustomerSystemType[] */
/* @var $customer_statuses \common\models\CustomerStatus[] */
/* @var $customer_quote \common\models\CustomerQuote */
/* @var $quote_statuses \common\models\QuoteStatus[] */
/* @var $customer_general \common\models\CustomerGeneral */
/* @var $general_maintenance_contracts \common\models\GeneralMaintenanceContract[] */
/* @var $general_signalling_types \common\models\GeneralSignallingType[] */
/* @var $general_other_labels \common\models\GeneralOtherLabel[] */
/* @var $general_account_managers \common\models\GeneralAccountManager[] */
/* @var $general_misc1 \common\models\GeneralMisc1[] */
/* @var $general_misc1_labels \common\models\GeneralMisc1Label[] */
/* @var $general_misc2 \common\models\GeneralMisc2[] */
/* @var $general_misc2_labels \common\models\GeneralMisc2Label[] */

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\assets\Select2Asset;
use app\assets\DateTimePickerAsset;
use app\assets\DropzoneAsset;

$this->title = $customer->id ? 'Customer ' . $customer->customer : 'New customer';

$this->params['breadcrumbs'][] = [
    "url" => Url::to(['customer/list']),
    "label" => "Customers"
];
$this->params['breadcrumbs'][] = $this->title;

Select2Asset::register($this);
DateTimePickerAsset::register($this);
DropzoneAsset::register($this);

$model_add_ajax_url = Url::to(['ajax/model-add']);
$upload_documents_ajax_url = Url::to(['ajax/document-upload']);
$remove_documents_ajax_url = Url::to(['ajax/document-remove']);
$document_download_url = Url::to(['documents/download', 'id' => '']);

$_csrf = Yii::$app->request->getCsrfToken();

$quote_documents = $customer_quote->documents;
$quote_dropzone_data = [];
foreach ($quote_documents as $quote_document)
{
    $quote_dropzone_data[] = [
        'id' => $quote_document->id,
        'name' => $quote_document->filename,
        'size' => $quote_document->getFileSize()
    ];
}

$quote_dropzone_json = json_encode($quote_dropzone_data);

$general_documents = $customer_general->documents;
$general_dropzone_data = [];
foreach ($general_documents as $general_document)
{
    /* @var $general_document \common\models\Documents */
    $general_dropzone_data[] = [
        'id' => $general_document->id,
        'name' => $general_document->filename,
        'size' => $general_document->getFileSize()
    ];
}

$general_dropzone_json = json_encode($general_dropzone_data);

$this->registerJsFile('/js/input-plugins-init.js', ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile('/js/dropzone-documents-init.js', ['depends' => ['yii\web\JqueryAsset']]);

$this->registerJs(<<<JS
var quoteDocuments = {$quote_dropzone_json};
var generalDocuments = {$general_dropzone_json};

$('#customergeneral-start_date').datetimepicker({
    format: 'DD.MM.YYYY'
});

Dropzone.autoDiscover = false;

initPopovers('{$model_add_ajax_url}');

initDocumentsDropzone('quote', quoteDocuments, '{$upload_documents_ajax_url}', '{$document_download_url}', 
    '{$remove_documents_ajax_url}', '{$_csrf}');
initDocumentsDropzone('general', generalDocuments, '{$upload_documents_ajax_url}', '{$document_download_url}', 
    '{$remove_documents_ajax_url}', '{$_csrf}');
JS
);

$dropdown_template = $this->render('/construct/dropdown', []);
$dropdown_template_no_title = $this->render('/construct/dropdown-no-title', []);
?>
<!-- row -->
<div class="row">
    <!-- NEW WIDGET START -->
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php
        $form = ActiveForm::begin(['options' => ['method' => 'post', 'class' => 'customer-form']]);

        if ($customer->id) {
            echo $form->field($customer, 'id')->hiddenInput()->label(false);
            echo $form->field($customer_quote, 'id')->hiddenInput()->label(false);
            echo $form->field($customer_general, 'id')->hiddenInput()->label(false);
        }
        ?>

            <div class="jarviswidget">
                <header>
                    <span class="widget-icon"> <i class="fa fa-briefcase"></i> </span>
                    <h2>Customer information</h2>
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
    $form->field($customer, 'customer', ['template' => $this->render('/construct/input', ['icon' => 'fa-male'])])
        ->textInput(['placeholder' => 'Steve Defries'])
?>
<?=
    $form->field($customer, 'contact', ['template' => $this->render('/construct/input', ['icon' => 'fa-id-card-o'])])
        ->textInput()
?>
<?=
    $form->field($customer, 'telephone', ['template' => $this->render('/construct/input', [ 'icon' => 'fa-phone'])])
        ->textInput(['placeholder' => '+4 66 558-999-00'])
?>

                                    </div>
                                    <div class="col-md-6 address-container">
<?=
    $form->field($customer, 'address', ['template' => '<h3>{label}</h3>{input}'])
        ->textarea()
?>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-4">
<?=
    $form->field($customer, 'job_title', ['template' => $this->render('/construct/input', ['icon' => 'fa-briefcase'])])
        ->textInput(['placeholder' => 'Director of Everything'])
?>
                                    </div>
                                    <div class="col-md-4">
<?=
    $form->field($customer, 'email', ['template' => $this->render('/construct/input', ['icon' => 'fa-envelope-o'])])
        ->textInput(['placeholder' => 'steve@customercare.com'])
?>
                                    </div>
                                    <div class="col-md-4">
<?=
    $form->field($customer, 'mobile', ['template' => $this->render('/construct/input', ['icon' => 'fa-mobile'])])
        ->textInput(['placeholder' => '+4 66 558-999-00'])
?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
<?=
    $form->field($customer, 'system_type_id', ['template' => $dropdown_template])
        ->dropDownList(ArrayHelper::map($customer_system_types, 'id', 'title'), ['prompt' => 'Choose one...']);
?>
                                    </div>
                                    <div class="col-md-4">
<?=
    $form->field($customer, 'customer_status_id', ['template' => $dropdown_template])
        ->dropDownList(ArrayHelper::map($customer_statuses, 'id', 'title'), ['prompt' => 'Choose one...']);
?>
                                    </div>
                                    <div class="col-md-4 form-group">
<?=
    $form->field($customer, 'account_number', ['template' => $this->render('/construct/input', ['icon' => 'fa-id-badge'])])
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
            <div class="jarviswidget">
                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Quotation information</h2>

                </header>

                <!-- widget div-->
                <div>
                    <!-- widget content -->
                    <div class="widget-body">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
<?=
    $form->field($customer_quote, 'client', ['template' => $this->render('/construct/input', ['icon' => 'fa-male'])])
        ->textInput()
?>
<?=
    $form->field($customer_quote, 'contact',
        ['template' => $this->render('/construct/input', ['icon' => 'fa-address-card-o'])])
        ->textInput()
?>
<?=
    $form->field($customer_quote, 'telephone',
        ['template' => $this->render('/construct/input', ['icon' => 'fa-phone'])])
        ->textInput(['placeholder' => '+44 (8-10) ___-___-__-__'])
?>
                                </div>
                                <div class="col-md-6 address-container">
<?=
    $form->field($customer_quote, 'address', ['template' => '<h3>{label}</h3>{input}'])
        ->textarea()
?>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
<?=
    $form->field($customer_quote, 'quote_number',
        ['template' => $this->render('/construct/input', ['icon' => 'fa-hashtag'])])
        ->textInput()
?>
<?=
    $form->field($customer_quote, 'quote_amount',
        ['template' => $this->render('/construct/input', [ 'icon' => 'fa-euro'])])
        ->textInput()
?>
<?=
    $form->field($customer_quote, 'quote_status_id', ['template' => $dropdown_template])
        ->dropDownList(ArrayHelper::map($quote_statuses, 'id', 'title'), ['prompt' => 'Choose one...']);
?>
                                </div>
                                <div class="col-md-6 address-container">
<?=
    $form->field($customer_quote, 'notes', ['template' => '<h3>{label}</h3>{input}'])
        ->textarea()
?>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Quote Documents</h3>
                                <div class="dropzone quote-documents"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jarviswidget">
                <header>
                    <span class="widget-icon"> <i class="fa fa-home"></i> </span>
                    <h2>General info</h2>

                </header>

                <!-- widget div-->
                <div>
                    <!-- widget content -->
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'key_holder_1',
        ['template' => $this->render('/construct/input', ['icon' => 'fa-key'])])
        ->textInput()
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'key_holder_1_email',
        ['template' => $this->render('/construct/input', ['icon' => 'fa-envelope'])])
        ->textInput()
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'key_holder_1_phone',
        ['template' => $this->render('/construct/input', ['icon' => 'fa-phone-square'])])
        ->textInput(['placeholder' => '+44 (8-10) ___-___-__-__'])
?>
                            </div>

                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'key_holder_2',
        ['template' => $this->render('/construct/input', ['icon' => 'fa-key'])])
        ->textInput()
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'key_holder_2_email',
        ['template' => $this->render('/construct/input', ['icon' => 'fa-envelope'])])
        ->textInput()
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'key_holder_2_phone',
        ['template' => $this->render('/construct/input', ['icon' => 'fa-phone-square'])])
        ->textInput(['placeholder' => '+44 (8-10) ___-___-__-__'])
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'maintenance_contract_id', ['template' => $dropdown_template])
        ->dropDownList(ArrayHelper::map($general_maintenance_contracts, 'id', 'title'), ['prompt' => 'Choose one...']);
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'start_date',
        ['template' => $this->render('/construct/input', ['icon' => 'fa-calendar-o'])])
        ->textInput(['placeholder' => '23.11.2017'])
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'number_of_visits',
        ['template' => $this->render('/construct/input', ['icon' => 'fa-medkit'])])
        ->textInput()
?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'signalling_type_id', ['template' => $dropdown_template])
        ->dropDownList(ArrayHelper::map($general_signalling_types, 'id', 'title'), ['prompt' => 'Choose one...']);
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'urn', ['template' => $this->render('/construct/input', ['icon' => 'fa-tag'])])
        ->textInput()
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'nsi_number',
        ['template' => $this->render('/construct/input', ['icon' => 'fa-university'])])
        ->textInput()
?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'maintenance_cost',
        ['template' => $this->render('/construct/input', ['icon' => 'fa-wrench'])])
        ->textInput()
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'monitoring_cost',
        ['template' => $this->render('/construct/input', ['icon' => 'fa-area-chart'])])
        ->textInput()
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'other_label_id', ['template' => $dropdown_template_no_title])
        ->dropDownList(ArrayHelper::map($general_other_labels, 'id', 'title'), ['prompt' => 'Choose one...']);
?>
<?=
$form->field($customer_general, 'other_costs', ['template' => '
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    {input}
                                </div>
'])->textInput()
?>
                            </div>
                        </div>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="siderow">
<?=
$form->field($customer_general, 'account_manager_id', ['template' => $dropdown_template])
    ->dropDownList(ArrayHelper::map($general_account_managers, 'id', 'title'), ['prompt' => 'Choose one...']);
?>
                                    </div>
                                    <div class="siderow">
<?=
    $form->field($customer_general, 'misc1_label_id', ['template' => $dropdown_template_no_title])
        ->dropDownList(ArrayHelper::map($general_misc1_labels, 'id', 'title'), ['prompt' => 'Choose one...']);
?>

                                    </div>
                                    <div class="siderow">
<?=
    $form->field($customer_general, 'misc1_id', ['template' => $dropdown_template_no_title])
        ->dropDownList(ArrayHelper::map($general_misc1, 'id', 'title'), ['prompt' => 'Choose one...']);
?>
                                    </div>
                                    <div class="siderow">
<?=
    $form->field($customer_general, 'misc2_label_id', ['template' => $dropdown_template_no_title])
        ->dropDownList(ArrayHelper::map($general_misc2_labels, 'id', 'title'), ['prompt' => 'Choose one...']);
?>
                                    </div>
                                    <div class="siderow">
<?=
    $form->field($customer_general, 'misc2_id', ['template' => $dropdown_template_no_title])
        ->dropDownList(ArrayHelper::map($general_misc2, 'id', 'title'), ['prompt' => 'Choose one...']);
?>
                                    </div>
                                </div>
                                <div class="col-md-6 address-container">
<?=
    $form->field($customer_general, 'notes', ['template' => '<h3>{label}</h3>{input}'])
        ->textarea()
?>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Service & Maintenance Documents</h3>
                                <div class="dropzone general-documents"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-lg save-button" type="submit"><i class="fa fa-save"></i> Save</button>
            <a href="<?= Url::to(['customer/list']) ?>" class="btn btn-default btn-lg" type="reset">Cancel</a>
            <a href="<?= Url::to(['customer/delete', 'id' => $customer->id]) ?>" class="btn btn-danger pull-right delete-btn">
                <i class="fa fa-trash-o"></i> Delete
            </a>
        <?php
            ActiveForm::end();
        ?>
    </article>
    <!-- WIDGET END -->

</div>

<iframe style="display: none" class="download-file"></iframe>
<!-- end row -->
