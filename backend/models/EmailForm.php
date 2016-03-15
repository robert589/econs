<?php

namespace backend\models;

use yii\base\model;
use common\models\User;
use yii;

class EmailForm extends Model{
    public $title;
    public $description;
    public $email;

    public function rules(){
        return [
            ['email', 'email'],
            [['title','description'], 'string'],

            [['title','description'], 'required']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function sendMail()
    {
        if ($this->validate()) {
            $messages = [];

            $users = User::retrieveAll();
            foreach ($users as $user) {
                $password = User::decryptIt($user['password_hash']);

                $tempDescription = $this->description;
                $tempDescription = str_replace(':username', $user['username'], $tempDescription);
                $tempDescription = str_replace(':password', $password, $tempDescription);
                $tempDescription = str_replace(':name', $user['name'], $tempDescription);

                $email = $user['email'];

                $messages[] = Yii::$app->mailer->compose()
                    ->setTo($email)
                    ->setFrom('survey@expernomics.com')
                    ->setSubject($this->title)
                    ->setTextBody($tempDescription);
            }
            Yii::$app->mailer->sendMultiple($messages);

            return true;

        }

        return null;
    }

    public function sendOne(){
        if($this->validate()){
            $user = User::findOne(['email' => $this->email]);
            $email = $user['email'];

            $password = User::decryptIt($user['password_hash']);
            $this->description = str_replace(':username', $user['username'], $this->description);
            $this->description = str_replace(':name', $user['name'], $this->description);
            $this->description = str_replace(':password', $password, $this->description);

            $messages = Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom('survey@expernomics.com')
                ->setSubject($this->title)
                ->setTextBody($this->description);

            Yii::$app->mailer->send($messages);

            return true;
        }
    }



}