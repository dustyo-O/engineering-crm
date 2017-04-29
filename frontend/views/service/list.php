<?php
/* @var $this \yii\web\View */
/* @var $services \common\models\Service[] */

use yii\helpers\Url;
use app\assets\FullCalendarAsset;

$this->title = 'Services calendar';

$this->params['breadcrumbs'][] = "Service & Maintenance";

FullCalendarAsset::register($this);

$event_edit_url = Url::to(['service/edit', 'id' => '']);

$js_services = [];
foreach($services as $service) {
    $js_services[] = [
        'title' => $service->problem_reported,
        'start' => $service->date,
        'id' => $service->id
    ];
}

$js_events = json_encode($js_services);

$this->registerJs(<<<JS
$('.calendar').fullCalendar({
    events: JSON.parse('{$js_events}'),
    eventClick: function(event) {
        if (event.id) {
            window.location.href = '{$event_edit_url}' + event.id;
            return false;
        }
    }
});
JS
);
?>
<div class="row">
    <!-- NEW WIDGET START -->
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <a class="btn btn-lg btn-success" href="<?= Url::to(['service/create']) ?>">Create new visit</a>
        <div class="calendar"></div>
    </article>
</div>
