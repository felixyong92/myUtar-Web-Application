<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\feedback\models\FeedbackResponse */

$this->title = 'Create Feedback Response';
$this->params['breadcrumbs'][] = ['label' => 'Feedback Responses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-response-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
