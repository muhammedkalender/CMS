<?php

require_once 'core/Database.php';

class UserObject
{
    const PERM_GROUP_VISITOR = 0, PERM_GROUP_USER = 1, PERM_GROUP_ADMIN = 9;

    const
        //Gerekeb min permi belirler
        PERM_IS = 0,
        //Ek olarak id verilir, user id farklısa false döner
        PERM_SELF = 1,
        //Şu veya daha üstü demektir
        PERM_UPPER = 2,
        //Kendisi veya daha yükseği demek
        PERM_SELF_OR_UPPER = 3;

    //todo
    public $id, $email, $fistName, $lastName, $isAdmin, $isAuthor, $permGroup;

    private $tokenID;

    public function __construct()
    {
        $this->permGroup = self::PERM_GROUP_VISITOR;
        $this->checkLogin();
    }


    public function register($email, $firstName, $lastName, $password)
    {
        $email = strtolower($email);

        if(($isAvailable = Database::isIsset("SELECT user_id FROM users WHERE user_email = '{$email}'"))->status == false|| $isAvailable->data == false){
            return new Output(false, 'user_already_registered');
        }

        $passwordSuffix = Text::generate(32);
        $password = Text::encryptPassword($password, $passwordSuffix);

        $insertUser =  Database::insert("INSERT INTO users (user_email, user_first_name, user_last_name, user_password, user_suffix) VALUES ('{$email}', '{$firstName}', '{$lastName}', '{$password}', '{$passwordSuffix}')");

        if($insertUser->status){
            return new Output(true, 'register_success');
        }else{
            return new Output(false);
        }

        //todo
    }

    public function checkLogin()
    {
        $userID = Session::get("member_id");
        $tokenLock = Session::get("token_lock");
        $tokenKey = Session::get("token_key");

        if ($userID == "" || $tokenLock == "" || $tokenKey == "") {
            return new Output(false); //todo
        }

        $selectToken = Database::first("SELECT token_id FROM token WHERE token_lock = '{$tokenLock}' AND token_key = '{$tokenKey}' AND token_user = '{$userID}' AND is_deleted = 0");

        if ($selectToken->status == false || $selectToken->data == null) {
            return new Output(false);
        }

        $this->tokenID = $selectToken->data['token_id'];

        $getUser = Database::first('SELECT * FROM users WHERE user_id = {$userID}');

        if ($getUser->status == false || $getUser->data == null) {
            return new Output(false);
        }

        $this->id = $getUser['user_id'];
        $this->email = $getUser['user_email'];
        $this->fistName = $getUser['user_first_name'];
        $this->lastName = $getUser['user_last_name'];
        $this->isAdmin = $getUser['user_is_admin'];
        $this->isAuthor = $getUser['user_is_author'];
        $this->permGroup = ($this->isAdmin ? self::PERM_GROUP_ADMIN : self::PERM_GROUP_USER);

        return new Output(true, '', $this);
    }

    public function login($userName, $password)
    {
        $userName = strtolower($userName);

        global $database;

        $suffix = $database->first('SELECT user_suffix, user_id FROM users WHERE user_email = "' . $userName . '" AND is_deleted = 0');

        if ($suffix->status == false || $suffix->data == null || !isset($suffix->data['user_id'])) {
            return new Output(false, 'user_not_found', null);
        }

        $encryptedPassword = Text::encryptPassword($password, $suffix->data['user_suffix']);

        $user = $database->first('SELECT * FROM users WHERE user_email = "' . $userName . '" AND user_password = "' . $encryptedPassword . '" AND is_deleted = 0');

        if ($user->status == false || $user->data == null || !isset($user->data['user_id'])) {
            return new Output(false, 'user_wrong_login', null);
        }

        $userID = $user->data['user_id'];

        $tokenLock = Text::generate();
        $tokenKey = Text::generate();
        $userIP = $this->getIP()->data;

        while (Database::isIsset("SELECT token_id FROM token WHERE token_user = {$userID} AND token_lock =  '{$tokenLock}' AND token_key = '{$tokenKey}'")->data) {
            $tokenLock = Text::generate();
            $tokenKey = Text::generate();
        }

        Database::exec("UPDATE token SET token_active = 0 WHERE token_user = {$userID}");

        $insertToken = Database::insertReturnID("INSERT INTO token (token_user, token_lock, token_key, token_ip) VALUES ({$userID}, '{$tokenLock}', '{$tokenKey}','$userIP')");

        if ($insertToken->status) {
            Session::set('token_id', $insertToken->data);
            Session::set('token_lock', $tokenLock);
            Session::set('token_key', $tokenKey);
            Session::set('user_id', $userID);

            return new Output(true, 'login_success', [$insertToken->data, $tokenLock, $tokenKey, $userID]);
        } else {
            return new Output(false, 'system_error_login', null);
        }
    }

    public function perm($permType, $optionalFirst = 0, $optionalSecond = 0)
    {
        switch ($permType) {
            case self::PERM_IS:
                //First => İstenilen Perm
                if ($this->permGroup != $optionalFirst) {
                    return new Output(false);
                }
                break;
            case self::PERM_SELF:
                //First => İstenilen datadaki ID
                if ($this->id != $optionalFirst) {
                    return new Output(false);
                }
                break;
            case self::PERM_SELF_OR_UPPER:
                //First => İstenilen Kullanıcı ID
                //Seond => Min. Gereken Grup
                if ($this->id != $optionalFirst && $optionalSecond > $this->permGroup) {
                    return new Output(false);
                }
                break;
            case self::PERM_UPPER:
                //First => İstenilen Grup ID
                if ($this->permGroup < $optionalFirst) {
                    return new Output(false);
                }
                break;
        }

        return new Output(true);
    }

    public function isAdmin()
    {
        return $this->isAdmin;
    }

    private function getIP()
    {
        try {
            $ip = null;
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return new Output(true, '', $ip);
        } catch (Exception $e) {
            ///todo log sistemi ? belkli Log::error("ip", $e);
            return new Output(false, '', -1);
        }
    }
}