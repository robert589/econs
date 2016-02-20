<?php
namespace frontend\models;

use frontend\models\UserInfo;
use yii\base\Model;
use common\models\User;
use Yii;

define("FIRST_DEGREE", 'FIRST_DEGREE');
define("SECOND_DEGREE", 'SECOND_DEGREE');
define("THIRD_DEGREE", 'THIRD_DEGREE');
define("STRANGER", 'STRANGER');
define("NAMELESS", 'NAMELESS');


class Stage1FormUnused extends Model{
	public $user_id;
	public $user_dice_roll;

	public $firstdegreeid;
	public $firstdegreename;
	public $firstdegreescore;

	public $seconddegreeid;
	public $seconddegreename;
	public $seconddegreescore;

	public $thirddegreeid;
	public $thirddegreename;
	public $thirddegreescore;


	public $strangerid;
	public $strangername;
	public $strangerscore;

	public $namelessid;
	public $namelessname;
	public $namelessscore;

	public function __construct(){
		parent::__construct();

		$this->user_id  = Yii::$app->user->getId();

		$this->firstdegreeid = Relation::searchFirstDegree($this->user_id);
		$this->firstdegreename = User::retrieveName($this->firstdegreeid);
		Yii::trace($this->firstdegreeid);
		$this->seconddegreeid = Relation::searchSecondDegree($this->user_id);
		$this->seconddegreename = User::retrieveName($this->seconddegreeid);

		Yii::trace($this->seconddegreeid);

		$this->thirddegreeid = Relation::searchThirdDegree($this->user_id);
		$this->thirddegreename = User::retrieveName($this->thirddegreeid);

		$this->strangerid = Relation::searchStranger($this->user_id);
		$this->strangername = User::retrieveName($this->strangerid);

		$this->namelessid = Relation::searchNameless($this->user_id, $this->firstdegreeid,
													$this->seconddegreeid, $this->thirddegreeid,
													$this->strangerid);
		$this->namelessname = User::retrieveName($this->namelessid);



	}
	public function rules(){

		return [ ['firstdegreescore', 'required', 'when' => function($model){
						return $this->firstdegreeid != null;
				}, 'enableClientValidation' => false],
				['seconddegreescore', 'required', 'when' => function($model){
					return $this->seconddegreeid != null;
				},'enableClientValidation' => false],
				['thirddegreescore', 'required', 'when' => function($model){
					return $this->thirddegreeid != null;
				},'enableClientValidation' => false],
				['strangerscore', 'required', 'when' => function($model){
					return $this->strangerid != null;
				},'enableClientValidation' => false],
				['namelessscore', 'required', 'when' => function($model){
					return $this->namelessid != null;
				},'enableClientValidation' => false]];
	}

	public function store(){
		if($this->validate()){
            //First degree
	    	$first = StageOne::find()->where(['id' => $this->user_id, 'target_id' => $this->firstdegreeid, 'remark' => FIRST_DEGREE])->one();
			if($first != null ){
                $first->score = $this->firstdegreescore;

				if(!$first->update()){
					return false;
				}
			}


            //SECOND DEGREE FRIEND
			$second = StageOne::find()->where(['id' => $this->user_id, 'target_id' => $this->seconddegreeid, 'remark' => SECOND_DEGREE])->one();

    		if($second != null){
                $second->score = $this->seconddegreescore;

				if(!$second->update()){
					return false;
				}
			}

            //THIRD DEGREE FRIEND
			$third = StageOne::find()->where(['id' => $this->user_id, 'target_id' => $this->thirddegreeid, 'remark' => THIRD_DEGREE])->one();


			if($third != null ){
                $third->score = $this->thirddegreescore;
				if(!$third->update()){
					return false;
				}
			}

            //STRANGER FRIEND

			$stranger = StageOne::find()->where(['id' => $this->user_id, 'target_id' => $this->strangerid, 'remark' => STRANGER])->one();
			if($stranger != null ){
                $stranger->score = $this->strangerscore;

                if(!$stranger->update()){
					return false;
				}
			}

            //NAMELESS
			$nameless = StageOne::find()->where(['id' => $this->user_id, 'target_id' => $this->namelessid, 'remark' => NAMELESS])->one();
			if($nameless != null ){
                $nameless->score = $this->namelessscore;

                if(!$nameless->update()){
					return false;
				}
			}

			return true;
		}	

		return null;
	}

	

}