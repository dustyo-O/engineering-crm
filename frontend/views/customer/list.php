<?php
/* @var $this \yii\web\View */
/* @var $customers \common\models\Customer[] */

use yii\helpers\Url;
use app\assets\DataTablesAsset;

DataTablesAsset::register($this);

$this->registerJS(<<<JS
    $('.customer-table').dataTable();
JS
);
$this->title = 'Customers list';

$this->params['breadcrumbs'][] = "Customers";

?>
<!-- row -->
<div class="row">
    <!-- NEW WIDGET START -->
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <a class="btn btn-lg btn-success" href="<?= Url::to(['customer/create']) ?>">Create new customer</a>
        <table id="dt_basic" class="table table-striped table-bordered table-hover customer-table" width="100%">
            <thead>
            <tr>
                <th data-hide="phone">Quote Number</th>
                <th data-class="expand">Customer Name</th>
                <th data-hide="phone">Customer Number</th>
                <th data-hide="phone,tablet">Contact</th>
                <th>Status</th>
                <th data-hide="phone">Job Type</th>
                <th data-hide="phone"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Date</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($customers as $customer)
            {
                $edit_url = Url::to(['customer/edit', 'id' => $customer->id]);
            ?>
            <tr>
                <td><a href="<?= $edit_url ?>"><?= $customer->quote->quote_number ?></a></td>
                <td><a href="<?= $edit_url ?>"><?= $customer->customer ?></a></td>
                <td><?= $customer->account_number ?></td>
                <td><?= $customer->contact ?></td>
                <td><label class="label label-default"><?= $customer->customerStatus ? $customer->customerStatus->title : 'n/a' ?></label></td>
                <td><?= $customer->job_title ?></td>
                <td><?= (new \DateTime($customer->general->start_date))->format('d F Y') ?></td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </article>
</div>