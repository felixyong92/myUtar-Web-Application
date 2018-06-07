<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\feedback\models\FeedbackSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fId') ?>

    <?= $form->field($model, 'fType') ?>

    <?= $form->field($model, 'fDateTime') ?>

    <?= $form->field($model, 'fContent') ?>

    <?= $form->field($model, 'fAttachment') ?>

    <?php // echo $form->field($model, 'uId') ?>

    <?php // echo $form->field($model, 'dId') ?>

    <?php // echo $form->field($model, 'fStatus') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
