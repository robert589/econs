<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use Yii;



class StageOne extends ActiveRecord{

    const FIRST_DEGREE = "FIRST_DEGREE";
    const SECOND_DEGREE = "SECOND_DEGREE";
    const THIRD_DEGREE = "THIRD_DEGREE";
    const NAMELESS = "NAMELESS";
    const STRANGER = "STRANGER";

	public static function tableName()
    {
        return 'stageone';
    }

    public static function checkExist($user_id, $remark){
        return Self::find()->where(['id' => $user_id, 'remark'=> $remark])->exists();
    }

    public static  function getExistingFriend($user_id, $remark){
        return Self::find()->where(['id' => $user_id, 'remark' => $remark])->one()['target_id'];
    }

    public static function getFriend($user_id, $remark){

        $connection = \Yii::$app->getDb();
        if(StageTwo::checkExist($user_id, $remark)){
            $command = $connection->createCommand("
                    
                    SELECT stageone.id, score, user.name as name
                    FROM stagetwo, stageone, user
                    where stagetwo.user_id = $user_id and stagetwo.user_friend_id = user.id 
                    and stagetwo.remark = $remark and stagetwo.user_id = stageone.target_id 
                    and stagetwo.user_friend_id = stageone.id
            
                    order by rand() limit 0,1
                ");

            $friend =  $command->queryOne();
        }
        else{
        
            $command = $connection->createCommand("
                    
                    SELECT stageone.id as id, score, user.name as name
                    FROM user, stageone
                    where stageone.id = user.id and stageone.target_id = $user_id
            
                    order by rand() limit 0,1
                ");

            $friend =  $command->queryOne();

            if($friend != null){
                $command = $connection->createCommand()->insert('stagetwo',
                    [
                        'user_id' => $user_id,
                        'user_friend_id' => $friend['id'],
                        'remark' => $remark
                    ])->execute();
            }         
                 
        }
        return $friend;
    }

    public static function retrieveAllBySql()
    {
        return "SELECT s1.*, u1.name as user_name, u2.name as user_friend_name, adv.score as dice_value
                from stageone s1
                inner join user u1 on s1.id = u1.id
                inner join user u2 on s1.target_id = u2.id
                left join actualdicevalue adv on adv.user_id = s1.id";
    }

    public static function countRetrieveAll(){

         
        $sql =  "SELECT count(*) from (SELECT stageone.*, u1.name as user_name, u2.name as user_friend_name 
                                        from stageone 
                                        inner join user u1 on stageone.id = u1.id 
                                        inner join user u2 on stageone.target_id = u2.id) R";

        $command =  \Yii::$app->db->createCommand($sql)->queryScalar();
        return (int)($command);
    }

    public static function getAllParticipants(){
        $connection = Yii::$app->getDb();

        $sql = "SELECT * FROM
				(
					SELECT distinct id as id from stageone
					union
					SELECT distinct target_id as id from stageone
				) T";

        $ids = $connection->createCommand($sql)->queryAll();

        return $ids;
    }

    public static function generate2DMatrix(){
        $connection = Yii::$app->getDb();

        $ids = Self::getAllParticipants();

        $matrix = array();
        foreach($ids as $id){
            $id = $id['id'];
            $scores = array();
            foreach($ids as $id2){
                //$id2 = $id2[0];
                $id2 = $id2['id'];
                $sql = "SELECT score FROM stageone where id  = $id and target_id = $id2";
                $score =  (int)  $connection->createCommand($sql)->queryOne()['score'];
                $scores[] = $score;
            }
            $matrix[] = $scores;
        }
        return $matrix;
    }

    public static function getTotalPayoffFromStage1($user_id){
        $connection = Yii::$app->getDb();

        $sql = "SELECT COALESCE((SELECT score from stageone where id =:user_id and remark = \"FIRST_DEGREE\"),0) as first_score,
                      coalesce((SELECT score from stageone where id = :user_id and remark = \"SECOND_DEGREE\"),0) as second_score,
                      coalesce((SELECT score from stageone where id = :user_id and remark = \"THIRD_DEGREE\"),0) as third_score,
                      coalesce((SELECT score from stageone where id = :user_id and remark = \"NAMELESS\"),0) as nameless_score,
                      coalesce((SELECT score from stageone where id = :user_id and remark = \"STRANGER\"),0) as stranger_score
               FROM `stageone` WHERE id = :user_id limit 1
             ";

        return $connection->createCommand($sql)
            ->bindParam(":user_id", $user_id)
            ->queryOne();
    }
}