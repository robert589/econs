<?php
namespace frontend\models;

use common\models\UserInfo;
use yii\base\Model;
use common\models\User;
use Yii;


class Stage2Form extends Model{
	public $answer;

	public $personid;

	public $personname;

	public $personscore;

	public $title;
	
	public $remark;

	public function rules(){
		return [
			 ['answer', 'required' ],
			['answer', 'boolean'],
			[['personname',  'title','remark'], 'string'],
			[['personid', 'personscore'],'integer']

		];
	}

	public function store(){
			$model = StageTwo::findOne(['user_friend_id' => $this->personid,
				'user_id' => \Yii::$app->user->getId(),
				'remark' => $this->remark]);

			//Yii::$app->end(print_r($model));

			if($model->answer == $this->answer){
				return true;
			}
			else{
				$model->answer  = $this->answer;

			}

			if( $model->update()){
				//Yii::$app->end();
				return true;
			}
			else{
				Yii::$app->end("Fail");
			}

	}
}