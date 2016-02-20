<?php
    use kartik\widgets\Select2;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    $this->title = "Choose Stage";
?>


<div class="row">
    <div class="col-md-6">
        <label> Current Stage: <?=  $all_stages[$current_stage] ?> </label>

        <?= Html::beginForm() ?>
            <?=
            Select2::widget([
                'name' => 'current_stage',
                'data' => $all_stages,
                'options' => ['placeholder' => 'Change stage ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])

            ?>

            <br><br>

            <?= Html::submitButton('Change', ['class' => 'btn btn-lg btn-primary']) ?>

        <?= Html::endForm() ?>
    </div>


    <?= $this->render('_index_register_user', ['register_form' => $register_form]) ?>
</div>

<br>
<hr>
<div class="row">
    <div class="col-md-6">
        <?= Html::a('Choose New Admin', ['admin/'],  ['class' => 'btn btn-primary']) ?>
    </div>
</div>
