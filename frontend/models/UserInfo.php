<?php
namespace frontend\models;
use yii\db\ActiveRecord;
use yii;

class UserInfo extends ActiveRecord{

	public static function tableName()
    {
        return 'user_info';
    }


    public function checkCGPA(){

    	$id =	Yii::$app->user->getId();

		$sql = "SELECT `id` FROM `user_info` WHERE (`id`=1308) AND
				abs(user_info.`your_cgpa`- $this->your_cgpa) <0.01 ";

		$connection = Yii::$app->getDb();

		return $connection->createCommand($sql)->queryOne();


    }

    
    
}