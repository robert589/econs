<?php
	
	use yii\helpers\Html;

    if(isset($fromModal)){
        $fromModal = 0;
    }
    else{
        $fromModal = 1;
    }

?>

<h2>Stage 2 Instructions </h2>

<p>If you remember, in stage 1, players A had to send a message to various possible 
	partners about a dice roll which they had, which would determine theirs and their partner’s payoffs.</p>


<p>You will now be playing as player B. You will be given a list of (possibly anonymous) matched partners (if any) and the messages which they sent from Stage 1.
 Further, you will be shown the payoff structure they (player As) faced in Stage 1 as well as whether they knew your identity when sending the message. 
Further, you will be asked whether or not you believe the message which they send to you. </p>

<p>Following  this,  you  will  then  be  shown  a  summary  of  your  total  payoffs  and  the  applicable information which will conclude the experiment.
 (You will be sent an email containing confirmation of the dollar payoffs which you are entitled too. </p>

<?php if($fromModal == 1){ ?>
    <?= Html::a('Close', 'javascript:void(0);', ['class' => 'btn btn-primary', 'aria-hidden' => "true", 'data-dismiss' => "modal"]) ?>
<?php }else{ ?>
    <?= Html::a('Go to survey', 'stage2', ['class' => 'btn btn-primary', 'aria-hidden' => "true", 'data-dismiss' => "modal"]) ?>

<?php } ?>


<br>
