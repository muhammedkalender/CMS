<?php

require_once 'core/Database.php';

class UserController
{
    //todo
    public $id, $email, $fistName, $lastName, $isAdmin, $isAuthor;

    public function register(){
        //todo
    }

    public function login($userName, $password){
        global $database;

        $suffix = $database->first('SELECT suffix FROM users WHERE user_email = "'.$userName.'" AND is_deleted = 0');

        if($suffix->data == null){
            //todo user yok
        }

        $encryptedPassword = self::encryptPassword($password, $suffix->data);

        $user = $database->first('SELECT * FROM users WHERE user_email = "'.$userName.'" AND user_password = "'.$password.'" is_deleted = 0');

        if($user->data == null){
            //todo kullanıcı adı ve şifre
        }

        //todo session, token ?

        $user = $user->data;

        $this->id = $user['user_id'];
        $this->email = $user['user_email'];
        $this->fistName = $user['user_first_name'];
        $this->lastName = $user['user_last_name'];
        $this->isAdmin = $user['user_is_admin'];
        $this->isAuthor = $user['user_is_author'];

        return new Output(null, $this);
    }
}