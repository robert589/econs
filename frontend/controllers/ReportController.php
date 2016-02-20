<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use frontend\models\PartOne1Form;
use frontend\models\StageOne;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Relation;
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
            return $this->redirect(Yii::getAlias('@base-url') . '/site/login');
        }


    }



}
