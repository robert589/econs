<?php

/* @var $this \yii\web\View */
/* @var $content string */
use mdm\admin\components\MenuHelper;

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
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
        'brandLabel' => 'Admin side of economy survey',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [

        ['label' => '<span class="glyphicon glyphicon-envelope"></span> Email',
         'url' => ['/site/email']
        ],
        ['label' => '<span class="glyphicon glyphicon-home"></span> Home',
         'items' => [
                        ['label' => '<br><span class="glyphicon glyphicon-stats"></span> Student Info ', 
                                    'url' => ['/site/student-info']
                        ],
                        ['label' => '<br> <span class="glyphicon glyphicon-eye-open"></span> Student Character ', 
                                    'url' => ['/site/student-character']
                        ],
                        ['label' => '<br><span class="glyphicon glyphicon-heart"></span> Student Happiness ', 
                                    'url' => ['/site/student-happiness']
                        ],
                        ['label' => '<br><span class="glyphicon glyphicon-user"></span> Student Relation', 
                                    'url' => ['/site/student-relation']
                        ],
                    ],
        ],
        ['label' => '<span class="glyphicon glyphicon-king"></span> Game',
         'items' => [
                        ['label' => '<br>1. Stage One ', 
                                    'url' => ['/site/stageone']
                        ],
                        ['label' => '<br>2. Stage Two ', 
                                    'url' => ['/site/stagetwo']
                        ],
                      
                    ],
        ]
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login'] ];
    } else {
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels'=> false,
    ]);
    NavBar::end();

    ?>  

  
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
    <?php $this->registerJsFile(Yii::$app->request->baseUrl. '/../backend/web/js/script.js'); ?>

</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Economic Survey <?= date('Y') ?></p>

        <p class="pull-right"><?= "All Copyright reserved" ?></p>
    </div>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
