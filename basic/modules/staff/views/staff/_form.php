<?php

use app\models\Department;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\staff\models\staff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dsId')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'dsName')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'dsEmail')->input('email') ?>
	<?= $form->field($model, 'dsResponsibility')->checkboxList(
			['Bus Service' => 'Manage Bus Service', 'Notification' => 'Manage Notification Announcement', 'Safety' => 'Manage Safety Announcement', 'Event' => 'Manage Event Announcement', 'Health Care' => 'Manage Health Care Announcement', 'Feedback' => 'Manage Feedback']
   );
	?>
	
	<?= $form->field($model, 'dId')->dropDownList(
			ArrayHelper::map(Department::find()->orderBy('dName')->all(),'dId','dName'),
			['prompt'=>'-- Please choose a department --']
			); ?>
			
	<?= $form->field($model, 'dsPassword')->passwordInput(['maxlength' => true]) ?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Register' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?= Html::a('Cancel', ['/staff/staff'], ['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
