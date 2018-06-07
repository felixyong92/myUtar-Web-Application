<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\announcement\models\BusService */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Bus Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bus-service-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php 
     $htmlImg = '';
     if($images){
         foreach ($images as $image) {
             $htmlImg.='<img src="uploads/images/'.$image.'" height="250px" alt="">';
         }
     }
      
    ?>
     <?php 
    $htmlAttachment = '';
    if($attachments){
    
        foreach ($attachments as $attachment) {
            $htmlAttachment.='<a href="uploads/attachments/'.$attachment.'" download>'.$attachment.'</a><br/>';
        }
    }
  
    ?>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'publishDate',
             ['label' => 'Images',
             'format'=>'raw',
             'value'=>$htmlImg,
             ],
             ['label' => 'Attachments',
             'format'=>'raw',
             'value'=>$htmlAttachment,
             ],
             ['label' => 'Link',
             'format'=>'raw',
             'value'=>'<a href="'.$model->link.'" target="_blank">'.$model->link.'</a>',
             ],
            'expiryDate',
            ['label' => 'Department',
             'value'=> $model->dId,
             ],
            ['label' => 'Status',
            'value' =>$model->expiredText,
            ],  
        ],
    ]) ?>

</div>
