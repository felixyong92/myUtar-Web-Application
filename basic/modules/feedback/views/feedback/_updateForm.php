<?php 

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\modules\feedback\models\Feedback */
?>
<div class="feedback-view">
<?php if($responses!=null){ ?>
	
	<?php echo '<label class="control-label">Response history</label>';?>
	<?php echo '<table class="table table-bordered">';?>
	<?php foreach ($responses as $response) { ?>
		<?php echo '<tr>';?>
		<?php echo '<td>'.$response->frDateTime.'</td>';?>
		<?php echo '<td style="white-space: pre-line;">'.$response->fResponse.'</td>';?>
		<?php echo '<td>'.$response->dId.'</td>';?>
		<?php echo '</tr>';?>
	<?php }?>

<?php echo '</table>';?>
<?php } ?>

</div>

<div class="feedback-response-form">
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'fResponse')->textarea(['rows' => 10]) ?>

<?= $form->field($feedback, 'fStatus')->dropDownList(($feedback->statusAvailable),
        ['prompt' => "-- Please choose status --"])->label('Status') ?>

<div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
		<?= Html::a('Cancel', ['view', 'id' => $feedback->fId], ['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>