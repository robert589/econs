<?php
use kartik\widgets\RangeInput;
use yii\bootstrap\ActiveForm;
	use yii\helpers\Html;

$this->title = 'Survey | Fourth Part';
$this->registerJsFile(Yii::$app->request->baseUrl . '/frontend/web/js/jquery.js');

?>
<div class="col-md-12" id="containerer">

<h3 style='color:red' align="center"> For each of the following statements and/or questions, please circle the point on the scale that you feel is most appropriate in describing you. </h3>


<?php $form =ActiveForm::begin(['id' => 'partone-four-form']) ?>

<hr>
<div class="form-group">
	<label>In general, I consider myself: </label>
	<div class="row">
		<div class="col-md-3">
			<label> Not a very happy person </label>
		</div>
		<div class="col-md-6">
   			<?= $form->field($model, 'happiness')->widget(RangeInput::classname(), [
    			'options' => ['placeholder' => 'Rate (1 - 7)...'],
    			'html5Options' => ['min' => 1, 'max' => 7],
    			'width' => '75%',
    			'addon' => ['append' => ['content' => '<i class="glyphicon glyphicon-star"></i>']]
			])->label(false); ?>
		</div>
		<div class="col-md-2">
			<label> A very happy person </label>
		</div>
	</div>
</div>

<hr>
<div class="form-group">
	<label>Compared with most of my peers, I consider myself: </label>
	<div class="row">
		<div class="col-md-3">
			<label> Less happy </label>
		</div>
		<div class="col-md-6">
   			<?= $form->field($model, 'comhappiness')->widget(RangeInput::classname(), [
    			'options' => ['placeholder' => 'Rate (1 - 7)...'],
    			'html5Options' => ['min' => 1, 'max' => 7],
    			'width' => '75%',
    			'addon' => ['append' => ['content' => '<i class="glyphicon glyphicon-star"></i>']]
			])->label(false); ?>
		</div>
		<div class="col-md-2">
			<label> More happy </label>
		</div>
	</div>
</div>

<hr>
<div class="form-group">
	<label>Some people are generally very happy.  They enjoy life regardless of what is going on, getting the most out of everything.  To what extent does this characterization describe you? </label>
	<div class="row">
		<div class="col-md-3">
			<label> Not at all </label>
		</div>
		<div class="col-md-6">
   			<?= $form->field($model, 'careless')->widget(RangeInput::classname(), [
    			'options' => ['placeholder' => 'Rate (1 - 7)...'],
    			'html5Options' => ['min' => 1, 'max' => 7],
    			'width' => '75%',
    			'addon' => ['append' => ['content' => '<i class="glyphicon glyphicon-star"></i>']]
			])->label(false); ?>
		</div>
		<div class="col-md-2">
			<label> A great deal </label>
		</div>
	</div>
</div>

<hr>
<div class="form-group">
	<label>Some people are generally  not very happy.  Although they are not depressed, they never  seem  as  happy  as  they  might  be.   To  what  extent  does this  characterization describe you? </label>
	<div class="row">
		<div class="col-md-3">
			<label> Not at all</label>
		</div>
		<div class="col-md-6">
   			<?= $form->field($model, 'secretive')->widget(RangeInput::classname(), [
    			'options' => ['placeholder' => 'Rate (1 - 7)...'],
    			'html5Options' => ['min' => 1, 'max' => 7],
    			'width' => '75%',
    			'addon' => ['append' => ['content' => '<i class="glyphicon glyphicon-star"></i>']]
			])->label(false); ?>
		</div>
		<div class="col-md-2">
			<label> A great deal </label>
		</div>
	</div>
</div>

<hr>
<div style="float:left" class="form-group">
	<?= Html::a('Previous Page',Yii::getAlias('@base-url'). '/partone/three', ['class' => 'btn btn-primary']) ?>

</div>
<div style="float:right" class="form-group">
	<?= Html::submitButton('Next Page', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end()?>
</div>
