<?php
	use yii\helpers\Html;
	use yii\bootstrap\Modal;
	use kartik\widgets\Select2;

	$this->title = "Survey | Stage 2";


	$this->registerJsFile(Yii::$app->request->baseUrl.'/js/jquery.js');

	$believe_instruction = "This person tells you that the number he got after he rolled was $model->personscore, Do you believe in him?";
?>

<?php
    Modal::begin([
        'id' => 'stage2inst',
        'size' => 'modal-lg',
		'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]
	]);

        echo $this->render('stage2inst');

    Modal::end();
?>


<div align="right">
	<?= Html::button('View Instruction', ['onclick' => 'beginInstructionModal()', 'class' => 'btn btn-primary', 'id' => 'stage2instbutton']) ?>
</div>

<?= Html::beginForm(['parttwo/stage2'], 'post') ?>

	<!-- Gender-->
	<div class="col-md-6 col-md-offset-3">
		<label align="center">From  <?= $model->personname ?>: , The number i was rolled is  <?=  $model->personscore ?> </label>

		<br>
		<br>

		<label align="center">Do you believe this message?</label>

		<div class="row">
			<div class="col-md-12">
				<div class="col-md-8">
					<?= Select2::widget([
						'name' => 'answer',
						'data' => ['0' => 'No', '1' => 'Yes'],
						'options' => ['placeholder' => 'Select your Choice ...'],
						'pluginOptions' => [
							'allowClear' => true
						],
					]); ?>
				</div>

				<div class="col-md-4">
					<a class="btn btn-danger" title="<?= $believe_instruction ?>" id="stage2Hint" data-toggle="tooltip">
						Hint
					</a>

				</div>



			</div>

		</div>


		<br>

		<div align="center">
			<?= Html::button('Submit', ['class' => 'btn btn-primary']) ?>
		</div>

	</div>





<?= Html::endForm() ?>

<?php	$this->registerJsFile(Yii::$app->request->baseUrl.'/js/parttwo-stage2.js'); ?>
