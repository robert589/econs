<?php

namespace common\models;

use yii\db\ActiveRecord;


class Character extends ActiveRecord{
    public static function tableName()
    {
        return 'user_character';
    }

    public static function retrieveAllBySql()
    {
        return "SELECT user_character.*, u1.name as user_name from user_character inner join user u1 on user_character.id = u1.id";
    }

    public static function countRetrieveAll(){


        $sql =  "SELECT count(*) from (SELECT user_character.*, u1.name as user_name from user_character inner join user u1 on user_character.id = u1.id) R";

        $command =  \Yii::$app->db->createCommand($sql)->queryScalar();
        return (int)($command);
    }


}