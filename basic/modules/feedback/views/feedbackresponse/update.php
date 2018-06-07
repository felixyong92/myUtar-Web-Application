<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\feedback\models\FeedbackResponse */

$this->title = 'Update Feedback Response: ';
$this->params['breadcrumbs'][] = ['label' => 'Feedback Responses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->frId, 'url' => ['view', 'id' => $model->frId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="feedback-response-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
