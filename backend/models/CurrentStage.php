<?php

namespace backend\models;

use yii\db\ActiveRecord;


class CurrentStage extends ActiveRecord{

    const PART_ONE = 1;
    const PART_TWO_STAGE_ONE  =2;
    const PART_TWO_STAGE_TWO = 3;
    const REPORT = 4;
    public static function tableName()
    {
        return 'current_stage';
    }

    public static function getCurrentStage(){
        return Self::find()->where(['current' => 1])->one()['stage'];
    }

    public static function updateStage($new_stage){

        //set to 0 the old stage
        $old_stage  = Self::find()->where(['current' => 1])->one();
        $old_stage->current = 0;
        if(!$old_stage->update()){
            return null;
        }

        //set the new stage to 1
        $current_stage = Self::find()->where(['stage' => $new_stage])->one();
        $current_stage->current = 1;
        if($current_stage->update()){
            return true;
        }
        else{
            return null;
        }
    }

}