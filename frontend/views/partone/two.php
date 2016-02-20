	<?php
		use kartik\widgets\RangeInput;
		use yii\app\clientScript;
		use yii\bootstrap\ActiveForm;
		use yii\helpers\Html;
		use yii\helpers\Url;
		use yii\helpers\ArrayHelper;
		use yii\widgets\Pjax;
		use kartik\widgets\Select2;

		use frontend\models\relation;
		use common\models\User;

		$this->title = 'Survey | Second Part';

		$this->registerJsFile('/econs/frontend/web/js/jquery.js');

		function addRelationForm($form, $item, $i, $size, $data){

			if($i <= 4 ){
				return '<div class="col-md-12" id=\'r_'.($i).'\'>
							<div class="row">

								<label> Friend ' . ($i + 1) . '</label>

								</div><div class="form-group col-md-12">'.	
									$form->field($item, "user_friend_id_$i")->widget(Select2::classname(), [
					    													'data' => $data,
					    													'id' => "relation-$i",
					    													'options' => [
					       														'placeholder'=>'Select...',
					        												]
					        											])->label(false).		   
						'<label> Closeness to you </label>
			
						<div class="form-inline">	' .

						$form->field($item, "closeness_$i")->widget(RangeInput::classname(), [
		    				'options' => ['placeholder' => 'Rate (1 - 5)...'],
		    				'html5Options' => [
		    					'min' => 1, 'max' => 5,
		    					'width' => '75%',
		    					'addon' => ['append' => ['content' => '<i class=
		    					"glyphicon glyphicon-star"></i>']]
							]])->label(false).
			    		
			    		'</div> '.
					    				    
					    '<div class="form-inline" >
								I have known this person as a friend for approximately (in year) '.
								$form->field($item, "known_for_$i")->textInput(["type" => "number", "placeholder" => '(in year)'])->label(false).
						'</div></div></div>';

			}
			else{
				return '<div class="col-md-12" id=\'r_'.($i).'\'>
							<div class="row">

								<label> Friend ' . ($i + 1) . '</label>
								<div align="right">
									<button  type="button" onclick="remove_' .$i. '()">
	    								<span class="glyphicon glyphicon-remove"></span>
	  								</button>
  								</div>
								</div><div class="form-group col-md-12">'.	
									$form->field($item, "user_friend_id_$i")->widget(Select2::classname(), [
					    													'data' => $data,
					    													'id' => "relation-$i",
					    													'options' => [
					       														'placeholder'=>'Select...',
					        												]
					        											])->label(false).		   
						'<label> Closeness to you </label>
			
						<div class="form-inline">	' .

						$form->field($item, "closeness_$i")->widget(RangeInput::classname(), [
		    				'options' => ['placeholder' => 'Rate (1 - 5)...'],
		    				'html5Options' => [
		    					'min' => 1, 'max' => 5,
		    					'width' => '75%',
		    					'addon' => ['append' => ['content' => '<i class=
		    					"glyphicon glyphicon-star"></i>']]
							]])->label(false).
			    		
			    		'</div> '.
					    				    
					    '<div class="form-inline" >
								I know this person as a friend for approximately (in year) '.
								$form->field($item, "known_for_$i")->textInput(["type" => "number", "placeholder" => '(in year)'])->label(false).
						'</div></div></div>';


			}
		}

		
	?>
	<div class="col-md-12" id="containerer">

		<div align="center">
			<h1>Friendship Survey</h1>

		</div>

		<p align="center" style='color:red'> Filled in the space below, list up to ten of your closest friends that are currently in Econs/ Math and Econs; a minimum of 5 is compulsory. *Please select their full names from the dropdown list provided. Also, please select on the scale how close you are to each friend. 1Note the incentives for this section </p>

		<hr>

	<?php Pjax::begin();?>
				
			<?php $form =ActiveForm::begin(['id' => 'parttwo-form']) ?>


		    	<?php for($i = 0 ; $i < 10 ; $i++) { 
						echo addRelationForm($form ,$model, $i, 5, $data);
						if($i > 4){
							echo $form->field($model, "enabled_$i")->hiddenInput()->label(false);

						}

					  }
			   	?>
				<div class="col-md-12">
					<?= Html::Button('Add row', ['onclick' => 'addRow()',  'class'=> 'btn btn-primary']) ;?>

				</div>


				<div>

					<div style="float:left" class="form-group">
						<br>
						<?= Html::a('Previous Page', Yii::getAlias('@base-url'). '/partone/one',['class'=> 'btn btn-primary']) ;?>

					</div>
					<div style="float:right" class="form-group">
						<br>
						<?= Html::submitButton('Next Page', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
					</div>

				</div>

	</div>




	<?php ActiveForm::end()?>



		<?php Pjax::end(); ?>

			
<?php	$this->registerJsFile('/econs/frontend/web/js/partone-two.js');?>
