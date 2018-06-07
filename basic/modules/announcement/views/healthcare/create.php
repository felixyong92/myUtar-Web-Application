<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\announcement\models\Healthcare */

$this->title = 'Create Healthcare';
$this->params['breadcrumbs'][] = ['label' => 'Healthcares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="healthcare-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
