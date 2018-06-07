<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\feedback\models\FeedbackResponseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Feedback Responses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-response-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Feedback Response', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'frId',
            'fResponse:ntext',
            'frDateTime',
            'fId',
            'dId',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
