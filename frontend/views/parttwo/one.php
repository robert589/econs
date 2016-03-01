<?php

use yii\bootstrap\ActiveForm;
	use yii\helpers\Html;

$this->title = "Security Question";
?>



<div class="col-md-offset-3">
	<div id="clickToBegin" class="row" style="margin:23px">
		<?= Html::Button('Click to Begin (You only have 15 seconds to answer)', ['class' => 'btn btn-primary', 'onclick' => 'beginQuestion()'] )?>
		<br> <br>
	</div>
	<div class="col-md-6" style="display:none; border:1px solid black"id="securityQuestion" >
		<?php $form =ActiveForm::begin(['id' => 'parttwo-one-form']) ?>

		<h2 align="center">	Security Question </h2>

		<div align="center">
			<label> What is your CGPA? </label>
		</div>

		<div align="center" class="row" style="margin:1px">
			Ans:    <?= $form->field($model, 'cgpa')->textInput(['id' => 'inputCGPA', 'placeholder' => 'Please Enter your CGPA'])->label(false) ?>

		</div>

		<label><?= $error ?></label>

		<div class="col-md-offset-12 col-md-12">
            	<?= Html::submitButton('Submit', [ 'class' => 'btn btn-primary center-block', 'name' => 'contact-button']) ?>
         </div>

		<?php ActiveForm::end()?>

	</div>

	<div class="col-md-6">
		<p  align="center" id="timerLabel" style="font-size:200%;margin:3px; border-style: solid;border-color: #ff0000 #0000ff;"></p>
	</div>
</div>

<?php $this->registerJsFile(\Yii::$app->request->baseUrl .  '/frontend/web/js/parttwo-one.js');