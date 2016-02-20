<?php

namespace frontend\models;

use yii\db\ActiveRecord;


class StageTwo extends ActiveRecord{
	public static function tableName()
    {
        return 'stagetwo';
    }

    public static function checkExist($user_id, $remark = null){
        if(!isset($remark)){
            return Self::find()
                ->where(['user_id' => $user_id])
                ->exists();
        }
        else{
            return Self::find()
                ->where(['user_id'=> $user_id])
                ->andWhere([ 'remark' =>  $remark])
                ->exists();
        }

    }

    /**
     * Retrieve all data from stage 2 include the name o the person and the friend_name
     * @return string
     */
     public static function retrieveAllBySql()
    {
        return "SELECT stagetwo.*, u1.name as user_name, u2.name as user_friend_name
                from stagetwo
                inner join user u1 on stagetwo.user_id = u1.id
                inner join user u2 on stagetwo.user_friend_id = u2.id";
    }

    public static function countRetrieveAll(){

         
        $sql =  "SELECT count(*) from (SELECT stagetwo.*, u1.name as user_name, u2.name as user_friend_name 
                                        from stagetwo 
                                        inner join user u1 on stagetwo.user_id = u1.id 
                                        inner join user u2 on stagetwo.user_friend_id = u2.id) R";

        $command =  \Yii::$app->db->createCommand($sql)->queryScalar();
        return (int)($command);
    }
    
    public static function getRemark($user_id = null){
        if(isset($user_id)){
            if(self::checkExist($user_id)){
                return (int) self::find()->where(['user_id' => $user_id])->one()['remark'];
            }
        }
        else{
            $one = "SELECT count(*) from (SELECT *from stagetwo where remark = 1) One";
            $two = "SELECT count(*) from (SELECT *from stagetwo where remark = 1) Two";
            $three = "SELECT count(*) from (SELECT *from stagetwo where remark = 1) Three";
            $four = "SELECT count(*) from (SELECT *from stagetwo where remark = 1) Four";

            $commandOne = (int)\Yii::$app->db->createCommand($one)->queryScalar();
            $commandTwo = (int)\Yii::$app->db->createCommand($two)->queryScalar();
            $commandThree = (int)\Yii::$app->db->createCommand($three)->queryScalar();
            $commandFour = (int)\Yii::$app->db->createCommand($four)->queryScalar();

            return Self::findMin($commandOne,$commandTwo,$commandThree,$commandFour);
        }


    }   

    private static function findMin($one, $two,$three, $four){
        if($one < $two && $one < $three && $one < $four){
            return 1;
        }
        else if($two < $one && $two < $three && $two < $four){
            return 2;
        }
        else if($three < $one && $three < $two && $three < $four){
            return 3;
        }
        else{

            return 4;
        }
    }

}