<?php
    use yii\helpers\Html;



?>

<div align="center">
   <h1> Welcome to the Survey :) </h1>
</div>
<p> Thank you for participating in this survey.
    Please be assured that your answers will be kept completely confidential and your identity will be protected.
    While your name is required for this survey, we assure you that your identity will not be disclosed to
    any third party nor published. School administrator and Course coordinator will not have any access to raw data
    obtained from this survey.  Please fill in the blank or circle the answer that you feel is most appropriate.
    Do not spend too much time on any questions. Please answer quickly and honestly. </p>

<div align="center">

    <?php if(isset($fromModal)){ ?>
        <?= Html::a('I have read the instruction!', 'one', ['class' => 'btn btn-primary', 'aria-hidden' => "true", 'data-dismiss' => "modal"]) ?>

    <?php }else{ ?>
        <?= Html::a('I have read the instruction!', 'javascript:void(0);', ['class' => 'btn btn-primary', 'aria-hidden' => "true", 'data-dismiss' => "modal"]) ?>

    <?php } ?>
</div>
