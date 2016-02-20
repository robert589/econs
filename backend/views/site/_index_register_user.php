
<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
    use yii\widgets\Pjax;
{
    
    }
?>
<?php Pjax::begin([
    'id' => 'registerUser',
    'timeout' => false,
    'enablePushState' => false,
    'clientOptions'=>[
        'container' => '#register_user',
    ]
]);?>

<div class="col-md-6">
    <label>Create New Testers</label>

    <?php $form = ActiveForm::begin(['action' => ['site/register-new-user'], 'method' => 'post', 'options' => ['data-pjax' => '#register_user']]) ?>
    <?= $form->field($register_form, 'name') ?>

    <?= $form->field($register_form, 'password') ?>


    <?= $form->field($register_form, 'email') ?>


    <?= $form->field($register_form, 'username') ?>

    <?= Html::submitButton('Create New User', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end() ?>
</div>


<?php Pjax::end();?>


<?php


?>