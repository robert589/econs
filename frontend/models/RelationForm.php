<?php

namespace frontend\models;

use frontend\models\Relation;
use yii\base\Model;
use Yii;

class RelationForm extends Model{
    //user
	public $user_id;

    //relation 0
	public $user_friend_id_0;
	public $closeness_0;
	public $known_for_0;
    //relation 1
    public $user_friend_id_1;
    public $closeness_1;
    public $known_for_1;

    //relation 2
    public $user_friend_id_2;
    public $closeness_2;
    public $known_for_2;

    //relation 3
    public $user_friend_id_3;
    public $closeness_3;
    public $known_for_3;
    
    //relation 4
    public $user_friend_id_4;
    public $closeness_4;
    public $known_for_4;

    //relation 5
    public $user_friend_id_5;
    public $closeness_5;
    public $known_for_5;
    public $enabled_5;

    //relation 6
    public $user_friend_id_6;
    public $closeness_6;
    public $known_for_6;
    public $enabled_6;
    //relation 7    
    public $user_friend_id_7;
    public $closeness_7;
    public $known_for_7;
    public $enabled_7;
    //relation 8
    public $user_friend_id_8;
    public $closeness_8;
    public $known_for_8;
    public $enabled_8;

    //relation 9
    public $user_friend_id_9;
    public $closeness_9;
    public $known_for_9;
    public $enabled_9;

    public $command;


	 public function rules(){
    	return [
    		[[ 'user_friend_id_0', 'closeness_0', 'known_for_0'], 'required'],
            [[ 'user_friend_id_1', 'closeness_1', 'known_for_1'], 'required'],
            [[ 'user_friend_id_2', 'closeness_2', 'known_for_2'], 'required'],
            [[ 'user_friend_id_3', 'closeness_3', 'known_for_3'], 'required'],
            [[ 'user_friend_id_4', 'closeness_4', 'known_for_4'], 'required'],
            
            [[ 'user_friend_id_5', 'closeness_5', 'known_for_5'], 'required', 'when' => function($model){return $model->enabled_5;}, 'enableClientValidation' => false],
            [[ 'user_friend_id_6', 'closeness_6', 'known_for_6'], 'required', 'when' => function($model){return $model->enabled_6;}, 'enableClientValidation' => false],
            [[ 'user_friend_id_7', 'closeness_7', 'known_for_7'], 'required', 'when' => function($model){return $model->enabled_7;}, 'enableClientValidation' => false],
            [[ 'user_friend_id_8', 'closeness_8', 'known_for_8'], 'required', 'when' => function($model){return $model->enabled_8;}, 'enableClientValidation' => false],
            [[ 'user_friend_id_9', 'closeness_9', 'known_for_9'], 'required', 'when' => function($model){return $model->enabled_9;}, 'enableClientValidation' => false],

            ['user_friend_id_0',  function($attributes, $params){$this->checkUnique($attributes, $params, 0, $this->user_friend_id_0);}],
            ['user_friend_id_1', function($attributes, $params){$this->checkUnique($attributes, $params, 1, $this->user_friend_id_1);}],
            ['user_friend_id_2', function($attributes, $params){$this->checkUnique($attributes, $params, 2, $this->user_friend_id_2);}],
            ['user_friend_id_3', function($attributes, $params){$this->checkUnique($attributes, $params, 3, $this->user_friend_id_3);}],
            ['user_friend_id_4', function($attributes, $params){$this->checkUnique($attributes, $params, 4, $this->user_friend_id_4);}],
            ['user_friend_id_5', function($attributes, $params){$this->checkUnique($attributes, $params, 5, $this->user_friend_id_5);}],
            ['user_friend_id_6', function($attributes, $params){$this->checkUnique($attributes, $params, 6, $this->user_friend_id_6);}],
            ['user_friend_id_7', function($attributes, $params){$this->checkUnique($attributes, $params, 7, $this->user_friend_id_7);}],
    	    ['user_friend_id_9', function($attributes, $params){$this->checkUnique($attributes, $params, 8, $this->user_friend_id_8);}],
            ['user_friend_id_9', function($attributes, $params){$this->checkUnique($attributes, $params, 9, $this->user_friend_id_9);}],

            [['enabled_5','enabled_6','enabled_7','enabled_8','enabled_9'], 'integer'],
        ];
    }

    /**
    **Use eval() which is very dangerous, rigorous testing needed
    */
    public function checkUnique($attributes, $params,$index, $value){
              //check which value is the same one

        if($this->getEnabled($index)){
            for($i = 0; $i < 10 ; $i++){
                if($index != $i){       
                    if( ($value == $this->getValueFriendId($i)) && $this->getEnabled($i)){
                        Yii::trace("index: $index , $value equals".  $this->getValueFriendId($i));
                        $duplicated = $i + 1;
                        $this->addError($attributes, "There is a duplicate of this name");
                    }
                }
            }
        }
    }

    public function getValueFriendId($index){
        switch($index){
            case 0: return  $this->user_friend_id_0;
            case 1: return  $this->user_friend_id_1;
            case 2: return  $this->user_friend_id_2;
            case 3: return  $this->user_friend_id_3;
            case 4: return  $this->user_friend_id_4;
            case 5: return  $this->user_friend_id_5;
            case 6: return  $this->user_friend_id_6;
            case 7: return  $this->user_friend_id_7;
            case 8: return  $this->user_friend_id_8;
            case 9: return  $this->user_friend_id_9;
            default: return null;
        }

        return null;
    }

    public function getEnabled($index){
        switch($index){
            case 0: return  1;
            case 1: return  1;
            case 2: return  1;
            case 3: return  1;
            case 4: return  1;
            case 5: return  $this->enabled_5;
            case 6: return  $this->enabled_6;
            case 7: return  $this->enabled_7;
            case 8: return  $this->enabled_8;
            case 9: return  $this->enabled_9;
            default: return null;
        }

        return null;
    }

    public function store(){
    	if($this->validate()){

             if($this->checkExist()){
                if(!$this->deleteAll(Yii::$app->user->getId())){
                    return null;
                }
             }

             $count = 0;

             $relation = new Relation();
             $relation->user_id = Yii::$app->user->getId();

             $relation->user_friend_id = $this->user_friend_id_0;
             $relation->closeness = $this->closeness_0;
             $relation->known_for = $this->known_for_0;
              if($relation->save()){
                $count++;
              }
              else{
                return null;
              }
              
             $relation = new Relation();
             $relation->user_id = Yii::$app->user->getId();
             $relation->user_friend_id = $this->user_friend_id_1;
             $relation->closeness = $this->closeness_1;
             $relation->known_for = $this->known_for_1;
             if($relation->save()){
               $count++;
             }
             else{
               return null;
             }
                      
            $relation = new Relation();
            $relation->user_id = Yii::$app->user->getId();
            $relation->user_friend_id = $this->user_friend_id_2;
            $relation->closeness = $this->closeness_2;
            $relation->known_for = $this->known_for_2;
            if($relation->save()){
              $count++;
            }
            else{
              return null;
            }
          
            $relation = new Relation();
            $relation->user_id = Yii::$app->user->getId();
            $relation->user_friend_id = $this->user_friend_id_3;
            $relation->closeness = $this->closeness_3;
            $relation->known_for = $this->known_for_3;
            if($relation->save()){
              $count++;
            }
            else{
              return null;
            }
          
            $relation = new Relation();
            $relation->user_id = Yii::$app->user->getId();
            $relation->user_friend_id = $this->user_friend_id_4;
            $relation->closeness = $this->closeness_4;
            $relation->known_for = $this->known_for_4;
            if($relation->save()){
              $count++;
            }
            else{
              return null;
            }
          

            if($this->enabled_5){   
              $relation = new Relation();
              $relation->user_id = Yii::$app->user->getId();
              $relation->user_friend_id = $this->user_friend_id_5;
              $relation->closeness = $this->closeness_5;
              $relation->known_for = $this->known_for_5;
              if($relation->save()){
                $count++;
              }
            }

            if($this->enabled_6){   
              $relation = new Relation();
              $relation->user_id = Yii::$app->user->getId();
              $relation->user_friend_id = $this->user_friend_id_6;
              $relation->closeness = $this->closeness_6;
              $relation->known_for = $this->known_for_6;
              if($relation->save()){
                $count++;
              }
            }

            if($this->enabled_7){   
              $relation = new Relation();
              $relation->user_id = Yii::$app->user->getId();
              $relation->user_friend_id = $this->user_friend_id_7;
              $relation->closeness = $this->closeness_7;
              $relation->known_for = $this->known_for_7;
              if($relation->save()){
                $count++;
              }
            }

            if($this->enabled_8){   
              $relation = new Relation();
              $relation->user_id = Yii::$app->user->getId();
              $relation->user_friend_id = $this->user_friend_id_8;
              $relation->closeness = $this->closeness_8;
              $relation->known_for = $this->known_for_8;
              if($relation->save()){
                $count++;
              }
            }

            if($this->enabled_9){  
              $relation = new Relation();
              $relation->user_id = Yii::$app->user->getId(); 
              $relation->user_friend_id = $this->user_friend_id_9;
              $relation->closeness = $this->closeness_9;
              $relation->known_for = $this->known_for_9;
              if($relation->save()){
                $count++;
              }
            }
    		

    		return $count;
    	}

    	return null;
    }


    private function checkExist(){
        $user_id = Yii::$app->user->getId();
        return Relation::find()->where(['user_id' => $user_id ])->exists();
    }

    private function deleteAll($user_id){
        return Relation::deleteAll('user_id = ' . $user_id);
    }
}