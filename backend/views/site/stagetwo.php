<?php
	use yii\grid\GridView;
    use yii\helpers\Html;

$this->title  = "Stage 2";
?>

<?= GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        'user_name',
        'user_friend_name',
        'answer',
        'remark',
    ],
]) ?>

<div align="right">
    <div style="border: 1px solid black; padding:10px; width:500px" align="left">
        Legends: <br>
        1. With observability, No negative externalities, and Non Anonymous
        <br>
        2. With observability, No negative externalities, and Anonymous
        <br>
        3. With observability, Negative externalities, and Anonymous
        <br>
        4. With No observability, No negative externalities, and Anonymous
        <br>
    </div>

</div>

<br>
<?= Html::a('Save to Excel', ['site/stage2-excel'], ['class' => 'btn btn-primary']) ?>