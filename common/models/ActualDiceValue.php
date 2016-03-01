<?php

namespace common\models;

use yii\db\ActiveRecord;


class ActualDiceValue extends ActiveRecord{
    public static function tableName()
    {
        return 'actualdicevalue';
    }

    public static function checkExist($user_id){
        return self::find()->where(['user_id' => $user_id])->exists() ;
    }

    public static function getDiceValue($user_id){
        return self::find()->where(['user_id' => $user_id])->one()['score'];
    }
}