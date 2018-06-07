<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\feedback\models\FeedbackResponseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-response-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'frId') ?>

    <?= $form->field($model, 'fResponse') ?>

    <?= $form->field($model, 'frDateTime') ?>

    <?= $form->field($model, 'fId') ?>

    <?= $form->field($model, 'dId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
