<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\feedback\models\Feedback */

$this->title = 'Update Feedback:';
$this->params['breadcrumbs'][] = ['label' => 'Feedback', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Feedback Details', 'url' => ['view', 'id' => $feedback->fId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="feedback-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_updateForm', [
        'model' => $model,
        'responses' => $responses,
        'feedback' => $feedback,
    ]) ?>

</div>
