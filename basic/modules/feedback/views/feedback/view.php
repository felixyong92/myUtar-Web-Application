<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\feedback\models\Feedback */

$this->title = 'Feedback Details';
$this->params['breadcrumbs'][] = ['label' => 'Feedback', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="feedback-view">

    <p>
        <?= Html::a('Update response', ['update', 'id' => $model->fId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Redirect to other department', ['changedept', 'id' => $model->fId], [
            'class' => 'btn btn-danger',
            'data' => [
                
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php 
        $x=1;
        $currentAttachmentNum = 'attachment'.$x;
        $htmlAttachment = '';
        while($x<=3 && $model->$currentAttachmentNum){
            $htmlAttachment.='<a href="uploads/feedback_Images/'.$model->$currentAttachmentNum.'" download>'.$x.'. '.$model->$currentAttachmentNum.'</a><br/>';
            $x++;
            $currentAttachmentNum = 'attachment'.$x;

    }?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fId',
             ['label' => 'Type',
             'value'=>$model->typeText,
             ],
            'fDateTime',
            'fContent:ntext',
             ['label' => 'Attachments',
             'format'=>'raw',
             'value'=>$htmlAttachment,
             ],
            ['label' => 'Name',
             'value'=>$model->user->uName,
             ],
              ['label' => 'Email',
             'value'=>$model->user->uEmail,
             ],
              ['label' => 'Phone Number',
             'value'=>$model->user->uPhone,
             ],
              ['label' => 'Status',
             'value'=>$model->statusText,
             ],
        ],
    ]) ?>

</div>

<div class="feedbackResponse-view">
<?php if($responses!=null){ ?>
    
    <?php echo '<label class="control-label">Response history</label>';?>
    <?php echo '<table class="table table-bordered">';?>
    <?php foreach ($responses as $response) { ?>
        <?php echo '<tr>';?>
        <?php echo '<td>'.$response->frDateTime.'</td>';?>
        <?php echo '<td style="white-space: pre-line;">'.$response->fResponse.'</td>';?>
        <?php echo '<td>'.$response->dId.'</td>';?>

        <?php echo '<td>'?>
        <?= Html::a('<img src="edit.png" height="15px" style="padding-right: 5px;">', ['updateresponse', 'frid' => $response->frId], [
        ]) ?>
        <?= Html::a('<img src="delete.png" height="15px" style="padding-left: 5px;">    ', ['deleteresponse', 'frid' => $response->frId, 'id' => $model->fId], [
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php echo '</td>';?>

        <?php echo '</tr>';?>
    <?php }?>

<?php echo '</table>';?>
<?php } ?>

</div>
