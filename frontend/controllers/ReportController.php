<?php
namespace frontend\controllers;

use backend\models\CurrentStage;
use Yii;
use common\models\StageOne;
use yii\web\Controller;
use common\models\Relation;
use common\models\User;
/**
 * Site controller
 */
class ReportController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if(!\Yii::$app->user->isGuest){
            if(CurrentStage::getCurrentStage() == CurrentStage::REPORT){
                $user_id = Yii::$app->user->getId();
                //get total matched friends
                $total_matched_friends = Relation::getMatchedFriends($user_id);

                //get total stage one payoff
                $total_stage_one_payoff = StageOne::getTotalPayoffFromStage1($user_id);


                //get user current status
                $user = new User();
                $user_current_status = $user->getCurrentStatus();

                //check whether user has finished it
                if($user_current_status > ParttwoController::FINISH){
                    $finish = true;
                }
                else{
                    $finish = false;
                }

                return $this->render('index', ['total_matched_friends' => $total_matched_friends,
                    'finish' => $finish,
                    'total_stage_one_payoff' => $total_stage_one_payoff]);
            }
            else{
                return $this->redirect(Yii::$app->request->baseUrl . '/report/prohibited');
            }

        }
        else{
            return $this->redirect(Yii::$app->request->baseUrl . '/site/login');
        }


    }

    public function actionProhibited(){
        return $this->render('prohibited');
    }



}
