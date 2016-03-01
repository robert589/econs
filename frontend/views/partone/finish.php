<?php
    /** @var $user_info */
    /** @var $relations */
    /** @var $user_character */
    /** @var $preference */
    /** @var $user_happiness */

    use yii\helpers\Html;

    $this->title  ="Finish";

    if($user_info['work_part_time'] == 0){
        $work_part_time = "No";
    }
    else{
        $work_part_time = "Yes";
    }

    if($user_info['volunteer_activity'] == 0){
        $volunteer_activity = "No";
    }
    else{
        $volunteer_activity = "Yes";
    }

    if($user_info['user_hall'] == 0){
        $live_in_hall = "No";

    }
    else{
        $live_in_hall = "Yes";
    }

    if($user_info['trust_choice'] == "A"){
        $trust_choice = "Most people can be trusted";
    }
    else{
        $trust_choice = "You can't be too careful in dealing with people";
    }
?>

<div>

    <div align="center">
        <h1>Thank you for taking this survey</h1>

        <h2><u>Summary </u></h2>
        <hr>
    </div>

    <div align="left" style="font-size: 25px">
        <h2><b>1. Personal Information </b></h2>

        <br>

        <b>Gender</b>: <?= $user_info['gender'] ?> <br><br>

        <b>Course</b>: <?= $user_info['course'] ?> <br><br>

        <b>Year of Birth</b>: <?= $user_info['year_of_birth'] ?> <br><br>

        <b>Year of Study</b>: Year <?= $user_info['year_of_study'] ?> <br> <br>

        <b>Please enter your school prior to NTU(High School/JC/Polytechnic) </b><br>
        <?= $user_info['user_prior_school'] ?> <br> <br>

        <b>User height: </b> <?= $user_info['user_height'] ?> cm <br><br>

        <b>User weight: </b> <?= $user_info['user_weight'] ?> kg<br><br>

        <b>Number of siblings:</b> <?= $user_info['num_of_sibling'] ?><br> <br>

        <b>Your CGPA: </b> <?= $user_info['your_cgpa'] ?>/5 <br><br>

        <b>On average, how much do you spend a week?(in SGD)      </b><br>
        <?= $user_info['user_money_received'] ?> <br> <br>


        <b>Do you work part time? </b><br>
        <?= $work_part_time ?> <br><br>

        <b>Hour week:</b> <?= $user_info['hour_week'] ?> <br><br>
        <b>Part time rate:</b> <?= $user_info['part_time_rate'] ?> <br><br>

        <b>Do you have volunteer activity? </b><br>
        <?= $volunteer_activity ?> <br><br>

        <b>Hobbies: </b> <?= $user_info['hobbies'] ?> <br><br>

        <b>Other hobbies: </b> <?= $user_info['other_hobbies'] ?> <br><br>

        <b>Your CCA:</b> <?= $user_info['user_cca'] ?> <br><br>
        <b>Your Native Language:</b> <?= $user_info['user_first_language'] ?> <br><br>

        <b>Do you live in hall? </b><br>
        <?= $live_in_hall ?> <br><br>

        <b>Hall number: </b> <?= $user_info['hall_number'] ?> <br><br>

        <b>Generally speaking, would you say that most people can be trusted, or that you can’t be too careful in dealing with people? </b><br>
        <?= $trust_choice ?> <br><br>



        <br><br>
        <?= Html::a('Edit', Yii::$app->request->baseUrl . '/partone/one') ?>
    </div>

    <hr>

    <div align="left" style="font-size: 25px">
        <h2><u><b>2. Friendship Survey </b></u></h2>

        <br>

        <?php
        $i = 1;
        foreach($relations as $relation){ ?>

            <u><?= $i . '.' ?> <?= $relation['name'] ?></u><br>

            <b>You have known this person for: </b>  <?= $relation['known_for'] ?> year <br>
            <b>Closeness: </b> <?= $relation['closeness'] ?>/5
            <br><br>


        <?php $i++;} ?>

        <br><br>
        <?= Html::a('Edit', Yii::$app->request->baseUrl . '/partone/two') ?>
    </div>

    <hr>

    <div align="left" style="font-size: 25px">
        <h2><u><b>3. Personality </b></u></h2>

        <br>

        <b>Realistic: </b> <?= $user_character['optimistic'] ?>/5 <br><br>

        <b>Introverted: </b> <?= $user_character['extroverted'] ?>/5 <br><br>

        <b>Self-conscious: </b> <?= $user_character['confident'] ?>/5 <br><br>

        <b>Shy: </b> <?= $user_character['outgoing'] ?>/5 <br><br>

        <?= Html::a('Edit', Yii::$app->request->baseUrl . '/partone/three') ?>
    </div>

    <hr>

    <div align="left" style="font-size: 25px">
        <h2><u><b>4. Perspective </b></u></h2>

        <br>

        <b>A very happy person: </b> <?= $user_happiness['happiness'] ?>/7 <br><br>

        <b>More happy with most of my peers: </b> <?= $user_happiness['comhappiness'] ?>/7 <br><br>

        <b>Some people are generally very happy. They enjoy life regardless of what is going on, getting the most out of everything. To what extent does this characterization describe you? </b><br> <?= $user_happiness[ 'careless'] ?>/7 <br><br>

        <b>Some people are generally not very happy. Although they are not depressed, they never seem as happy as they might be. To what extent does this characterization describe you?
        </b><br> <?= $user_happiness[ 'secretive'] ?>/7 <br><br>

        <?= Html::a('Edit', Yii::$app->request->baseUrl . '/partone/four') ?>
    </div>

    <hr>


    <div align="left" style="font-size: 25px">
        <h2><u><b>5. Holt and Laury Survey </b></u></h2>

        <br>

        <div class="row">
            <hr>
            <div class="col-md-1">
                <label>1. </label>
            </div>
            <div class="col-md-4">
                <b> A. 100% - 365 Baht </b>
                <br><br>
                <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
                <br><br>
                <?= $user_preference['_365_baht'] ?>

            </div>


        </div>

        <div class="row">
            <hr>
            <div class="col-md-1">
                <label>2. </label>
            </div>
            <div class="col-md-4">
                <b> A. 100% - 350 Baht </b>
                <br><br>
                <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
                <br><br>
                <?= $user_preference['_350_baht'] ?>

            </div>
        </div>

        <div class="row">
            <hr>
            <div class="col-md-1">
                <label>3. </label>
            </div>
            <div class="col-md-4">
                <b> A. 100% - 314 Baht </b>
                <br><br>
                <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
                <br><br>
                <?= $user_preference['_314_baht'] ?>

            </div>


        </div>

        <div class="row">
            <hr>
            <div class="col-md-1">
                <label>4. </label>
            </div>
            <div class="col-md-4">
                <b> A. 100% - 273 Baht </b>
                <br><br>
                <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
                <br><br>
                <?= $user_preference['_273_baht'] ?>

            </div>


        </div>

        <div class="row">
            <hr>
            <div class="col-md-1">
                <label>5. </label>
            </div>
            <div class="col-md-4">
                <b> A. 100% - 250 Baht </b>
                <br><br>

                <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
                <br><br>
                <?= $user_preference['_250_baht'] ?>

            </div>


        </div>

        <div class="row">
            <hr>
            <div class="col-md-1">
                <label>6. </label>
            </div>
            <div class="col-md-4">
                <b> A. 100% - 221 Baht </b>
                <br><br>
                <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
                <br><br>
                <?= $user_preference['_221_baht'] ?>

            </div>


        </div>

        <div class="row">
            <hr>
            <div class="col-md-1">
                <label>7. </label>
            </div>
            <div class="col-md-4">
                <b> A. 100% - 154 Baht </b>
                <br><br>
                <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
                <br><br>
                <?= $user_preference['_154_baht'] ?>

            </div>


        </div>

        <div class="row">
            <hr>
            <div class="col-md-1">
                <label>8. </label>
            </div>
            <div class="col-md-4">
                <b> A. 100% - 57 Baht </b>
                <br><br>
                <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
                <br><br>
                <?= $user_preference['_57_baht'] ?>

            </div>


        </div>

        <div class="row">
            <hr>
            <div class="col-md-1">
                <label>9. </label>
            </div>
            <div class="col-md-4">
                <b> A. 100% - 32 Baht </b>
                <br><br>
                <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
                <br><br>

                <?= $user_preference['_32_baht'] ?>
            </div>


        </div>

        <div class="row">
            <hr>
            <div class="col-md-1">
                <label>10. </label>
            </div>
            <div class="col-md-4">
                <b> A. 100% - 5 Baht </b>
                <br><br>
                <b> B. 50% - 500 Baht, 50% - 0 Baht </b>
                <br><br>
                <?= $user_preference['_5_baht'] ?>
            </div>


        </div>


        <?= Html::a('Edit', Yii::$app->request->baseUrl . '/partone/four') ?>
    </div>

</div>
