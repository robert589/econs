<?php
	use yii\helpers\Html;

	if(isset($fromModal)){
		$fromModal = 0;
	}
	else{
		$fromModal = 1;
	}

	$this->title = "Stage 1 Instruction";
?>

	<h2>Stage 1 Instructions</h2>

	<p>
		Welcome to our online experiment. Please read the instructions carefully.
		Your payoffs will depend on the decisions made in the experiment. There will be two stages to the experiment, conducted at different dates.
	</p>

	<p>
		In Stage 1, you will play as player A with randomly chosen partners: player B whom will respond to your actions in Stage 2.	</p>
	
	<p>
		Correspondingly, if you were randomly chosen as a partner of some player A in stage 1, you will then play as player B in stage 2.	</p>
	
	<p>
	Your total payoff will consist of the amounts earned in Stages 1 and 2. In particular, your payoffs in Stage 2 as player B will be calculated based on the payoff structure which your partner had in Stage 1.
	</p>
	<br>

	<h3><b> Stage 1 </b></h3>
	<br><br>
	
	<p>
	During this stage, you make several decisions in interactions involving several other random named partners in the experiment.  
	</p>
	
	<ul>
		<li>
			At the beginning of the experiment, you will have to click a button to roll a computerized dice, the number of which you are to send a message about to your partner.  
		</li>
		<li>
			Consequently, in Stage 2 your relevant partner will be shown the message you sent. You will have 2 minutes to finish this section. (If your browser is restarted, the partners will be re-randomised.) 
		</li>
	</ul>
	<br>
	<p>
	For example the number shown on the rolled dice is x and the report be r. The payoff structure for you is as follows:
	</p>

	<p>	<b> Your Stage 1 payoff = 10 + 2r </b> </p>

	<p>
	Your partner’s payoff is determined as follows.
	</p>
	<br>

	<img> payoff will be using image </img>

	<p  style="color:blue">
	In stage 2, your randomly chosen partner will receive your message and decide whether to reject your message. 
	</p>

	<p style="color:yellow">
	Following that, he/she will then receive in addition your exact identity, information on your exact roll, as well as the payoff structure involved.
	</p>

	<p style="color:green">
	Following that, he/she will then receive in addition information on your exact roll, as well as the payoff structure involved.
		He will not find out your exact identity.
	</p>

	<p style="color:purple">
	Following that, he/she will receive information on his/her stage 2 payoffs as well as the payoff structure. He will not find out your exact roll. This means that they will not be able to find out your action from their stage 2 payoffs.
	</p>
	
	<p>
	Following that, he/she will receive information on his/her stage 2 payoffs as well as the payoff structure. He will not find out your exact roll or your identity. This means that they will not be able to find out your action from their stage 2 payoffs.
	</p>

	<p>
	**Note that here, we need to have a system in order to add in the additional set of 4 no-information treatments if needed.
	</p>

	<br>

	<?php if($fromModal == 1){ ?>
		<?= Html::a('Close', 'javascript:void(0);', ['class' => 'btn btn-primary', 'aria-hidden' => "true", 'data-dismiss' => "modal"]) ?>
	<?php }else{ ?>
		<?= Html::a('Go to survey', 'stage1', ['class' => 'btn btn-primary', 'aria-hidden' => "true", 'data-dismiss' => "modal"]) ?>

	<?php  } ?>
