<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\announcement\models\BusService;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\announcement\models\BusServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bus Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bus-service-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Bus Service', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
            'publishDate',
            'expiryDate',
             ['label' => 'Status',
            'value' => function($model){
                return $model->expiredText;},
            'attribute' => 'busStatus',
            'filter' =>  $expired_array,
            ],
            [
                'attribute'=>'dId',
                'filter'=> Yii::$app->user->identity->dsResponsibility == 'Super Admin' ? ArrayHelper::map(BusService::find()->all(), 'dId', 'dId') : ''
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
