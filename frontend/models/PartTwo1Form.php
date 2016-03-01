<?php
namespace frontend\models;

use common\models\UserInfo;
use yii\base\Model;
use Yii;


class PartTwo1Form extends Model{
	public $cgpa;

	public function rules(){
		return [['cgpa', 'required', 'enableClientValidation' => true]];
	}

	public function check(){
		if($this->validate()){
			$user = new UserInfo();
			$user->your_cgpa = $this->cgpa;
			
			return $user->checkCGPA();
		}
		return null;
	}
}