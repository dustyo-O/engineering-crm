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
use app\assets\ToastAsset;
use app\assets\DateTimePickerAsset;

Select2Asset::register($this);
DateTimePickerAsset::register($this);

$model_add_ajax_url = Url::to(['ajax/model-add']);

$this->registerJs(<<<JS
const SUCCESS_COLOR = '#71843f';
const ERROR_COLOR = '#a90329';

$('article select').select2({
    minimumResultsForSearch: Infinity
});

$(".btn-append").popover(
    {
        'title': 'Add new element',
        'html': true,
        'content': '<label class="input"><input type="text"/></label><button class="btn btn-default btn-block btn-popover" type="button"><i class="fa fa-check"></i> Add</button>'
    }
);

$(document).on('click','.btn-popover', function () {
    var select = $(this).parent().parent().next().find("select");
    var value = $(this).prev().find("input").val();

    var selectName = select.prop('name');
    
    var baseModel = selectName.substring(0, selectName.indexOf('[')).toLowerCase();
    var field = selectName.substring(selectName.indexOf('[') + 1, selectName.indexOf('_id]'));
    
    if (baseModel !== 'customer') baseModel = baseModel.replace('customer', '');
    
    // field name can start from base model name, but related model won't start with two same words
    // example: Customer[customer_status_id] => customer_status => CustomerStatus (not CustomerCustomerStatus)
    var modelName = (baseModel !== field.split('_')[0] ? baseModel + '_' : '').concat(field);
    
    // disable button
    $(this).prop('disabled', 'disabled');
    $('i', $(this)).removeClass('fa-check');
    $('i', $(this)).addClass('fa-spinner');
    $('i', $(this)).addClass('fa-pulse');
    
    $.ajax({
        url: '{$model_add_ajax_url}',
        method: 'post',
        data: {
            name: modelName,
            title: value
        },
        type: 'json',
        context: this
    })
    .done(function(response) {
        select.append(
            $('<option/>', { value: response.id, text: value })    
        );
        select.trigger('change');
        
        $.toast({
            heading: 'Element Added',
            text: 'New element added successfully - check the list',
            icon: 'info',
            loader: false,
            loaderBg: SUCCESS_COLOR,
            position: 'top-right'
        });
    })
    .fail(function() {
        $.toast({
            heading: 'Error',
            text: 'Element was not added. Try to repeat your request or refresh the page',
            icon: 'error',
            loader: false,
            loaderBg: ERROR_COLOR,
            position: 'top-right'
        });            
    })
    .complete(function() {
        // enable button
        $(this).prop('disabled', false);
        $('i', $(this)).addClass('fa-check');
        $('i', $(this)).removeClass('fa-spinner');
        $('i', $(this)).removeClass('fa-pulse');

        $(this).parent().parent().popover('hide');        
    });
});

$('#customergeneral-start_date').datetimepicker({
    format: 'DD.MM.YYYY'
});
JS
);
$dropdown_template_no_title = '
    <button class="btn btn-success btn-circle btn-append" data-placement="left" type="button">
    <i class="fa fa-plus"></i></button>
    <label class="select with-plus-btn title">
        {input}
    </label>';

$dropdown_template = '<h3>{label}</h3>
    <button class="btn btn-success btn-circle btn-append" data-placement="left" type="button">
    <i class="fa fa-plus"></i></button>
    <label class="select with-plus-btn">
        {input}
    </label>';

function inputTemplate($icon)
{
    return <<<HTML
<h3>{label}</h3>
<div class="input-group">
    <span class="input-group-addon"><i class="fa {$icon}"></i></span>
    {input}
</div>
HTML;
}
?>
<!-- row -->
<div class="row">
    <!-- NEW WIDGET START -->
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php
        $form = ActiveForm::begin(['options' => ['method' => 'post']]);

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
    $form->field($customer, 'customer', ['template' => inputTemplate('fa-male')])
        ->textInput(['placeholder' => 'Steve Defries'])
?>
<?=
    $form->field($customer, 'contact', ['template' => inputTemplate('fa-id-card-o')])
        ->textInput()
?>
<?=
    $form->field($customer, 'telephone', ['template' => inputTemplate('fa-phone')])
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
    $form->field($customer, 'job_title', ['template' => inputTemplate('fa-briefcase')])
        ->textInput(['placeholder' => 'Director of Everything'])
?>
                                    </div>
                                    <div class="col-md-4">
<?=
    $form->field($customer, 'email', ['template' => inputTemplate('fa-envelope-o')])
        ->textInput(['placeholder' => 'steve@customercare.com'])
?>
                                    </div>
                                    <div class="col-md-4">
<?=
    $form->field($customer, 'mobile', ['template' => inputTemplate('fa-mobile')])
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
    $form->field($customer, 'account_number', ['template' => inputTemplate('fa-id-badge')])
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
    $form->field($customer_quote, 'client', ['template' => inputTemplate('fa-male')])
        ->textInput()
?>
<?=
    $form->field($customer_quote, 'contact', ['template' => inputTemplate('fa-address-card-o')])
        ->textInput()
?>
<?=
    $form->field($customer_quote, 'telephone', ['template' => inputTemplate('fa-phone')])
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
    $form->field($customer_quote, 'quote_number', ['template' => inputTemplate('fa-hashtag')])
        ->textInput()
?>
<?=
    $form->field($customer_quote, 'quote_amount', ['template' => inputTemplate('fa-euro')])
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
                                <div class="dropzone" id="mydropzone"></div>
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
    $form->field($customer_general, 'key_holder_1', ['template' => inputTemplate('fa-key')])
        ->textInput()
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'key_holder_1_email', ['template' => inputTemplate('fa-envelope')])
        ->textInput()
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'key_holder_1_phone', ['template' => inputTemplate('fa-phone-square')])
        ->textInput(['placeholder' => '+44 (8-10) ___-___-__-__'])
?>
                            </div>

                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'key_holder_2', ['template' => inputTemplate('fa-key')])
        ->textInput()
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'key_holder_2_email', ['template' => inputTemplate('fa-envelope')])
        ->textInput()
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'key_holder_2_phone', ['template' => inputTemplate('fa-phone-square')])
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
    $form->field($customer_general, 'start_date', ['template' => inputTemplate('fa-calendar-o')])
        ->textInput(['placeholder' => '23.11.2017'])
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'number_of_visits', ['template' => inputTemplate('fa-medkit')])
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
    $form->field($customer_general, 'urn', ['template' => inputTemplate('fa-tag')])
        ->textInput()
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'nsi_number', ['template' => inputTemplate('fa-university')])
        ->textInput()
?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'maintenance_cost', ['template' => inputTemplate('fa-wrench')])
        ->textInput()
?>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'monitoring_cost', ['template' => inputTemplate('fa-area-chart')])
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
                                <div class="dropzone" id="mydropzone"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-lg save-button" type="submit"><i class="fa fa-save"></i> Save</button><a href="<?= Url::to(['customer/list']) ?>" class="btn btn-default btn-lg" type="reset">Cancel</a><a href="<?= Url::to(['customer/delete', 'id' => $customer->id]) ?>" class="btn btn-danger pull-right delete-btn"><i class="fa fa-trash-o"></i> Delete</a>
        <?php
            ActiveForm::end();
        ?>
    </article>
    <!-- WIDGET END -->

</div>


<!-- end row -->
