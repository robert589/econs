<?php

namespace frontend\controllers;

use common\models\Character;
use common\models\Happiness;
use common\models\Preference;
use common\models\Relation;
use common\models\UserInfo;
use frontend\models\PartOne5Form;
use Yii;
use yii\web\Controller;
use common\models\User;
use frontend\models\RelationForm;
use backend\models\CurrentStage;
use frontend\models\PartOne1Form;
use frontend\models\PartOne3Form;
use frontend\models\PartOne4Form;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


DEFINE('PARTONE_ONE_STATUS', 0);
DEFINE('PARTONE_TWO_STATUS', 1);
DEFINE('PARTONE_THREE_STATUS',2);
DEFINE('PARTONE_FOUR_STATUS', 3);
DEFINE('PARTONE_FIVE_STATUS', 4);


class PartoneController extends Controller{

    /**
     * Goto survey index
     * @return \yii\web\Response
     */
    public function actionIndex(){
        $user  = new User();
        $current_status = $user->getCurrentStatus();

        if($current_status == PARTONE_ONE_STATUS){
            return $this->redirect(Yii::$app->request->baseUrl . '/partone/instruction');
        }
        else if($current_status == PARTONE_TWO_STATUS){
            return $this->redirect(Yii::$app->request->baseUrl . '/partone/two');

        }
        else if($current_status == PARTONE_THREE_STATUS){
            return $this->redirect(Yii::$app->request->baseUrl . '/partone/three');

        }
        else if($current_status == PARTONE_FOUR_STATUS){
            return $this->redirect(Yii::$app->request->baseUrl . '/partone/four');

        }
        else if($current_status == PARTONE_FIVE_STATUS){
            return $this->redirect(Yii::$app->request->baseUrl . '/partone/five');

        }
        else{
            return $this->redirect(Yii::$app->request->baseUrl . '/partone/finish');
        }
    }

    public function actionInstruction(){
        return $this->render('instruction', ['fromModal' => 0]);
    }


     /**
     * Goto survey part 1
     * @return string|\yii\web\Response
     */
    public function actionOne(){
        //Check eligibility
        $this->firstAction(PARTONE_ONE_STATUS);

        $user = new User();

        $model = new PartOne1Form();
        $model->setId(Yii::$app->user->getId());
        $full_name = User::retrieveName($model->id);

        if($model->load(Yii::$app->request->post()) && $model->store()){
            if($user->getCurrentStatus() <= 0 ){
                $user->setStatus(1);

            }
             return $this->redirect(Yii::$app->request->baseUrl. '/partone/two');
        }

        if($model->hasErrors()){
            Yii::trace( Html::errorSummary($model));
        }

        return $this->render('one', ['model' => $model, 'full_name' => $full_name]);
    }

    /**
     * Goto survey part 2
     * @return null|string|\yii\web\Response
     */
    public function actionTwo(){
        //Check eligibility
        $this->firstAction(1);

        $user=  new User();
        //retrieve data
        $data = ArrayHelper::map(User::retrieveAll(), 'id', 'name');

        $model = new RelationForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {

            if($model->store()){
                if($user->getCurrentStatus() <= 1 ){
                    $user->setStatus(2);
                }
                return $this->redirect(Yii::$app->request->baseUrl. '/partone/three');

            }

        }
        else {
            Yii::trace('model: '.  $model->enabled_5);
            return $this->render('two', ['model' => $model, 'data' => $data]);
        }
        return null;
    }

    /**
     * Goto survey part 3
     * @return string|\yii\web\Response
     */
    public function actionThree(){
        $this->firstAction(2);

        $user = new User();

        $model = new PartOne3Form();

        if($model->load(Yii::$app->request->post()) && $model->store()){
            if($user->getCurrentStatus() <= 2 ){
                $user->setStatus(3);
            }
            return $this->redirect(Yii::$app->request->baseUrl. '/partone/four');
        }
        return $this->render('three', ['model' => $model]);

    }

    /**
     * Goto survey part 4
     * @return string|\yii\web\Response
     */
    public function actionFour(){
        $this->firstAction(3);

        $user = new User();

        $model = new PartOne4Form();

        if($model->load(Yii::$app->request->post()) && $model->store()){
            if($user->getCurrentStatus() <= 3 ){
                $user->setStatus(4);
            }
            return $this->redirect('five');

        }

        return $this->render('four', ['model' => $model]);
   }

    /**
     * Goto survey part 5
     * @return string|\yii\web\Response
     */
    public function actionFive(){
        $this->firstAction(4);

        $model = new PartOne5Form();
        $user = new User();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            if($model->store()){
                if($user->getCurrentStatus() <= 4){
                    $user->setStatus(ParttwoController::PARTTWO_ONE_STATUS);
                }
                return $this->redirect('index');
            }
        }

        return $this->render('five', ['model' => $model]);

    }

    public function actionFinish(){
        $user_id = Yii::$app->getUser()->id;

        $user_info = UserInfo::find()->where(['id' => $user_id])->one();

        $user_character = Character::find()->where(['id' => $user_id])->one();

        $user_happiness = Happiness::find()->where(['id' => $user_id])->one();

        $user_preference = Preference::find()->where(['user_id' => $user_id])->one();

        $relations = Relation::getAllFriendsByUserId($user_id);


        return $this->render('finish', ['user_info' => $user_info,
                                        'user_character' => $user_character,
                                        'user_happiness' => $user_happiness,
                                        'user_preference' => $user_preference,
                                        'relations' => $relations]);
    }

    /**
     * Page Not Found
     * @return string
     */
    public function actionNotFound(){
        if(isset($_GET['message'])){
            $message = $_GET['message'];
            return $this->render('not-found' ,['message' =>  $message]);
        }
    }

    public function actionGoToSurvey(){
        $current_stage = CurrentStage::getCurrentStage();

        if($current_stage == 1){
            return $this->redirect(Yii::$app->request->baseUrl . '/partone/index');
        }
        else if($current_stage == 2){
            return $this->redirect(Yii::$app->request->baseUrl . '/parttwo/stage1inst');
        }
        else if($current_stage == 3){
            return $this->redirect(Yii::$app->request->baseUrl . '/parttwo/stage2inst');
        }
        else if($current_stage == 4){
            return $this->redirect(Yii::$app->request->baseUrl . '/report/index');
        }
    }

    private function firstAction($page){
        if (\Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->request->baseUrl . '/site/login');
        }

        //get the current stage
        if(CurrentStage::getCurrentStage() != 1){
            $message = "This part is either not started or done";
            //Yii::$app->end($message);
            return $this->redirect('not-found?message=' . $message);

        }
        //get the status
        $user = new User();
        $current_status = $user->getCurrentStatus();

        if($current_status < $page){
            $message = 'You could not access this section right nown <br>
                        Please finish the previous survey stage or click <b>Current Stage</b> button in the menu bar above <br><br>';
            return $this->redirect('not-found?message=' . $message);
        }

    }


}

