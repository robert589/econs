<?php
	use kartik\widgets\RangeInput;
	use yii\bootstrap\ActiveForm;
	use yii\helpers\Html;

	$this->title = 'Survey | Third Part';

?>

<div class="col-md-12" id="containerer">

	<div align="center" style='color:red'>
		<h2> Please select a bubble closet to the word which best describe your personality </h2>

	</div>

<?php $form =ActiveForm::begin(['id' => 'partone-three-form']) ?>
	<hr>
	<div class="row">
		<div class="col-md-2">
			<label> Optimistic </label>
		</div>
		<div class="col-md-5">
   			 <?= $form->field($model, 'optimistic')->widget(RangeInput::classname(), [
    			'options' => ['placeholder' => 'Rate (1 - 5)...'],
    			'html5Options' => ['min' => 1, 'max' => 5],
    			'addon' => ['append' => ['content' => '<i class="glyphicon glyphicon-star"></i>']]
			])->label(false); ?>
		</div>
		<div class="col-md-2">
			<label> Realistic </label>
		</div>
	</div>

	<hr>

	<div class="row">
		<div class="col-md-2">
			<label> Extroverted </label>
		</div>
		<div class="col-md-5">
   			 <?= $form->field($model, 'extroverted')->widget(RangeInput::classname(), [
    			'options' => ['placeholder' => 'Rate (1 - 5)...'],
    			'html5Options' => ['min' => 1, 'max' => 5],
    			'addon' => ['append' => ['content' => '<i class="glyphicon glyphicon-star"></i>']]
			])->label(false); ?>
		</div>
		<div class="col-md-2">
			<label> Introverted </label>
		</div>
	</div>

	<hr>
	<div class="row">
		<div class="col-md-2">
			<label> Confident </label>
		</div>
		<div class="col-md-5">
   			 <?= $form->field($model, 'confident')->widget(RangeInput::classname(), [
    			'options' => ['placeholder' => 'Rate (1 - 5)...'],
    			'html5Options' => ['min' => 1, 'max' => 5],
    			'addon' => ['append' => ['content' => '<i class="glyphicon glyphicon-star"></i>']]
			])->label(false); ?>
		</div>
		<div class="col-md-2">
			<label> Self-Conscious </label>
		</div>
	</div>
	<hr>

	<div class="row">
		<div class="col-md-2">
			<label> Outgoing </label>
		</div>
		<div class="col-md-5">
   			 <?= $form->field($model, 'outgoing')->widget(RangeInput::classname(), [
    			'options' => ['placeholder' => 'Rate (1 - 5)...'],
    			'html5Options' => ['min' => 1, 'max' => 5],
    			'addon' => ['append' => ['content' => '<i class="glyphicon glyphicon-star"></i>']]
			])->label(false); ?>
		</div>
		<div class="col-md-2">
			<label> Shy </label>
		</div>
	</div>

	<div style="float:left" class="form-group">
		<?= Html::a('Previous Page',Yii::getAlias('@base-url'). '/partone/two', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>

	</div>
	<div style="float:right" class="form-group">
      	<?= Html::submitButton('Next Page', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>


<?php ActiveForm::end()?>
</div>

