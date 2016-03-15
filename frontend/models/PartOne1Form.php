<?php 

namespace frontend\models;

use common\models\UserInfo;
use common\models\User;

use yii\base\Model;
use Yii;

class PartOne1Form extends Model{
	public $id;
	public $confirm_identity;
	public $gender;
	public $course;
	public $year_of_birth;
	public $year_of_study;
	public $user_prior_school;
	public $user_height;
	public $user_weight;
	public $num_of_sibling;
	public $your_cgpa;
	public $user_money_received;
	public $work_part_time;
	public $hour_week;
	public $part_time_rate;
	public $volunteer_activity;
	public $hobbies;
	public $other_hobbies;
	public $user_cca;
	public $user_first_language;
	public $user_hall;
	public $hall_number;
	public $trust_choice;

	//For validation only

	public function setId($id){
		$this->id = $id;
	}

	public function incrementStatus(){
		return User::incrementStatus();
	}

	public function rules(){
		return [
			[ ['id', 'gender', 'course', 'year_of_birth', 'year_of_study'
			, 'user_height', 'user_weight', 'num_of_sibling', 'your_cgpa', 'user_money_received',
			'work_part_time', 'volunteer_activity', 'hobbies', 'user_first_language', 'user_hall', 'trust_choice'], 'required'  ],
			//Integer
			['year_of_birth', 'integer', 'max' => 2010, 'min' => 1900],
			//JC, and cca
			[['user_cca', 'user_prior_school'], 'string'],
			//Gpa is a double from 0 to 5
			['your_cgpa', 'double', 'max' => 5, 'min' => 0],
			//num _of sibling, user_height, user_weight must be more than or equal to 0
			['num_of_sibling', 'integer', 'min' => 0],
			['user_height', 'integer', 'min' => 0],
			['user_weight', 'integer', 'min' => 0],
			//All fields are string
			['trust_choice', 'string'],

			['hour_week', 'required' , 'when' => function($model){
				return $this->work_part_time == 1;
			}, 'whenClient' => "function (attribute, value) {
							console.log($('#partone1form-user_hall').find(\":selected\").val());

				return $('#partone1form-work_part_time').find(\":selected\").val() == 1;
			}"],

			['part_time_rate', 'required' , 'when' => function($model){
				return $this->work_part_time == 1;
			}, 'whenClient' => "function (attribute, value) {
							console.log($('#partone1form-user_hall').find(\":selected\").val());

				return $('#partone1form-work_part_time').find(\":selected\").val() == 1;
			}"],

			['hall_number', 'required' , 'when' => function($model){
				return $this->user_hall === 1;
			}, 'whenClient' => "function (attribute, value) {
				return $('#partone1form-user_hall').find(\":selected\").val() == 1;
			}"],

			['other_hobbies', 'required', 'when' => function($model){
				return $this->hobbies == 'Others';
			}, 'whenClient' => "function (attribute, value) {
				return $('#partone1form-hobbies').find(\":selected\").val() == 'Others';
			}"],

			['confirm_identity', function($attributes, $params){ if($this->confirm_identity == 0 || $this->confirm_identity == false){
				$this->addError($attributes, 'You need to confirm your identity');
			}}]
		];
	}

	public function validateHobbies(){
		if($this->hobbies == null){
			$this->addError("Hobbies must not be filled blank");
		} 
	}



	public function store(){

		if($this->validate()){

			if($this->checkExist()){
				$user_info = UserInfo::findOne(['id' => $this->id]);
				$user_info->id = $this->id;
				$user_info = $this->keyInData($user_info);

				if($user_info->update()){
					return true;
				}
				else{
					return null;
				}
			}
			else{
				$user_info = new UserInfo();
				$user_info->id = $this->id;
				$user_info = $this->keyInData($user_info);



				if($user_info->save()){
					//	echo 'hello';
					return $user_info;
				}
			}


			return null;
		}




		return null;
	}

	private function checkExist(){
		return UserInfo::find()->where(['id' => $this->id])->exists();
	}

	private function keyInData($user_info){

//			$user_info->$username($this->username);
		$user_info->gender= $this->gender;
		$user_info->course=$this->course;
		$user_info->year_of_birth=$this->year_of_birth;
		$user_info->year_of_study=$this->year_of_study;
		$user_info->user_prior_school=$this->user_prior_school;
		$user_info->user_height=$this->user_height;
		$user_info->user_weight=$this->user_weight;
		$user_info->num_of_sibling=$this->num_of_sibling;
		$user_info->your_cgpa=$this->your_cgpa;
		$user_info->user_money_received=$this->user_money_received;
		$user_info->work_part_time=$this->work_part_time;
		$user_info->hour_week=$this->hour_week;
		$user_info->part_time_rate=$this->part_time_rate;
		$user_info->volunteer_activity=$this->volunteer_activity;
		$user_info->hobbies=$this->hobbies;
		$user_info->other_hobbies=$this->other_hobbies;
		$user_info->user_cca=$this->user_cca;
		$user_info->user_first_language=$this->user_first_language;
		$user_info->user_hall=$this->user_hall;
		$user_info->hall_number=$this->hall_number;
		$user_info->trust_choice = $this->trust_choice;
		return $user_info;
	}
}