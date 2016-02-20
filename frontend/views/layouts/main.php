<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use kartik\widgets\SideNav;
use yii\helpers\Url;

AppAsset::register($this);

$type = "default";
$item = "home";
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
        'brandLabel' => 'Economy Survey',
        'brandUrl' => Yii::getAlias('@base-url'),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems = [
        ['label' => 'Current Stage', 'url' =>  Yii::$app->homeUrl . '../../partone/go-to-survey'],
        ['label' => 'Report', 'url' =>  Yii::$app->homeUrl . '../../report'],

    ];

    $menuItems[] = ['label' => 'All Survey Parts',
                    'items' => [
                         [
                             'label' => 'Personal Information',
                             'url' => Yii::getAlias('@base-url') . '/partone/one'
                         ],
                        [
                            'label' => 'Friendship Survey',
                            'url' => Yii::getAlias('@base-url') . '/partone/two'
                        ],
                        [
                            'label' =>'Personality',
                            'url' => Yii::getAlias('@base-url') . '/partone/three'
                        ],
                        [
                            'label' =>'Lifestyle',
                            'url' => Yii::getAlias('@base-url') . '/partone/four'
                        ],
                        [
                            'label' =>'Holt and Laury Survey',
                            'url' => Yii::getAlias('@base-url') . '/partone/five'
                        ],
                        '<li class="divider"></li>',

                        [
                            'label' =>'Game 1 Play',
                            'url' => Yii::getAlias('@base-url') . '/parttwo/stage1'
                        ],
                        [
                            'label' =>'Game 2 Play',
                            'url' => Yii::getAlias('@base-url') . '/parttwo/stage2'
                        ],
                    ]
    ];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => Yii::getAlias('@base-url') . '/site/login'];
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
</div>

<footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php
    $this->endBody();
?>
</body>
</html>
<?php
$js = <<< 'SCRIPT'
        /* To initialize BS3 tooltips set this below */
        $(function () {
            $("#btnRollDice ").tooltip('show');
            $("#stage1Hint").tooltip('show');

            $("#stage2Hint").tooltip('show');
        });;

SCRIPT;
// Register tooltip/popover initialization javascript
$this->registerJs($js);

    $this->endPage();

?>

