<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use common\models\Relation;
use common\models\StageOne;
use Yii;

define("FIRST_DEGREE", 'FIRST_DEGREE');
define("SECOND_DEGREE", 'SECOND_DEGREE');
define("THIRD_DEGREE", 'THIRD_DEGREE');
define("STRANGER", 'STRANGER');
define("NAMELESS", 'NAMELESS');


class Stage1Form extends Model{
    public $user_id;
    public $friend_id;
    public $name;
    public $score;
    public $degree;

    public function __construct($degree){
        parent::__construct();

        $this->user_id  = Yii::$app->user->getId();
        $this->degree = $degree;
        if($degree == FIRST_DEGREE){
            $this->friend_id = Relation::searchFirstDegree($this->user_id);
        }
        else if($degree == SECOND_DEGREE){
            $this->friend_id = Relation::searchSecondDegree($this->user_id);
        }
        else if($degree == THIRD_DEGREE){

            $this->friend_id = Relation::searchThirdDegree($this->user_id);
        }
        else if($degree == STRANGER){

            $this->friend_id = Relation::searchStranger($this->user_id);

        }
        else if($degree == NAMELESS){

            $firstdegreeid = Relation::searchFirstDegree($this->user_id);
            $seconddegreeid = Relation::searchSecondDegree($this->user_id);
            $thirddegreeid = Relation::searchThirdDegree($this->user_id);
            $strangerid = Relation::searchStranger($this->user_id);

            $this->friend_id = Relation::searchNameless($this->user_id, $firstdegreeid,
                $seconddegreeid, $thirddegreeid,
                $strangerid);

        }
        else{
            $message = $degree. " NOT FOUND";
            $this->render('../site/error', ['message' => $message]);
        }

        $this->name = User::retrieveName($this->friend_id);


    }
    public function rules(){

        return [
                [['user_id', 'friend_id'], 'integer'],
                [['name', 'degree'],'string'],
                ['score', 'required', 'when' => function($model){
                    return $this->friend_id != null;
                }, 'enableClientValidation' => false],
        ];
    }

    public function store(){
        if($this->validate()) {
            //First degree
            $first = StageOne::find()->where(['id' => $this->user_id, 'target_id' => $this->friend_id, 'remark' => $this->degree])->one();
            if ($first != null) {
                $first->score = $this->score;

                if (!$first->update()) {

                    return false;
                }
            }
            return true;
        }
        else{

            return null;
        }
    }



}