<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentStaff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-staff-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dsId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dsName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dsEmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dsPassword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dId')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
