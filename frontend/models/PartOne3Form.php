<?php

namespace frontend\models;

use yii\base\model;
use frontend\models\Character;
use yii;

class PartOne3Form extends Model{
	public $optimistic;
	public $extroverted;
	public $confident;
	public $outgoing;

	public function rules(){
		return [
			[ ['optimistic', 'extroverted', 'confident', 'outgoing'], 'required'  ]
		];
	}

	public function store(){
		if($this->validate()){
			if($this->checkExist()){
				$user_id = Yii::$app->user->getId();

				$character = Character::find()->where(['id' => $user_id ])->one();
				$character->id = $user_id;

				$character = $this->keyInData($character);

				if($character->update()){
					return true;
				}

				return null;
			}
			else{
				$character = new Character();
				$character->id = Yii::$app->user->getId();

				$character = $this->keyInData($character);

				if($character->save()){
					return $character;
				}

				return null;
			}
		}

		return null;
	}

	private function checkExist(){
		$user_id  = Yii::$app->user->getId();
		return Character::find()->where(['id' => $user_id])->exists();
	}

	private function keyInData($character){
		$character->optimistic = $this->optimistic;
		$character->extroverted =$this->extroverted;
		$character->confident = $this->confident;
		$character->outgoing = $this->outgoing;

		return $character;
	}
}