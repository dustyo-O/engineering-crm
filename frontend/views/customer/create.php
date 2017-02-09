<?php
/**
 * Created by PhpStorm.
 * User: dusty
 * Date: 08.02.17
 * Time: 22:58
 */

?>

<!-- row -->
<div class="row">

    <!-- NEW WIDGET START -->
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form action="" id="customer_form">

            <div class="jarviswidget">
                <header>
                    <span class="widget-icon"> <i class="fa fa-briefcase"></i> </span>
                    <h2>Customer information</h2>

                </header>

                <!-- widget div-->
                <div>


                    <!-- widget content -->
                    <div class="widget-body">

                        <div class="smart-form">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Status</h3>
                                        <button class="btn btn-success btn-circle btn-append" type="button"><i class="fa fa-plus"></i></button>
                                        <label class="select with-plus-btn">
                                            <select id="status" class="input-sm">
                                                <option value="0">Choose one...</option>
                                                <option>Order accepted</option>
                                                <option>Waiting for payment</option>
                                                <option>Work planned</option>
                                                <option>Work in-action</option>
                                                <option>Work paused</option>
                                                <option>Work resumed</option>
                                                <option>Work finished</option>
                                                <option>Aborted</option>
                                            </select><i></i>
                                        </label>

                                    </div>
                                    <div class="col-md-6">
                                        <h3>Job Type</h3>
                                        <button class="btn btn-success btn-circle btn-append" data-placement="left" type="button"><i class="fa fa-plus"></i></button>
                                        <label class="select with-plus-btn">
                                            <select id="job_type" class="input-sm">
                                                <option value="0">Choose one...</option>
                                                <option>Repair</option>
                                                <option>Build new house</option>
                                                <option>Glue Papers</option>
                                            </select><i></i>
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <h3>Quote Number</h3>
                                        <div class="input-group">
                                            <input type="text" id="quote_number" class="form-control" required="required">
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
                                    <div class="col-md-6 form-group">
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
                        <div>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Customer Name</h3>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-male"></i></span>
                                            <input type="text" placeholder="Steve Defries" id="customer_name" class="form-control" required="required">
                                        </div>
                                        <h3>Contact</h3>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                            <input type="text" placeholder="2233-1120" id="contact" class="form-control" required="required">
                                        </div>
                                        <h3>Contact Mobile Number</h3>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                            <input type="text" placeholder="+44 (8-10) ___-___-__-__" id="contact_mobile_phone" class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-md-6 address-container">
                                        <h3>Customer Address</h3>
                                        <textarea id="customer_address" class="form-control" placeholder="London, Main st. 8-45"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Contact Job Title</h3>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                                            <input type="text" placeholder="Director of the everything" id="contact_job_title" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3>Email Address</h3>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                            <input type="text" placeholder="steve@customercare.com" id="email_address" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3>Telephone</h3>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input type="text" placeholder="+44 (8-10) ___-___-__-__" id="telephone" class="form-control">
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
                    <h2>Quote info</h2>

                </header>

                <!-- widget div-->
                <div>
                    <!-- widget content -->
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Quote cost</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                    <input type="text" placeholder="10000" id="quote_cost" class="form-control" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Quote date</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>
                                    <input type="text" placeholder="23.11.2016" id="quote_date" class="form-control calendar" required="required">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h3>Notes</h3>
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Documents</h3>
                                <div class="dropzone" id="mydropzone"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jarviswidget">
                <header>
                    <span class="widget-icon"> <i class="fa fa-home"></i> </span>
                    <h2>Facility info</h2>

                </header>

                <!-- widget div-->
                <div>
                    <!-- widget content -->
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Key Holder 1 Name</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="text" placeholder="John Snow" id="key_holder_1_name" class="form-control" required="required">
                                </div>
                                <h3>Key Holder 1 Contact Number</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                                    <input type="text" placeholder="+44 (8-10) ___-___-__-__" id="key_holder_1_contact_number" class="form-control" required="required">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <h3>Key Holder 2 Name</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="text" placeholder="Olivia Wilde" id="key_holder_2_name" class="form-control">
                                </div>
                                <h3>Key Holder 2 Contact Number</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                                    <input type="text" placeholder="+44 (8-10) ___-___-__-__" id="key_holder_2_contact_number" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-12">
                                <h3>Maintenance Contract</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                                    <input type="text" placeholder="N22333454" id="maintenance_contract" class="form-control" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Contract Start Date</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>
                                    <input type="text" placeholder="23.11.2016" id="contract_start_date" class="form-control calendar" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Number of Visits</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-wrench"></i></span>
                                    <input type="text" placeholder="" id="number_visits" class="form-control" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="smart-form">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Signalling Type</h3>
                                        <button class="btn btn-success btn-circle btn-append" data-placement="left" type="button"><i class="fa fa-plus"></i></button>
                                        <label class="select with-plus-btn">
                                            <select id="signalling_type" class="input-sm">
                                                <option value="0">No signalling...</option>
                                                <option>Dog</option>
                                            </select><i></i>
                                        </label>

                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h3>URN</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>
                                    <input type="text" placeholder="URN" id="urn" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>NSi number</h3>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>
                                    <input type="text" placeholder="NSi number" id="nsi_number" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="smart-form">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Account Manager</h3>
                                        <button class="btn btn-success btn-circle btn-append" data-placement="left" type="button"><i class="fa fa-plus"></i></button>
                                        <label class="select with-plus-btn">
                                            <select id="account_manager" class="input-sm">
                                                <option value="0">Not assigned...</option>
                                                <option>Steve Defries</option>
                                            </select><i></i>
                                        </label>

                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-lg save-button" type="submit"><i class="fa fa-save"></i> Save</button><button class="btn btn-default btn-lg" type="reset">Cancel</button><button class="btn btn-danger pull-right delete-btn"><i class="fa fa-trash-o"></i> Delete</button>
        </form>
    </article>
    <!-- WIDGET END -->

</div>


<!-- end row -->
