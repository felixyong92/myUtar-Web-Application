<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\feedback\models\FeedbackResponse */

$this->title = 'Update Feedback Response: ';
$this->params['breadcrumbs'][] = ['label' => 'Feedback', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Feedback Details' , 'url' => ['view', 'id' => $model->fId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="feedback-response-update">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="feedback-response-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fResponse')->textarea(['rows' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
		<?= Html::a('Cancel', ['view', 'id' => $model->fId], ['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
