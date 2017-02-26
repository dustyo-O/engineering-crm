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

Select2Asset::register($this);
ToastAsset::register($this);

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
JS
);
$dropdown_template_no_title = '
    <button class="btn btn-success btn-circle btn-append" data-placement="left" type="button">
    <i class="fa fa-plus"></i></button>
    <label class="select with-plus-btn title">
        {input}
    </label>';

$dropdown_template = '<h3>{label}</h3>' . $dropdown_template_no_title;
?>
<!-- row -->
<div class="row">
    <!-- NEW WIDGET START -->
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php
        $form = ActiveForm::begin(['options' => ['method' => 'post']]);
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
                                        <h3>Customer</h3>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-male"></i></span>
                                            <input type="text" placeholder="Steve Defries" id="customer_name" class="form-control" required="required">
                                        </div>
                                        <h3>Contact</h3>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                            <input type="text" placeholder="2233-1120" id="contact" class="form-control" required="required">
                                        </div>
                                        <h3>Telephone</h3>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                            <input type="text" placeholder="+44 (8-10) ___-___-__-__" id="contact_mobile_phone" class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-md-6 address-container">
                                        <h3>Address</h3>
                                        <textarea id="customer_address" class="form-control" placeholder="London, Main st. 8-45"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3>Job Title</h3>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                                            <input type="text" placeholder="Director of the everything" id="contact_job_title" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Email Address</h3>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                            <input type="text" placeholder="steve@customercare.com" id="email_address" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Mobile</h3>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input type="text" placeholder="+44 (8-10) ___-___-__-__" id="telephone" class="form-control">
                                        </div>
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
                                        <h3>Account Number</h3>
                                        <div class="input-group">
                                            <input type="text" id="account_number" class="form-control" required="required">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default btn-generate">
                                                    <i class="fa fa-magic"></i>
                                                </button>
                                                <button type="button" class="btn btn-default btn-copy">
                                                    <i class="fa fa-clipboard"></i>
                                                </button>
                                            </div>
                                        </div>
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
                                    <h3>Client</h3>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-male"></i></span>
                                        <input type="text" placeholder="Steve Defries" id="client" class="form-control" required="required">
                                    </div>
                                    <h3>Contact</h3>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" placeholder="2233-1120" id="contact" class="form-control" required="required">
                                    </div>
                                    <h3>Telephone</h3>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                        <input type="text" placeholder="+44 (8-10) ___-___-__-__" id="contact_mobile_phone" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 address-container">
                                    <h3>Address</h3>
                                    <textarea id="client_address" class="form-control" placeholder="London, Main st. 8-45"></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Quote number</h3>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-slack"></i></span>
                                        <input type="text" placeholder="DF100433GG00" id="quote_cost" class="form-control" required="required">
                                    </div>
                                    <h3>Quote amount</h3>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                        <input type="text" placeholder="4353" id="quote_amount" class="form-control calendar" required="required">
                                    </div>
<?=
    $form->field($customer_quote, 'quote_status_id', ['template' => $dropdown_template])
        ->dropDownList(ArrayHelper::map($quote_statuses, 'id', 'title'), ['prompt' => 'Choose one...']);
?>
                                </div>
                                <div class="col-md-6 address-container">
                                    <h3>Notes</h3>
                                    <textarea id="notes" class="form-control"></textarea>
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
                                <h3>Key Holder 1</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="text" placeholder="John Snow" id="key_holder_1_name" class="form-control" required="required">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h3>Email</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                    <input type="text" placeholder="key@holder.com" id="key_holder_1_email" class="form-control" required="required">
                                </div>

                            </div>
                            <div class="col-md-4">
                                <h3>Key Holder 1 Contact Number</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                                    <input type="text" placeholder="+44 (8-10) ___-___-__-__" id="key_holder_1_contact_number" class="form-control" required="required">
                                </div>

                            </div>

                            <div class="col-md-4">
                                <h3>Key Holder 2 Name</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="text" placeholder="Olivia Wilde" id="key_holder_2_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h3>Email</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                    <input type="text" placeholder="key@holder.com" id="key_holder_2_email" class="form-control" required="required">
                                </div>

                            </div>
                            <div class="col-md-4">
                                <h3>Key Holder 2 Contact Number</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                                    <input type="text" placeholder="+44 (8-10) ___-___-__-__" id="key_holder_2_contact_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'maintenance_contract_id', ['template' => $dropdown_template])
        ->dropDownList(ArrayHelper::map($general_maintenance_contracts, 'id', 'title'), ['prompt' => 'Choose one...']);
?>
                            </div>
                            <div class="col-md-4">
                                <h3>Contract Start Date</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>
                                    <input type="text" placeholder="23.11.2016" id="contract_start_date" class="form-control calendar" required="required">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h3>Number of Visits</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-wrench"></i></span>
                                    <input type="text" placeholder="" id="number_visits" class="form-control" required="required">
                                </div>
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
                                <h3>URN</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>
                                    <input type="text" placeholder="URN" id="urn" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h3>NSi number</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>
                                    <input type="text" placeholder="NSi number" id="nsi_number" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <h3>Maintenance Cost</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    <input type="text" placeholder="5000" id="Maintenance_cost" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h3>Monitoring Cost</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                    <input type="text" placeholder="6790" id="urn" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
<?=
    $form->field($customer_general, 'signalling_type_id', ['template' => $dropdown_template_no_title])
        ->dropDownList(ArrayHelper::map($general_signalling_types, 'id', 'title'), ['prompt' => 'Choose one...']);
?>

                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                    <input type="text" placeholder="1200" id="other_costs" class="form-control">
                                </div>
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
                                    <h3>Notes</h3>
                                    <textarea id="notes" class="form-control"></textarea>
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
            <button class="btn btn-primary btn-lg save-button" type="submit"><i class="fa fa-save"></i> Save</button><button class="btn btn-default btn-lg" type="reset">Cancel</button><button class="btn btn-danger pull-right delete-btn"><i class="fa fa-trash-o"></i> Delete</button>
        <?php
            ActiveForm::end();
        ?>
    </article>
    <!-- WIDGET END -->

</div>


<!-- end row -->
