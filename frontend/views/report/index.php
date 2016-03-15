<?php

    $this->title = "Report";
?>

<div class="col-md-6 col-md-offset-3" id="containerer">
    <div align="center">
         <h1><u>Total Payoff</u></h1>
    </div>

    <div class="col-md-12">
        <h3>Finish Survey: </h3>
        <br>

    </div>


    <h3><u>Part 1 </u></h3>
    <div class="col-md-12">
        <div class="row">
            <u>Total Matched friend</u>: S$ <?= 0.5 * $total_matched_friends ?>

        </div>
    </div>
    <br>
    <h3><u>Stage One</u></h3>

    <div class="col-md-12">
        <div class="row">
            <u>First degree friend</u>: S$ <?= 10 + 2 * $total_stage_one_payoff['first_score'] ?>
        </div>
        <div class="row">
            <u>Second degree friend</u>: S$ <?= 10 + 2 * $total_stage_one_payoff['first_score'] ?>
        </div>
        <div class="row">
            <u>Third degree friend</u>: S$ <?= 10 + 2 * $total_stage_one_payoff['third_score'] ?>
        </div>

        <div class="row">
            <u>Stranger</u>: S$ <?= 10 + 2 * $total_stage_one_payoff['stranger_score'] ?>
        </div>

        <div class="row">
            <u>Nameless</u>: S$ <?= 10 + 2*  $total_stage_one_payoff['nameless_score'] ?>
        </div>

    </div>

    <label>
        <h3>Total Payoff: </h3>
    </label>
</div>