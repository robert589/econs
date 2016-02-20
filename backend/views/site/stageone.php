<?php
	use yii\grid\GridView;
    use yii\helpers\Html;
    $this->title="Stage 1";
?>

<?= GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        'user_name',
        'user_friend_name',
        'remark',
        'score',
        'dice_value'

    ],
]) ?>

<?= Html::a('Generate Matrix', ['site/stageone-matrix'], ['class' => 'btn btn-primary']) ?>