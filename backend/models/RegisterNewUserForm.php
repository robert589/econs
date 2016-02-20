<?php

namespace backend\models;

use yii\base\model;
use common\models\User;
use yii;

class RegisterNewUserForm extends Model{
    public $email;
    public $name;
    public $password;
    public $username;


    public function rules(){
        return [
            [[ 'email', 'name', 'password','username'], 'required'],
            ['email', function($attributes, $params){$this->checkEmailExist($attributes);}],
            ['username', function($attributes, $params){$this->checkUsernameExist($attributes);}]

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->name = $this->name;
            $user->username = $this->username;
            $user->email =  $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }


    private function checkEmailExist($attributes){
        if(User::find()->where(['email' => $this->email])->exists()){

            $this->addError($attributes, "Email already exists");
        }
    }

    private function checkUsernameExist($attributes){
        if(User::find()->where(['username' => $this->username])->exists()){
            $this->addError($attributes, "Username already exists");
        }
    }


}