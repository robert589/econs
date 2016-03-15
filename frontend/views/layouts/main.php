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
<?php $this->beginPage();
?>
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
        'brandLabel' => 'Economic Survey',
        'brandUrl' => Yii::$app->request->baseUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems = [
        ['label' => 'Current Stage', 'url' =>  Yii::$app->request->baseUrl . '/partone/go-to-survey'],
        ['label' => 'Report', 'url' =>  Yii::$app->request->baseUrl . '/report'],

    ];


    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => Yii::$app->request->baseUrl . '/site/login'];
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

