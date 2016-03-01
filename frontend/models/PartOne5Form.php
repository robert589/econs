<?php

namespace frontend\models;

use yii\base\model;
use common\models\Happiness;
use yii;

class PartOne5Form extends Model{
    public $_365_baht;
    public $_350_baht;
    public $_314_baht;
    public $_273_baht;
    public $_250_baht;
    public $_221_baht;
    public $_154_baht;
    public $_57_baht;
    public $_32_baht;
    public $_5_baht;


    public function rules(){
        return [
            [ ['_365_baht','_350_baht','_314_baht','_273_baht','_250_baht',
                '_221_baht','_154_baht','_57_baht','_32_baht', '_5_baht'], 'required'  ]
        ];
    }

    public function store(){
        if($this->validate()){
            $user_id = Yii::$app->user->getId();
            if($this->checkExist() == true){
                $user_pref = Preference::find()->where(['user_id' => $user_id])->one();
                $user_pref = $this->keyInData($user_pref);
                if($user_pref->update()){
                    return true;
                }
                return null;
            }
            else{
                $user_pref = new Preference();
                $user_pref->user_id = $user_id;
                $user_pref = $this->keyInData($user_pref);
                if($user_pref->save()){
                    return true;
                }
                return null;
            }
        }

        return null;
    }

    private function checkExist(){
        $user_id = Yii::$app->user->getId();

        return  Preference::find()->where(['user_id' => $user_id])->exists();
    }

    private function keyInData($user_pref){
        $user_pref->_365_baht = $this->_365_baht;
        $user_pref->_350_baht = $this->_350_baht;
        $user_pref->_314_baht = $this->_314_baht;
        $user_pref->_273_baht = $this->_273_baht;
        $user_pref->_250_baht = $this->_250_baht;
        $user_pref->_221_baht = $this->_221_baht;
        $user_pref->_154_baht = $this->_154_baht;
        $user_pref->_57_baht = $this->_57_baht;
        $user_pref->_32_baht = $this->_32_baht;
        $user_pref->_5_baht = $this->_5_baht;

        return $user_pref;
    }
}