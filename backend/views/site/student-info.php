<?php
	use yii\grid\GridView;
    use yii\helpers\Html;
?>

<?= GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        'id',
        'gender',
        'course',
        'year_of_birth',
        'year_of_study',
        'user_prior_school',
        'user_height',
        'user_weight',
        'num_of_sibling',
        'your_cgpa',
        'user_money_received',
        'work_part_time',
        'hour_week',
        'part_time_rate',
        'volunteer_activity',
        'hobbies',
        'other_hobbies',
        'user_cca',
        'user_first_language',
        'user_hall',
        'hall_number',
        'trust_choice'

        // ...
    ],
]) ?>

<?= Html::a('Save to Excel', ['site/info-excel'], ['class' => 'btn btn-primary']) ?>
