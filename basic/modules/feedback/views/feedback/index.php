<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\UserNew;
use app\modules\feedback\models\Feedback;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\feedback\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Feedback';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?php $type_array = [
             0 => 'Academic Matters - unit registration, assessment, timetable, etc',
        1 => 'Admission, Enrolment and Credit Transfer Matters',
        2 => 'Alumni and Graduates Matters - convocation, job zone, etc.',
        3 => 'Examinations - procedures, timetable, venue, results, etc',
        4 => 'Fees and Refunds',
        5 => 'General Cleanliness and Upkeep',
        6 => 'General Facilities - air-con, building maintenance, etc',
        7 => 'IT Hardware - Computer labs, printer, network, etc',
        8 => 'IT Software - Student portal, systems, etc',
        9 => 'Labs, Teaching Facilites at Faculty/Centre',
        10 => 'Library Facilities and Services',
        11 => 'Loans and Scholarships - PTPTN, other loans, etc',
        12 => 'Security and Car Parking - Safety, guards, parking, etc',
        13 => 'Student Services- bus schedule, car stickers, sport facilities, etc.',
        14 => 'UTAR Bus Service',
        15 => 'UTAR Policy Matters, Rules and Regulations',
    ];
   ?>
     <?php $status_array = [
        0 => 'New',
        1 => 'Processing',
        2 => 'Closed(Pending)',
        3 => 'Reopened',
        4 => 'Closed',
    ];
   ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['label' => 'Type',
            'value' => function($model){
                return $model->typeText;},
            'attribute' => 'fType',
            'filter' =>  $type_array,
            ],

             ['label' => 'Name',
            'value' => function($model){
                return $model->user->uName;},
            'attribute' => 'uId',  
            ],
            ['label' => 'Email',
            'value' => function($model){
                return $model->user->uEmail;},
            'attribute' => 'fContent',   
            ],
            ['label' => 'Phone',
            'value' => function($model){
                return $model->user->uPhone;},
            'attribute' => 'fAttachment',   
            ],
            ['label' => 'Status',
            'value' => function($model){
                return $model->statusText;},
            'attribute' => 'fStatus',
            'filter' =>  $status_array,
            ],
			[
                'attribute'=>'dId',
                'filter'=> Yii::$app->user->identity->dsResponsibility == 'Super Admin' ? ArrayHelper::map(Feedback::find()->all(), 'dId', 'dId') : ''
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'delete' =>false,
                ]
            ],

        ],
    ]); ?>
</div>
