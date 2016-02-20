<?php
	use yii\grid\GridView;
    use yii\helpers\Html;

?>

<?= GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        'user_name',
        'happiness',
        'comhappiness',
        'careless',
        'secretive'
    ],
]) ?>

<?= Html::a('Save to Excel', ['site/happiness-excel'], ['class' => 'btn btn-primary']) ?>