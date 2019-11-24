<?php

require_once 'core/Database.php';
require_once 'core/Session.php';
require_once 'core/Text.php';
require_once 'core/EasyCode.php';
require_once 'core/Mail.php';

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
    public $id, $submissionID, $email, $fistName, $lastName, $isAdmin, $country, $organization, $webPage, $address, $tel;
    public $noteFood, $noteAccommodation, $noteExtra;
    public $isCorresponding, $isJoined;
    public $permGroup, $isLogged = false;

    private $tokenID;

    public function __construct()
    {
        $this->permGroup = self::PERM_GROUP_VISITOR;
        $this->checkLogin();
    }


    //region Register

    public function registerWithInput(){
        $password = post('password');

        if($password == ''){
            $password = Text::generate(16);
        }

        return $this->register(
            post('email'),
            $password,
            post('name'),
            post('surname'),
            post('country'),
            post('submission'),
            post('ec_id'),
            post('organization'),
            post('web_site'),
            post('address'),
            post('tel'),
            post('food'),
            post('accommodation'),
            post('extra_note'),
            post('corresponding'),
            post('joined', 0)
        );
    }

    public function register($email, $password, $firstName, $lastName, $country, $submission, $ecId, $organization, $webSite, $address, $tel, $food, $accommodation, $extra_note, $corresponding, $joined)
    {
        $email = strtolower($email);

        $isAvailable = Database::isIsset("SELECT user_id FROM users WHERE user_email = '{$email}'");

        if($isAvailable->status == false|| $isAvailable->data == true){
            return new Output(false, Lang::get('user_email_already_registered', $email));
        }

        $encryptedPassword = Text::encryptPassword($password);

        $insertUser =  Database::insertReturnID(
            "INSERT INTO users (user_email, user_password, user_first_name, user_last_name, user_country, user_submission, user_ec_id, user_organization, user_web_page, user_address, user_tel, user_food, user_accommodation, user_extra_note, user_is_corresponding, user_joined) VALUES 
('{$email}', '{$encryptedPassword}', '{$firstName}', '{$lastName}', {$country}, {$submission}, {$ecId}, '{$organization}', '{$webSite}', '{$address}', '{$tel}', '{$food}', '{$accommodation}', '{$extra_note}', {$corresponding}, {$joined})"
        );

        if($insertUser->status && $insertUser->data != false){
            Mail::queue($email, Lang::get('mail_title_register'), Lang::get('mail_template_register', $firstName, $lastName, $submission, $ecId, $password), $insertUser->data);

            return new Output(true, Lang::get('register_success', $email));
        }else{
            return new Output(false, Lang::get('register_failure', $email));
        }

        //todo
    }

    public function registerInputCheck(){
        return InputCheck::checkAll([
            new Input("email", Input::METHOD_POST, "input_email", Input::TYPE_EMAIL,3, 64),
            new Input('password', Input::METHOD_POST, 'input_password', Input::TYPE_STRING, 0,32),
            new Input('name', Input::METHOD_POST, 'input_name', Input::TYPE_STRING, 2, 32),
            new Input('surname', Input::METHOD_POST, 'input_surname', Input::TYPE_STRING, 2, 32),
            new Input('country', Input::METHOD_POST, 'input_country', Input::TYPE_INT, 1, 8),
            new Input('submission', Input::METHOD_POST, 'input_submission', Input::TYPE_INT, 1, 8),
            new Input('ec_id', Input::METHOD_POST, 'input_ec_id', Input::TYPE_INT, 1, 8),
            new Input('organization', Input::METHOD_POST, 'input_organization', Input::TYPE_STRING,0, 128),
            new Input('web_site', Input::METHOD_POST, 'input_web_site', Input::TYPE_URL,0, 128),
            new Input('address', Input::METHOD_POST, 'input_address', Input::TYPE_STRING,0, 128),
            new Input('tel', Input::METHOD_POST, 'input_tel', Input::TYPE_STRING,0, 128),
            new Input('food', Input::METHOD_POST, 'input_food', Input::TYPE_STRING,0, 256),
            new Input('accommodation', Input::METHOD_POST, 'input_accommodation', Input::TYPE_STRING,0, 256),
            new Input('extra_note', Input::METHOD_POST, 'input_extra_note', Input::TYPE_STRING,0, 256),
            new Input('corresponding', Input::METHOD_POST, 'input_corresponding', Input::TYPE_CHECK,0, 2),
            new Input('joined', Input::METHOD_POST, 'input_joined', Input::TYPE_CHECK,0, 2),
        ]);
    }

    //endregion

    public function checkLogin()
    {
        $userID = Session::get("user_id");
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
        $this->permGroup = ($this->isAdmin ? self::PERM_GROUP_ADMIN : self::PERM_GROUP_USER);

        $this->isLogged = true;

        return new Output(true, '', $this);
    }

    public function login($userName, $password)
    {
        $userName = strtolower($userName);

        global $database;

        $suffix = $database->first('SELECT user_suffix, user_id FROM users WHERE (user_email = "' . $userName . '" OR custom_email = "' . $userName . '") AND is_deleted = 0');

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

    public function isLogged(){
        return $this->isLogged;
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