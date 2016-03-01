<?php
	use kartik\widgets\ActiveForm;
	use yii\helpers\Html;
	use kartik\widgets\RangeInput;
	use yii\bootstrap\Modal;
	use kartik\popover\PopoverX;
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/jquery.js');

$this->title = "Stage 1";
$roll_dice_instruction ="Click \"roll dice\" button!";

if(isset($model->name)){
    $range_value_instruction = "Now choose the value that you want to tell $model->name based on the value that you get ";
}
?>


<?php
	Modal::begin([
		'id' => 'stage1inst',
		'size' => 'modal-lgs',
		'clientOptions' => ['backdrop' => 'static', 'keyboard' => false, 'overflow' => 'scroll']
	]);

	echo $this->render('stage1inst');

	Modal::end();
?>


<div class="row">
	<div class="form-group">

		<?= Html::beginForm(["parttwo/stage1?dice=true"  ], 'post', ['id' => 'part2-stage1-dicevalue', 'class' => 'form-inline']); ?>
			<?php if($diceValue == 0){ ?>
				<div align="center" class="dice"><?= Html::activeLabel($model, 'user_dice_roll', ['label' =>false, 'id'=> 'die1'])?></div>


				<?= Html::hiddenInput("dicevalue", null, ['id' => "dice_value_hidden"])?>

				<br>

                <?= Html::button('Roll Dice', ['id' => 'btnRollDice', 'onclick' => 'rollDice()', 'class' => 'btn btn-info'
										,'title'=>$roll_dice_instruction, 'data-toggle'=>"tooltip"]) ?>


				<?php }else{ ?>
				<div  align="center" class="dice">
					<?= Html::label('' . $diceValue, null, ['label' =>false, 'id'=> 'die1', 'value' => $diceValue])?>
				</div>


				<?= Html::hiddenInput("dicevalue", null, ['id' => "dice_value_hidden"])?>

				<br>


			<?php } ?>

			<div align="right">
				<?= Html::button('View Instruction', ['onclick' => 'beginInstructionModal()', 'class' => 'btn btn-primary', 'id' => 'stage1instbutton']) ?>

			</div>
		<?= Html::endForm()?>

	</div>
	<div style="float:right">
        <?php if($diceValue == 0){ ?>
			<label id="labeledValue"> </label>

			<label id="notExist"> </label>
        <?php }else{ ?>
            <label id="labeledValue"> Your payoff:  <?= 2 * $diceValue + 10 ?> </label>

        <?php } ?>

    </div>
</div>

<?php $form =ActiveForm::begin(['id' => 'part2-stage1-form']) ?>
<hr>
<div class="row">
		<div class="col-md-3">
			Message:
		</div>
		<div class="col-md-6">
		</div>

		<div class="col-md-offset-1 col-md-2">
			Value
		</div>

</div>

<hr>

<div class="row">
        <!-- Name -->
		<div class="col-md-3">

            <?php if($model->name != null){ ?>
                <label> <?= $model->name	?></label>
            <?php }else{ ?>
				<label> <i>[Not Applicable]</i></label>

            <?php } ?>


        </div>

        <!--Score given to friend-->
		<div class="col-md-6">

            <?php if($diceValue != 0){ ?>

                <?= $form->field($model, 'score')->widget(RangeInput::classname(), [
					'options' => ['placeholder' => 'Rate (1 - 6)...'],
					'html5Options' => ['min' => 1, 'max' => 6],
					'addon' => ['append' => ['content' => '<i class="glyphicon glyphicon-star"></i>']]
	            ]); ?>

				<a class="btn btn-danger" title="<?= $range_value_instruction ?>" id="stage1Hint" data-toggle="tooltip">
					Hint
				</a>

			<?php } else{ ?>

				<?= $form->field($model, 'score')->widget(RangeInput::classname(), [
					'options' => ['placeholder' => 'Rate (1 - 6)...', 'disabled' => true],
					'html5Options' => ['min' => 1, 'max' => 6],
					'addon' => ['append' => ['content' => '<i class="glyphicon glyphicon-star"></i>']]
				]); ?>

            <?php } ?>
		</div>
</div>
<hr>

<!-- Next -->
<div style="float:right" class="form-group">
       	<?= Html::submitButton('Next', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
</div>

<?php ActiveForm::end()?>

<?php
$this->registerJsFile(Yii::$app->request->baseUrl . '/frontend/web/js/parttwo-stage1.js');
?>