<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\announcement\models\Event;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\announcement\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $type_array = [
        'Competition' => 'Competition',
        'Talk' => 'Talk',
        'Seminar/Course/Workshop' => 'Seminar/Course/Workshop',
        'Campaign/Festival' => 'Campaign/Festival',
        'Others' => 'Others',
    ];
   ?>

   <?php $expired_array = [
        'Upcoming' => 'Upcoming',
        'Today' => 'Today',
        'Archived' => 'Archived',
    ];
   ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
             ['label' => 'Type',
            'value' => function($model){
                return $model->type;},
            'attribute' => 'type',
            'filter' =>  $type_array,
            ],
            'publishDate',
            'expiryDate',
             ['label' => 'Status',
            'value' => function($model){
                return $model->expiredText;},
            'attribute' => 'status',
            'filter' =>  $expired_array,
            ],
            [
                'attribute'=>'dId',
                'filter'=> Yii::$app->user->identity->dsResponsibility == 'Super Admin' ? ArrayHelper::map(Event::find()->all(), 'dId', 'dId') : ''
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
