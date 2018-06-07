<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Department;
/* @var $this yii\web\View */
/* @var $model app\modules\feedback\models\Feedback */

$this->title = 'Redirect to other department: ';
$this->params['breadcrumbs'][] = ['label' => 'Feedback', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Feedback Details', 'url' => ['view', 'id' => $model->fId]];
$this->params['breadcrumbs'][] = 'Redirect to other department';
?>
<div class="feedback-view">

    <h1><?= Html::encode($this->title) ?></h1>
	
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dId')->dropDownList(
        ArrayHelper::map(Department::find()->innerJoinWith('departmentStaff')->where(['LIKE', 'department_staff.dsResponsibility', 'Feedback'])->all(), 'dId', 'dName'),
        ['prompt' => '-- Please choose a department --']
    )->label('Department') ?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
		<?= Html::a('Cancel', ['view', 'id' => $model->fId], ['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>