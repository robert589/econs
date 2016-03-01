<?php
	/** @var $email_form */
/** @var $email_form1 */

	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use yii\widgets\Pjax;
?>

<h1 align="center">Be careful when using the email system</h1>
<p>used( :email  :password :name ) to adjust the email, password, name according to the user</p>

<?php $form = ActiveForm::begin(['action' => ['site/sendall'], 'method' => 'post' ]) ?>

	<?= $form->field($email_form, 'title') ?>

	<?= $form->field($email_form, 'description')->textarea(['rows' => 4]) ?>


	<?= Html::submitButton('Send Password to All Students',  ['class' => 'btn btn-primary'] ) ?>

<?php ActiveForm::end() ?>

<hr>


<?php $form = ActiveForm::begin(['action' => ['site/sendone'], 'method' => 'post']) ?>

<?= $form->field($email_form1, 'email')->label("Send to ") ?>


<?= $form->field($email_form1, 'title') ?>

<?= $form->field($email_form1, 'description')->textarea(['rows' => 4]) ?>


<?= Html::submitButton('Send Password to Particular Student',  ['class' => 'btn btn-primary'] ) ?>

<?php ActiveForm::end() ?>