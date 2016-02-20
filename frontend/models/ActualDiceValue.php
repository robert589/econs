<?php

namespace frontend\models;

use yii\db\ActiveRecord;


class ActualDiceValue extends ActiveRecord{
  	public static function tableName()
    {
        return 'actualdicevalue';
    }

  	public function checkExist(){
        return $this->find()->where(['user_id' => $this->user_id])->exists() ;
    }

    public function getDiceValue(){
        return $this->find()->where(['user_id' => $this->user_id])->one()['score'];
    }
}