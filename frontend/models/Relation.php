<?php

namespace frontend\models;
use yii\db\ActiveRecord;
use Yii;
class Relation extends ActiveRecord{

	public static function tableName()
    {
        return 'relation';
    }



   	public static function retrieveAllBySql()
  	{
  		return "SELECT relation.*, u1.name as user_name, u2.name as user_friend_name 
  				from relation 
				inner join user u1 on relation.user_id = u1.id 
				inner join user u2 on relation.user_friend_id = u2.id";
  	}

  	public static function countRetrieveAll(){

  		 
  		$sql =  "SELECT count(*) from (SELECT relation.*, u1.name as user_name, u2.name as user_friend_name 
  										from relation 
  										inner join user u1 on relation.user_id = u1.id 
  										inner join user u2 on relation.user_friend_id = u2.id) R";

		$command =  \Yii::$app->db->createCommand($sql)->queryScalar();
        return (int)($command);
  	}
 	
	public static function searchFirstDegree($id){
		$connection = Yii::$app->getDb();

        //if exists, return the friend
		if(StageOne::checkExist(\Yii::$app->user->identity->getId(), FIRST_DEGREE)){
            return StageOne::getExistingFriend(\Yii::$app->user->identity->getId(), FIRST_DEGREE);
		}

		$command = $connection->createCommand("
	
				SELECT DISTINCT R.user_id as user_id
				FROM relation R
				where R.user_id in (select R1.user_friend_id 
							   from relation R1 
							   where R1.user_id = $id )
						and
					R.user_id in(select R2.user_id
							from relation R2
							WHERE R2.user_friend_id = $id)
				order by rand() limit 0,1


			");

		$target_id =  $command->queryOne()['user_id'];
        if($target_id == null){
            return null;
        }
        $stageone = new StageOne();
        $stageone->id = \Yii::$app->user->identity->getId();
        $stageone->target_id = $target_id;
        $stageone->remark = FIRST_DEGREE;
        $stageone->score = 0;
        if($stageone->save()){
            return $target_id;
        }
        else{
            return null;
        }
	}


	public static function searchSecondDegree($id){
		$connection = Yii::$app->getDb();

        if(StageOne::checkExist(\Yii::$app->user->identity->getId(), SECOND_DEGREE)){
            return StageOne::getExistingFriend(\Yii::$app->user->identity->getId(), SECOND_DEGREE);
        }

		$command = $connection->createCommand("
			SELECT DISTINCT R.user_id
			FROM relation R
			where R.user_id in (SELECT DISTINCT R2.user_id	
                    FROM  (SELECT DISTINCT R.user_id as user_id 
                             FROM relation R
                             where R.user_id in (select R1.user_friend_id 
                                                 from relation R1 where R1.user_id = $id) and 		            
                                   R.user_id in( select R2.user_id 
                                                 from relation R2 WHERE R2.user_friend_id = $id)) R1, relation R2
                    		WHERE R2.user_friend_id = R1.user_id and R2.user_id in (SELECT R3.user_friend_id
                            		                                                FROM relation r3
                                    		                                        where r3.user_id = r1.user_id) and R2.user_id <> $id)
            order by rand() limit 0,1        
			");

        $target_id =  $command->queryOne()['user_id'];
        if($target_id == null){
            return null;
        }
        $stageone = new StageOne();
        $stageone->id = \Yii::$app->user->identity->getId();
        $stageone->target_id = $target_id;
        $stageone->remark = SECOND_DEGREE;
        $stageone->score = 0;
        if($stageone->save()){
            return $target_id;
        }
        else{
            return null;
        }
    }

	public static function searchThirdDegree($id){
		$connection = Yii::$app->getDb();

        if(StageOne::checkExist(\Yii::$app->user->identity->getId(), THIRD_DEGREE)){
            return StageOne::getExistingFriend(\Yii::$app->user->identity->getId(), THIRD_DEGREE);
        }

		$command = $connection->createCommand("

			SELECT DISTINCT R.user_id
            FROM relation R
            where R.user_id in (
                    SELECT DISTINCT R2.user_id
                    FROM(
                        SELECT DISTINCT R.user_id
                        FROM relation R
                        where R.user_id in (SELECT DISTINCT R2.user_id	
                                            FROM  (SELECT DISTINCT R.user_id as user_id 
                                                     FROM relation R
                                                     where R.user_id in (select R1.user_friend_id 
                                                                         from relation R1 where R1.user_id = $id) and 		            
                                                           R.user_id in( select R2.user_id 
                                                                         from relation R2 WHERE R2.user_friend_id = $id)) R1, 																								relation R2
                                           	 WHERE R2.user_friend_id = R1.user_id and R2.user_id in (SELECT R3.user_friend_id
                                                                                                    FROM relation r3
                                                                                                    where r3.user_id = r1.user_id)
                                                                                and R2.user_id <> $id)
                                            )R1, relation R2
                    WHERE R2.user_friend_id = R1.user_id and R2.user_id in (SELECT R3.user_friend_id
                                                                            from relation r3
                                                                            where r3.user_id  = r1.user_id)
                          and R2.user_id <> $id and R2.user_id not in (SELECT DISTINCT R.user_id as user_id
                                                                        FROM relation R
                                                                        where R.user_id in (select R1.user_friend_id 
                                                                                       from relation R1 
                                                                                       where R1.user_id = $id )
                                                                                and
                                                                            R.user_id in(select R2.user_id
                                                                                    from relation R2
                                                                                    WHERE R2.user_friend_id = $id)
                                                                       )
                    )
            order by rand() limit 0,1
			");

        $target_id =  $command->queryOne()['user_id'];
        if($target_id == null){
            return null;
        }
        $stageone = new StageOne();
        $stageone->id = \Yii::$app->user->identity->getId();
        $stageone->target_id = $target_id;
        $stageone->remark = THIRD_DEGREE;
        $stageone->score = 0;
        if($stageone->save()){
            return $target_id;
        }
        else{
            return null;
        }
    }

	public static function searchStranger($id){
		$connection = Yii::$app->getDb();

        if(StageOne::checkExist(\Yii::$app->user->identity->getId(), STRANGER)){
            return StageOne::getExistingFriend(\Yii::$app->user->identity->getId(), STRANGER);
        }

		$command = $connection->createCommand("
SELECT DISTINCT R.user_id 
FROM relation R
WHERE R.user_id not in
	(SELECT DISTINCT R.user_id as user_id
				FROM relation R
				where R.user_id in (select R1.user_friend_id 
							   from relation R1 
							   where R1.user_id = $id )
						and
					R.user_id in(select R2.user_id
							from relation R2
							WHERE R2.user_friend_id = $id)) and
    R.user_id not in (SELECT DISTINCT R.user_id
			FROM relation R
			where R.user_id in (SELECT DISTINCT R2.user_id	
                    FROM  (SELECT DISTINCT R.user_id as user_id 
                             FROM relation R
                             where R.user_id in (select R1.user_friend_id 
                                                 from relation R1 where R1.user_id = $id) and 		            
                                   R.user_id in( select R2.user_id 
                                                 from relation R2 WHERE R2.user_friend_id = $id)) R1, relation R2
                    		WHERE R2.user_friend_id = R1.user_id and R2.user_id in (SELECT R3.user_friend_id
                            		                                                FROM relation r3
                                    		                                        where r3.user_id = r1.user_id) and R2.user_id <> 	$id)) and
                                                                                    	
    R.user_id not in (SELECT DISTINCT R.user_id
			FROM relation R
			where R.user_id in (SELECT DISTINCT R2.user_id
			                    FROM(
			                        SELECT DISTINCT R.user_id
			                        FROM relation R
			                        where R.user_id in (SELECT DISTINCT R2.user_id	
			                                            FROM  (SELECT DISTINCT R.user_id as user_id 
			                                                     FROM relation R
			                                                     where R.user_id in (select R1.user_friend_id 
			                                                                         from relation R1 where R1.user_id = $id) and 		            
			                                                           R.user_id in( select R2.user_id 
			                                                                         from relation R2 WHERE R2.user_friend_id = $id)) R1, 																								relation R2
			                                           	 WHERE R2.user_friend_id = R1.user_id and R2.user_id in (SELECT R3.user_friend_id
			                                                                                                    FROM relation r3
			                                                                                                    where r3.user_id = r1.user_id)
			                                                                                and R2.user_id <> $id)
			                                            )R1, relation R2
			                    WHERE R2.user_friend_id = R1.user_id and R2.user_id in (SELECT R3.user_friend_id
			                                                                            from relation r3
			                                                                            where r3.user_id  = r1.user_id)
			                          and R2.user_id <> $id and R2.user_id not in (SELECT DISTINCT R.user_id as user_id
			                                                                        FROM relation R
			                                                                        where R.user_id in (select R1.user_friend_id 
			                                                                                       from relation R1 
			                                                                                       where R1.user_id = $id )
			                                                                                and
			                                                                            R.user_id in(select R2.user_id
			                                                                                    from relation R2
			                                                                                    WHERE R2.user_friend_id = $id)
			                                                                       )
			                    )) and R.user_id <> $id
	order by rand() limit 0,1
			");

        $target_id =  $command->queryOne()['user_id'];
        $stageone = new StageOne();
        $stageone->id = \Yii::$app->user->identity->getId();
        $stageone->target_id = $target_id;
        $stageone->remark = STRANGER;
        $stageone->score = 0;
        if($stageone->save()){
            return $target_id;
        }
        else{
            return null;
        }

	}

	public static function searchNameless($id, $firstdegreeid, $seconddegreeid, $thirddegreeid, $strangerid){
		$connection = Yii::$app->getDb();

        if(StageOne::checkExist(\Yii::$app->user->identity->getId(), NAMELESS)){
            return StageOne::getExistingFriend(\Yii::$app->user->identity->getId(), NAMELESS);
        }

        if($firstdegreeid == null){
			$firstdegreeid = 0;
		}
		if($seconddegreeid == null){
			$seconddegreeid = 0;
		}
		if($thirddegreeid == null){
			$thirddegreeid = 0;
		}
		if($strangerid == null){
			$strangerid = 0;
		}
		$command = $connection->createCommand("
	
				SELECT R.user_id as user_id
				FROM relation R
				where R.user_id <> $id and R.user_id <> $firstdegreeid 
				and R.user_id <> $seconddegreeid and R.user_id <> $thirddegreeid
				and R.user_id <> $strangerid
				order by rand() limit 0,1
			");

        $target_id =  $command->queryOne()['user_id'];
        $stageone = new StageOne();
        $stageone->id = \Yii::$app->user->identity->getId();
        $stageone->target_id = $target_id;
        $stageone->remark = NAMELESS;
        $stageone->score = 0;
        if($stageone->save()){
            return $target_id;
        }
        else{
            return null;
        }
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
                $sql = "SELECT closeness FROM relation where user_id  = $id and user_friend_id = $id2";
                $score =  (int)  $connection->createCommand($sql)->queryOne()['closeness'];
                $scores[] = $score;
            }
            $matrix[] = $scores;
        }
        return $matrix;
	}

    public static function getAllParticipants(){
        $connection = Yii::$app->getDb();

        $sql = "SELECT * FROM
				(
					SELECT distinct user_id as id from relation
					union
					SELECT distinct user_friend_id as id from relation
				) T";

        $ids = $connection->createCommand($sql)->queryAll();

        return $ids;
    }

    public static function getMatchedFriends($user_id){
        $sql = "SELECT count(distinct user_id) as total_matched_friends
                FROM relation R
                where R.user_id in (select R1.user_friend_id from relation R1 where R1.user_id = :user_id )
                and R.user_id in(select R2.user_id from relation R2 WHERE R2.user_friend_id = :user_id)";

        $result =  \Yii::$app->db->createCommand($sql)->
                    bindParam(':user_id', $user_id)->
                    queryOne();

     return (int)$result['total_matched_friends'];



    }
}