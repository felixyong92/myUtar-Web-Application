<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\feedback\models\Feedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fType')->dropDownList(($model->typeOptions),
        ['prompt' => "Please choose the event's type"])->label('Type') ?>

    <?= $form->field($model, 'fContent')->textarea(['rows' => 6]) ?>

    <?php echo '<label class="control-label">Upload Attachment</label>';?>
    <?php  echo $form->field($model, 'attachment1')->widget(FileInput::classname(), [
        'pluginOptions' => [
            'showPreview' =>  $model->attachment1 ?true:false,
            'showRemove' => true,
            'showUpload' => false,
            'browseLabel' =>  'Select Attachment',
            'initialPreview' => [
                         $model->attachment1 ? '<a href="uploads/attachments/'.$model->attachment1.'" download>'.$model->attachment1.'</a>' : null,
            ],
        ],  
         'options' => ['accept' => 'docx/doc/pdf/*',]
       
    ])->label(false); ?>

    <?php  echo $form->field($model, 'attachment2')->widget(FileInput::classname(), [
        'pluginOptions' => [
            'showPreview' => $model->attachment2 ?true:false,
            'showRemove' => true,
            'showUpload' => false,
            'browseLabel' =>  'Select Attachment',
            'initialPreview' => [
                        $model->attachment2 ? '<a href="uploads/attachments/'.$model->attachment2.'" download>'.$model->attachment2.'</a>' : null,
            ],
            

        ],  
         'options' => ['accept' => 'docx/doc/pdf/*',]
       
    ])->label(false); ?>
    <?php  echo $form->field($model, 'attachment3')->widget(FileInput::classname(), [
            'pluginOptions' => [
            'showPreview' => $model->attachment3 ?true:false,
            'showRemove' => true,
            'showUpload' => false,
            'browseLabel' =>  'Select Attachment',
            'initialPreview' => [
                        $model->attachment3 ? '<a href="uploads/attachments/'.$model->attachment3.'" download>'.$model->attachment3.'</a>' : null,
                    ],
        ],  
         'options' => ['accept' => 'docx/doc/pdf/*',]
       
    ])->label(false); ?>

  <br/>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
