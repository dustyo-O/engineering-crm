<?php
/* @var $this \yii\web\View */
/* @var $subcontractors \common\models\Subcontractor[] */

use yii\helpers\Url;

$this->title = 'Subcontractors list';

$this->params['breadcrumbs'][] = "HR & Subcontractors";

?>
<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a class="btn btn-lg btn-success" href="<?= Url::to(['subcontractor/create']) ?>">Create new</a>

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget">
                <header role="heading">
                    <span class="widget-icon"> <i class="fa fa-handshake-o"></i> </span>
                    <h2>Staff & Subcontractors</h2>

                </header>

                <!-- widget div-->
                <div role="content">

                    <!-- widget content -->
                    <div class="widget-body">

                        <div class="col-sm-12">

                            <div class="well padding-10">

                                <?php
                                foreach ($subcontractors as $subcontractor)
                                {
                                    ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="<?= $subcontractor->photo_id ? Url::to(['documents/download', 'id' => $subcontractor->photo_id ]) : '/img/avatars/male.png" width="100%' ?>" class="img-responsive" alt="img">
                                        <ul class="list-inline padding-10">
                                            <li>
                                                <i class="fa fa-calendar"></i>
                                                <a href="javascript:void(0);">
                                                    <?= (new \DateTime($subcontractor->date_of_commencement))->format('d F Y')  ?>
                                                </a>
                                            </li>
                                            <li class="pull-right">
                                                Status: <label class="label label-success"><?= $subcontractor->status ? $subcontractor->status->title : 'n/a' ?></label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-8 padding-left-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3 class="margin-top-0">
                                                    <a href="<?= Url::to(['subcontractor/edit', 'id' => $subcontractor->id]) ?>">
                                                        <?= $subcontractor->company_name ?>
                                                    </a><br><small class="font-xs"><i>Contact person:
                                                            <a href="<?= Url::to(['subcontractor/edit', 'id' => $subcontractor->id]) ?>"><?= $subcontractor->name ?></a></i></small></h3>
                                            </div>
                                            <div class="col-md-6">
                                                <h1><i class="fa fa-truck"></i> <?= $subcontractor->vehicle_reg ?></h1>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>
                                                    <i class="fa fa-2x fa-map-marker"></i> <?= $subcontractor->address ?><br>
                                                    <i class="fa fa-2x fa-phone"></i> <?= $subcontractor->telephone ?><br>
                                                    <i class="fa fa-2x fa-mobile-phone"></i> <?= $subcontractor->mobile ?><br>
                                                </p>
                                                <a class="btn btn-primary" href="<?= Url::to(['subcontractor/edit', 'id' => $subcontractor->id]) ?>"> Read more </a>
                                            </div>
                                            <div class="col-md-6">
                                                <h4><i>Documents:</i></h4>
                                                <?php
                                                foreach($subcontractor->documents as $document)
                                                {
                                                    ?>
                                                    <a href="<?= Url::to(['documents/download', 'id' => $document->id]) ?>">
                                                        <i class="fa fa-file-o fa-4x text-primary" title="<?= $document->filename ?>"></i>
                                                    </a>
                                                <?php
                                                }
                                                ?>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <hr>
                                    <?php
                                }
                                ?>

                            </div>

                        </div>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </article>
        <!-- WIDGET END -->
    </div>

    <!-- end row -->

</section>
<!-- end widget grid -->


