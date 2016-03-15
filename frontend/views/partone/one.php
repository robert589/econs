<?php
	use yii\bootstrap\ActiveForm;
	use yii\helpers\Html;
	use kartik\widgets\Select2;
	use yii\bootstrap\Modal;
	use kartik\typeahead\TypeaheadBasic;
	//put jquery here

$this->title = 'Survey | First Part';
	/*DELETE IT LATER*/
	//refresh problem
$language_data = [
	'English' => 'English',
	'Malaysian' => 'Malaysian',
	'Mandarin' => 'Mandarin',
	'Chinese' => 'Chinese',
	'Indonesian' => 'Indonesian',
	'Japanese' => 'Japanese',
	'Arabic' => 'Arabic'
];

$this->registerJsFile(Yii::$app->request->baseUrl . '/frontend/web/js/jquery.js');

//$background_link = Yii::$app->request->baseUrl . '/img/background-title.png';
?>


<?php
    Modal::begin([
		'id' => 'partone-inst',
		'size' => 'modal-lg',
		'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]
	]);

        echo $this->render('instruction');

    Modal::end();
?>



	<div class="col-md-offset-2 col-md-8" id="containerer">
		<div align="center" >
			<h1>Economic Survey</h1>
			<hr>
		</div>

	    <div class="row">
	    		<?php $form =ActiveForm::begin(['id' => 'partone-one-form']) ?>
				<label><u>Student Information</u> </label>

				<div class="col-md-12">
					<div class="col-md-8">
						<!-- Name -->
						<?= $form->field($model, 'confirm_identity')->checkbox()->label('Please confirm that your name is ' . $full_name) ?> <hr>
					</div>
					<div class="col-md-4">
						<!-- Gender-->
						<?= $form->field($model, 'gender')->widget(Select2::className(), [
							'data' => ['Male' => 'Male', 'Female' => 'Female'],
							'options' => ['placeholder' => 'Select your gender ...'],
							'pluginOptions' => [
								'allowClear' => true
							],
						]); ?>
					</div>
				</div>


				<div class="col-md-12">
					<!-- Course -->
					<div class="col-md-4">
						<?= $form->field($model, 'course')->widget(Select2::className(), [
							'data' => ['Economics' => 'Economics', 'MAEC' => 'Mathematics and Economics'],
							'options' => ['placeholder' => 'Select your course ...'],
							'pluginOptions' => [
								'allowClear' => true
							],
						]); ?>
					</div>

					<div class="col-md-4">
						<!-- Year of study -->
						<?= $form->field($model, 'year_of_study')->widget(Select2::className(), [
							'data' => ['1' => 'Year 1', '2' => 'Year 2', '3' => 'Year 3', '4' => 'Year 4'],
							'options' => ['placeholder' => 'Select your year of study ...'],
							'pluginOptions' => [
								'allowClear' => true
							],
						]); ?>
					</div>
					<div class="col-md-4">

						<!-- Your CGPA -->
						<?= $form->field($model, 'your_cgpa')->textInput(['type' => 'number', 'step' => '0.01', 'placeholder'=> 'Range from 0 to 5'])->label('Please enter your CGPA ')?><hr>

					</div>
				</div>


				<div class="col-md-12">
					<div class="col-md-12">
						<!-- User prior school -->
						<?= $form->field($model, 'user_prior_school')->label('Please enter your school prior to NTU(High School/JC/Polytechnic)')?><hr>

					</div>

				</div>

				<hr>

				<label><u>Personal Information</u></label>
					<div class="col-md-12">
						<div class="col-md-3">
							<?= $form->field($model, 'year_of_birth')->textInput(['type' => 'number'])->label('Year of Birth')?>
						</div>

						<div class="col-md-3">
							<!-- Number of sibling -->
							<?= $form->field($model, 'num_of_sibling')->textInput(['type' => 'number'])->label('Number of siblings')?>
						</div>

						<div class="col-md-3">
							<!-- User height- -->
							<?= $form->field($model, 'user_height')->textInput(['type' => 'number'])->label('Height (in cm)')?>

						</div>

						<div class="col-md-3">
							<!-- User weight- -->
							<?= $form->field($model, 'user_weight')->textInput(['type' => 'number'])->label('Weight (in Kg)')?>
						</div>

						<div class="col-md-12">
							<hr>
						</div>

					</div>

					<div class="col-md-12">
						<div class="col-md-12">
							<!-- User money received-->
							<label> On average, how much do you spend a week?(in SGD)</label>
							<?= $form->field($model, 'user_money_received')->widget(Select2::className(), [
								'data' => ['less than 10' => 'less than 10',
									'10 - 19' => '10 - 19',
									'20 - 29' => '20 - 29',
									' > 30' => 'greater than 30'],
								'options' => ['placeholder' => 'Select your choice ...'],
								'pluginOptions' => [
									'allowClear' => true
								],
							])->label(false); ?>

						</div>

						<div class="col-md-12">
							<hr>
						</div>
					</div>

					<div class="col-md-12">
						<div class="col-md-6">
							<!-- Work part time -->
							<label> Do you work part time? </label>

							<?= $form->field($model, 'work_part_time')->widget(Select2::className(), [
								'data' => [1 => 'yes',
									0 => 'no'],
								'options' => ['placeholder' => 'Do you work part time? ...'],
								'pluginOptions' => [
									'allowClear' => true
								],
								'pluginEvents' => [
									"select2:select" => "function() {
																if($(\"#partone1form-work_part_time\").val() == 1){
																	$(\"#hour_week\").prop('disabled',false);
																	$(\"#part_time_rate\").prop('disabled',false);
															 	}else{
															 		$(\"#hour_week\").prop('disabled',true);
																	$(\"#part_time_rate\").prop('disabled',true);
															 	}
															 }",

								]
							])->label(false); ?>


						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<?= $form->field($model, 'hour_week')->textInput(['id' => 'hour_week', 'type' => 'number', 'placeholder' => 'Hour/Week', 'disabled' => true])->label("hours/week")?>
								</div>

								<div class="col-md-6">
									<?= $form->field($model, 'part_time_rate')->textInput(['id' => 'part_time_rate', 'type' => 'number', 'placeholder' => 'rate/hour(SGD)', 'disabled' => true])->label("rate/hour (in SGD)")?>
								</div>
							</div>

						</div>

						<div class="col-md-12">
							<hr>
						</div>
					</div>

	    			<div class="col-md-12">
						<div class="col-md-3">
							<!-- Volunteer Activity-->
							<?= $form->field($model, 'volunteer_activity')->widget(Select2::className(), [
								'data' => [1 => 'Yes', 0 => 'No'],
								'options' => ['placeholder' => 'Do you have any volunteer activity ...'],
								'pluginOptions' => [
									'allowClear' => true
								],
							])->label("Do you have any volunteer activity?"); ?>
						</div>
						<div class="col-md-5">
							<!--Favourite Hobbies-->

							<label> What is your favorite hobby ? </label>

							<?= $form->field($model, 'hobbies')->widget(Select2::className(), [
								'data' => ['Reading' => 'Reading', 'Listening to music' => 'Listening to music',
									'Playing Computer Games' => 'Playing Computer Games', 'Playing Sport Games' => 'Playing Sport Games',
									'Watching TV' => 'Watching TV', 'Others' => 'Others'],
								'options' => ['placeholder' => 'What is your favorite hobbies? ...'],
								'pluginOptions' => [
									'allowClear' => true
								],
								'pluginEvents' => [
									"select2:select" => "function() {
																	if($(\"#partone1form-hobbies\").val() == 'Others'){
																		$(\"#otherHobbies\").prop('disabled',false);
																	}else{
																		$(\"#otherHobbies\").prop('disabled',true);
																	}
																 }",

								]
							])->label(false); ?>

						</div>

						<div class="col-md-4">
							<?= $form->field($model, 'other_hobbies')->label("Your other hobbies")->textInput(['id' => 'otherHobbies' ,'placeholder' => "Other hobbies", 'disabled' => true])?>
						</div>

						<div class="col-md-12">
							<hr>
						</div>
					</div>

					<div class="col-md-12">
						<div class="col-md-12">
							<!--CCA -->
							<?= $form->field($model, 'user_cca')->label('Please enter your CCA (if any)')?>

						</div>

						<div class="col-md-12">
							<hr>
						</div>

					</div>

	    			<hr>

					<div class="col-md-12">
						<div class="col-md-4">
							<!-- User First Language-->
							<?= $form->field($model, 'user_first_language')->widget(TypeaheadBasic::classname(), [
							'data' => $language_data,
							'pluginOptions' => ['highlight' => true],
							'options' => ['placeholder' => 'Your First Language	 ...'],
							]);
							?>
						</div>

						<div class="col-md-4">
							<!--User hall-->
							<label>Do you live on campus? </label>

							<?= $form->field($model, 'user_hall')->widget(Select2::className(), [
								'data' => [1 => 'yes',
									0 => 'no'],
								'options' => ['placeholder' => 'Do you live on campus? ...'],
								'pluginOptions' => [
									'allowClear' => true
								],
								'pluginEvents' => [
									"select2:select" => "function() {
																	if($(\"#partone1form-user_hall\").val() == 1){
																		$(\"#partone1form-hall_number\").prop('disabled',false);
																	}else{																																			$(\"#partone1form-hall_number\").prop('disabled',true);
																		$(\"#partone1form-hall_number\").prop('disabled',true);
																	}
																 }",

								]
							])->label(false); ?>
						</div>

						<div class="col-md-4">


							<?= $form->field($model, 'hall_number')->widget(Select2::className(), [
								'data' => [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 =>'7', 8=> '8',
									9 => '9', 10 => '10', 11 => '11', 12 => '12', 13 => '13', 14 => '14', 15 => '15',
									16 => '16', 17 => '17 (Crescent Hall)' , 18 => '18 (Pioneer Hall)'
								],
								'disabled' => true,
								'options' => ['placeholder' => 'Select your hall number...'],
								'pluginOptions' => [
									'allowClear' => true
								],
							])->label("Hall number"); ?>





						</div>


					</div>

					<div class="col-md-12">
						<hr>
					</div>

					<div class="col-md-12">
						<div class="col-md-12">

							<label>Generally speaking, would you say that most people can be trusted, or that you can’t be too careful in dealing with people?</label>
							<?= $form->field($model, 'trust_choice')->widget(Select2::className(), [
								'data' => ['A' => 'Most people can be trusted',
									'B' => 'You can’t be too careful in dealing with people '
								],
								'options' => ['placeholder' => 'Select your choice...'],
								'pluginOptions' => [
									'allowClear' => true
								],
							])->label(false); ?>
						</div>
					</div>

					<div class="col-md-12">
						<hr>
					</div>


		    		<div align="center" class="form-group">
	                   	<?= Html::submitButton('Next Page', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
	                </div>
	    		<?php ActiveForm::end()?>

			</div>
		</div>
	</div>
	

<?php
	$this->registerJsFile(Yii::$app->request->baseUrl . '/frontend/web/js/partone.js');
	$this->registerJsFile(Yii::$app->request->baseUrl. '/frontend/web/js/partone-one.js');
 ?>