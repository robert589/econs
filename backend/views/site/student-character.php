<?php
	use yii\grid\GridView;
use yii\helpers\Html;
?>

<?= GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        'user_name',
        'optimistic',
        'extroverted',
        'confident',
        'outgoing',
        
    ],
]) ?>

<?= Html::a('Save to Excel', ['site/character-excel'], ['class' => 'btn btn-primary']) ?>

