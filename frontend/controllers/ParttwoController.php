<?php

namespace frontend\controllers;

use backend\models\CurrentStage;
use Yii;
use yii\web\Controller;
use frontend\models\PartTwo1Form;
use frontend\models\Stage1Form;
use frontend\models\stage2Form;
use common\models\StageOne;
use common\models\User;
use common\models\StageTwo;
use common\models\ActualDiceValue;

class ParttwoController extends Controller{
    const PARTTWO_STAGE1_STATUS = 5;
    const PARTTWO_STAGE2_STATUS = 6;
    const FINISH = 7;

    public function actionIndex(){
        $user  = new User();
        $current_status = $user->getCurrentStatus();

        if($current_status < self::PARTTWO_STAGE1_STATUS){
            return $this->redirect(Yii::$app->request->baseUrl . '/partone/index');
        }
        else if($current_status == self::PARTTWO_STAGE1_STATUS){
            return $this->redirect(Yii::$app->request->baseUrl . '/parttwo/stage1inst');

        }
        else if($current_status == self::PARTTWO_STAGE2_STATUS){
            return $this->redirect(Yii::$app->request->baseUrl. '/parttwo/stage2inst');

        }
        else{
            return $this->redirect(Yii::$app->request->baseUrl . '/parttwo/finish');
        }

    }
    /*
	public function actionOne(){
        $this->firstAction(self::PARTTWO_ONE_STATUS);
        $model = new PartTwo1Form();
        $error = "";
        if($model->load(Yii::$app->request->post())&& $model->validate()){
            if($model->check()){
                $user = new User();
                $user->setStatus(self::PARTTWO_STAGE1_STATUS);
                return $this->redirect('stage1');
            }
            else{
                $error =  "CGPA is not correct";
            }
        }

        return $this->render('one', ['model' => $model, 'error' => $error]);
	}
    */

    public function actionStage1inst(){
        $this->firstAction(self::PARTTWO_STAGE1_STATUS);
        $user_id = \Yii::$app->user->getId();
        if(ActualDiceValue::checkExist($user_id)){
            $diceValue = 0;
        }
        else{
            if( !($diceValue = ActualDiceValue::getDiceValue($user_id))){
                $diceValue = 0;
            }
        }

        return $this->render('stage1inst', ['fromModal' => 0]);
    }

    public function actionStage1(){
        $this->firstAction(self::PARTTWO_STAGE1_STATUS);

        //CHECK DOES THE PLAYER HAS ROLLED THE DICE
        $actualDiceValue = new ActualDiceValue();
        $actualDiceValue->user_id = \Yii::$app->user->identity->getId();
        if($actualDiceValue->checkExist()){
            if( !($diceValue = $actualDiceValue->getDiceValue())){
                 $diceValue = 0;
            }
        }
        else{
            $diceValue = 0;
        }

        //CHECK DICE VALUE
        if(isset($_GET['dice']) ){
            if(isset($_POST['dicevalue'])){
                $actualDiceValue->score = $_POST['dicevalue'];
                if(!$actualDiceValue->save()){
                    return $this->redirect('error');
                }
                $diceValue = $actualDiceValue->getDiceValue(\Yii::$app->user->identity->getId());
            }

        }

        //CHECK THE STAGE
        if(isset($_GET['degree'])){
             $code= $_GET['degree'];

            if($code == 1){
                $degree = 'FIRST_DEGREE';
            }
            else if($code == 2){
                $degree = 'SECOND_DEGREE';
            }
            else if($code == 3){
                $degree = 'THIRD_DEGREE';
            }
            else if($code == 4){
                $degree = 'STRANGER';
            }
            else if($code == 5){
                $degree = 'NAMELESS';
            }
            else{
                $degree = 'FIRST_DEGREE';
            }



        }
        else{
            $code = 1;
            $degree = 'FIRST_DEGREE';
        }

        $model = new Stage1Form($degree);
        if($model->friend_id == null){
            $code++;
            if($code == 6){

                return $this->redirect('stage2');
            }
            return $this->redirect('stage1?degree=' . $code);
        }
        if($model->load(Yii::$app->request->post()) ){
            if($model->store()){
                if($code == 1){
                    return $this->redirect('stage1?degree=2');
                }
                else if($code == 2){
                    return $this->redirect('stage1?degree=3');

                }
                else if($code == 3){
                    return $this->redirect('stage1?degree=4');
                }
                else if($code == 4){
                    return $this->redirect('stage1?degree=5');
                }
                else if($code == 5){
                    $user = new User();
                    $user->setStatus(PARTTWO_STAGE2_STATUS);
                    return $this->redirect('stage2');
                }
                else{
                    \Yii::$app->end();

                }

                return null;
            }


        }

        return $this->render('stage1', ['diceValue' => $diceValue, 'model' => $model]);
    }

    public function actionStage2inst(){
        $this->firstAction(self::PARTTWO_STAGE2_STATUS);
        return $this->render('stage2inst',['fromModal' => 0]);
    }

    public function actionStage2(){
        $this->firstAction(self::PARTTWO_STAGE2_STATUS);


        //get current status
        $user = new User();
        $remark = StageTwo::getRemark();
        $model  = new Stage2Form();
        switch($remark){
            case 1: $model->remark = "1";
                    $friend = StageOne::getFriend(\Yii::$app->user->getId(), $model->remark);
                    $model->personid = $friend['id'];
                    $model->title = "With observability, No negative externalities, and Non Anonymous";
                    $model->personname = $friend['name'];
                    $model->personscore = $friend['score'];
            break;

            case 2: $model->remark = "2";
                    $friend = StageOne::getFriend(\Yii::$app->user->getId(), $model->remark);
                    $model->personid = $friend['id'];
                    $model->title = "With observability, No negative externalities, and Anonymous";
                    $model->personname = "Anonymous";
                    $model->personscore = $friend['score'];
            break;

            case 3: $model->remark = "3";
                    $friend = StageOne::getFriend(\Yii::$app->user->getId(), $model->remark);
                    $model->personid = $friend['id'];
                    $model->title = "With observability, Negative externalities, and Anonymous";
                    $model->personname = "Anonymous";
                    $model->personscore = $friend['score'];
            break;

            case 4:$model->remark = "4"; 
                    $friend = StageOne::getFriend(\Yii::$app->user->getId(), $model->remark);
                    $model->personid = $friend['id'];
                    $model->title = "With No observability, No negative externalities, and Anonymous";
                    $model->personname = "Anonymous";
                    $model->personscore = $friend['score'];
            break;
        }

        if(isset($_POST['answer'])){

            $model->answer = $_POST['answer'];
            if($model->store()){
                //also return the update status
                $user = new User();
                $user->setStatus(self::FINISH);
                return $this->redirect(\Yii::$app->homeUrl . '../../parttwo/finish');
            }
        }

        if($friend == null){
            $word = "You dont have any friend choosing from you in the stage one, sorry :(";
            return $this->redirect('no-friend');
        }
        else{
            return $this->render('stage2', ['model' => $model]);
        }

     }

    public function actionNotFound(){
        if(isset($_GET['message'])){
            $message = $_GET['message'];

            return $this->render('not-found', ['message' => $message]);
        }
    }

    /**
     * When you have no friend in stage2
     * @return string
     */
    public function actionNoFriend(){
        return $this->render('no-friend');
    }

    public function actionFinish(){
   
        return $this->render('finish');
    }

    private function firstAction($status)
    {
        //Check eligibility
        if (\Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->request->baseUrl . '/site/login');
        }

        if( $status == self::PARTTWO_STAGE1_STATUS){
            if(CurrentStage::getCurrentStage() != 2){
                $message = "This part is either not started or done";
                return $this->redirect('not-found?message='. $message);
            }
        }
        else if($status == self::PARTTWO_STAGE2_STATUS){
            if(CurrentStage::getCurrentStage() != 3){
                $message = "This part is either not started or done";
                return $this->redirect('not-found?message='. $message);
            }
        }
        else{

        }

        $user = new User();
        $current_status = $user->getCurrentStatus();

        if($current_status < $status){
            $message = 'You could not access this section right now, if you are confused, please click "Go to survey" button';
            return $this->redirect('not-found?message='. $message);
        }

    }
}