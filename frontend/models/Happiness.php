<?php

namespace frontend\models;

use yii\db\ActiveRecord;


class Happiness extends ActiveRecord{
	public static function tableName()
    {
        return 'happiness';
    }

    public static function retrieveAllBySql()
  	{
  		return "SELECT happiness.*, u1.name as user_name from happiness inner join user u1 on happiness.id = u1.id";
  	}

  	public static function countRetrieveAll(){

  		 
  		$sql =  "SELECT count(*) from (SELECT happiness.*, u1.name as user_name from happiness inner join user u1 on happiness.id = u1.id) R";

		$command =  \Yii::$app->db->createCommand($sql)->queryScalar();
        return (int)($command);
  	}
}