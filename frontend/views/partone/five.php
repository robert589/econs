<?php
    use kartik\widgets\ActiveForm;
    use yii\helpers\Html;
$this->title="Survey | Five";
$this->registerJsFile(Yii::$app->request->baseUrl . '/frontend/web/js/jquery.js');

?>

<div class="col-md-9" id="containerer">
<div align="center">

<label>Binary choice lottery (loosely based on Holt and Laury (2002))  </label>

<p style='color:red'>
Please choose the choice that you prefer.
For example, in question #1, if you prefer to receive 365 Baht with certainty over having 50% chance of receiving 500 Baht and 50% chance of receiving nothing, please choose A.
If you prefer to have a 50% chance of receiving 500 Baht and 50% chance of receiving nothing over receiving 365 Baht with certainty, please choose B.
</p>
</div>

<?php $form =ActiveForm::begin(['id' => 'partone-five-form']) ?>

<div class="col-md-12">

    <div class="row">
        <hr>
        <div class="col-md-1">
           <label>1. </label>
        </div>
        <div class="col-md-4">
           <b> A. 100% - 365 Baht </b>
            <br><br>
            <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
            <br><br>
            <?= $form->field($model, '_365_baht')->radioButtonGroup(['A' => 'A', 'B' => 'B'])->label(false)?>

        </div>


    </div>

    <div class="row">
        <hr>
        <div class="col-md-1">
            <label>2. </label>
        </div>
        <div class="col-md-4">
            <b> A. 100% - 350 Baht </b>
            <br><br>
            <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
            <br><br>
            <?= $form->field($model, '_350_baht')->radioButtonGroup(['A' => 'A', 'B' => 'B'])->label(false)?>

        </div>
    </div>

    <div class="row">
        <hr>
        <div class="col-md-1">
            <label>3. </label>
        </div>
        <div class="col-md-4">
            <b> A. 100% - 314 Baht </b>
            <br><br>
            <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
            <br><br>
            <?= $form->field($model, '_314_baht')->radioButtonGroup(['A' => 'A', 'B' => 'B'])->label(false)?>

        </div>


    </div>

    <div class="row">
        <hr>
        <div class="col-md-1">
            <label>4. </label>
        </div>
        <div class="col-md-4">
            <b> A. 100% - 273 Baht </b>
            <br><br>
            <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
            <br><br>
            <?= $form->field($model, '_273_baht')->radioButtonGroup(['A' => 'A', 'B' => 'B'])->label(false)?>

        </div>


    </div>

    <div class="row">
        <hr>
        <div class="col-md-1">
            <label>5. </label>
        </div>
        <div class="col-md-4">
            <b> A. 100% - 250 Baht </b>
            <br><br>

            <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
            <br><br>
            <?= $form->field($model, '_250_baht')->radioButtonGroup(['A' => 'A', 'B' => 'B'])->label(false)?>

        </div>


    </div>

    <div class="row">
        <hr>
        <div class="col-md-1">
            <label>6. </label>
        </div>
        <div class="col-md-4">
            <b> A. 100% - 221 Baht </b>
            <br><br>
            <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
            <br><br>
            <?= $form->field($model, '_221_baht')->radioButtonGroup(['A' => 'A', 'B' => 'B'])->label(false)?>

        </div>


    </div>

    <div class="row">
        <hr>
        <div class="col-md-1">
            <label>7. </label>
        </div>
        <div class="col-md-4">
            <b> A. 100% - 154 Baht </b>
            <br><br>
            <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
            <br><br>
            <?= $form->field($model, '_154_baht')->radioButtonGroup(['A' => 'A', 'B' => 'B'])->label(false)?>

        </div>


    </div>

    <div class="row">
        <hr>
        <div class="col-md-1">
            <label>8. </label>
        </div>
        <div class="col-md-4">
            <b> A. 100% - 57 Baht </b>
            <br><br>
            <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
            <br><br>
            <?= $form->field($model, '_57_baht')->radioButtonGroup(['A' => 'A', 'B' => 'B'])->label(false)?>

        </div>


    </div>

    <div class="row">
        <hr>
        <div class="col-md-1">
            <label>9. </label>
        </div>
        <div class="col-md-4">
            <b> A. 100% - 32 Baht </b>
            <br><br>
            <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
            <br><br>
            <?= $form->field($model, '_32_baht')->radioButtonGroup(['A' => 'A', 'B' => 'B'])->label(false)?>

        </div>


    </div>

    <div class="row">
        <hr>
        <div class="col-md-1">
            <label>10. </label>
        </div>
        <div class="col-md-4">
            <b> A. 100% - 5 Baht </b>
            <br><br>
            <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
            <br><br>
            <?= $form->field($model, '_5_baht')->radioButtonGroup(['A' => 'A', 'B' => 'B'])->label(false)?>

        </div>


    </div>
</div>

<div style="float:left" class="form-group">
    <?= Html::a('Previous Page',Yii::getAlias('@base-url'). '/partone/four', ['class' => 'btn btn-primary']) ?>

</div>
<div style="float:right" class="form-group">
    <?= Html::submitButton('Next Page', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end()?>
</div>
