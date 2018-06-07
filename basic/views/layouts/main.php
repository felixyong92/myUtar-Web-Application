<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'MyUTAR',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if(!Yii::$app->user->isGuest){
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label' => 'Home', 
                'url' => ['/site/index']
            ],
            [
                'label' => 'Manage Announcements',
				'visible' => Yii::$app->user->identity->dsResponsibility == 'Super Admin' || Yii::$app->user->identity->dsResponsibility != 'Feedback',
                'items' => [
                     ['label' => 'Notification', 'url' => '?r=announcement/notification', 
					 'visible' => stristr(Yii::$app->user->identity->dsResponsibility, 'Notification') || Yii::$app->user->identity->dsResponsibility == 'Super Admin'],
                     ['label' => 'Bus Service', 'url' => '?r=announcement/busservice', 
					 'visible' => stristr(Yii::$app->user->identity->dsResponsibility, 'Bus Service') || Yii::$app->user->identity->dsResponsibility == 'Super Admin'],
                     ['label' => 'Event', 'url' => '?r=announcement/event', 
					 'visible' => stristr(Yii::$app->user->identity->dsResponsibility, 'Event') || Yii::$app->user->identity->dsResponsibility == 'Super Admin'],
                     ['label' => 'Safety', 'url' => '?r=announcement/safety', 
					 'visible' => stristr(Yii::$app->user->identity->dsResponsibility, 'Safety') || Yii::$app->user->identity->dsResponsibility == 'Super Admin'],
                     ['label' => 'Healthcare', 'url' => '?r=announcement/healthcare', 
					 'visible' => stristr(Yii::$app->user->identity->dsResponsibility, 'Health Care') || Yii::$app->user->identity->dsResponsibility == 'Super Admin'],
                ],
            ],
            [
                'label' => 'Manage Feedback', 
                'url' => ['/feedback/feedback'],
				'visible' => stristr(Yii::$app->user->identity->dsResponsibility, 'Feedback') || Yii::$app->user->identity->dsResponsibility == 'Super Admin',
            ],
			[
                'label' => 'Manage Staff', 
                'url' => ['/staff/staff'],
				'visible' => Yii::$app->user->identity->dsResponsibility == 'Super Admin',
            ],
			[
                'label' => Yii::$app->user->identity->dsName,
                'items' => [
                     ['label' => 'Profile', 'url' => '?r=user/view&id='.Yii::$app->user->identity->dsId],
					 ['label' => 'Change Password', 'url' => '?r=user/changepassword&id='.Yii::$app->user->identity->dsId],
                     ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                ],
            ],
        ],
    ]);
}else{
     echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
           [ 'label' => 'Login', 
            'url' => ['/site/login'],
            ]
        ],

]);
}
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; MyUTAR <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
