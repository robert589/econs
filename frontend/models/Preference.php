<?php
namespace frontend\models;
use yii\db\ActiveRecord;
use yii;

class Preference extends ActiveRecord{

    public static function tableName()
    {
        return 'preference';
    }




}