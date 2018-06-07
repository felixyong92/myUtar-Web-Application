<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\announcement\models\BusService */

$this->title = 'Create Bus Service';
$this->params['breadcrumbs'][] = ['label' => 'Bus Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bus-service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
