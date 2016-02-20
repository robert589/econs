<?php
	use yii\grid\GridView;
    use yii\helpers\Html;
?>

<?= GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        'user_name',
        'user_friend_name',
        'closeness',
        'known_for'
    ],
]) ?>

<?= Html::a('Generate Matrix', ['site/student-relation-matrix'], ['class' => 'btn btn-primary']) ?>