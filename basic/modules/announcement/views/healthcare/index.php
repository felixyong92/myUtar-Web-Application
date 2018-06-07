<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\announcement\models\Healthcare;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\announcement\models\HealthcareSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Healthcares';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="healthcare-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Healthcare', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php $status_array = [
        0 => 'Active',
        1 => 'Archived'
    ];
   ?>
   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'publishDate',
            ['label' => 'Status',
            'value' => function($model){
                return $model->statusText;},
            'attribute' => 'status',
            'filter' =>  $status_array,
            ],
            [
                'attribute'=>'dId',
                'filter'=> Yii::$app->user->identity->dsResponsibility == 'Super Admin' ? ArrayHelper::map(Healthcare::find()->all(), 'dId', 'dId') : ''
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
