<?php

namespace frontend\models;

use yii\base\model;
use common\models\Happiness;
use yii;

class PartOne4Form extends Model{
	public $happiness;
	public $comhappiness;
	public $careless;
	public $secretive;

	public function rules(){
		return [
			[ ['happiness', 'comhappiness', 'careless', 'secretive'], 'required'  ]
		];
	}

	public function store(){
		if($this->validate()){
			$happiness = new Happiness();
			$happiness->id = Yii::$app->user->getId();

			$happiness->happiness = $this->happiness;
			$happiness->comhappiness =$this->comhappiness;
			$happiness->careless = $this->careless;
			$happiness->secretive = $this->secretive;

			if($happiness->save()){
				return $happiness;
			}

			return null;
		}

		return null;
	}
}