<?php

require_once 'core/Database.php';
require_once 'core/Session.php';
require_once 'core/Text.php';
require_once 'core/EasyCode.php';
require_once 'core/Mail.php';
require_once 'core/Log.php';

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
    public $id, $submissionID, $email, $fistName, $lastName, $isAdmin, $country, $organization, $webPage, $address, $tel, $ecID;
    public $noteFood, $noteAccommodation, $noteExtra;
    public $isCorresponding, $isJoined;
    public $permGroup, $isLogged = false;

    private $tokenID;

    public function __construct()
    {
        $this->permGroup = self::PERM_GROUP_VISITOR;
        $this->checkLogin();
    }

    public function loadPostData($arr, $type, $submission = 1){
        if($type == 'SUBMISSION_TEST'){
            setPost('name', $arr[0]);
            setPost('surname', $arr[1]);
            setPost('email', $arr[2]);
            setPost('country', $arr[3]);
            setPost('submission', $submission);
            setPost('organization', $arr[4]);
            setPost('web_site', $arr[5]);
            setPost('corresponding', $arr[6]);
            setPost('joined', $arr[7]);
        }
    }

    //region Register

    public function registerWithInput($isTest = false)
    {
        $inputCheck = $this->registerInputCheck();

        if($inputCheck->status == false){
            return $inputCheck;
        }

        $password = post('password');

        if ($password == '') {
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
            post('joined', 0),
            $isTest
        );
    }

    public function register($email, $password, $firstName, $lastName, $country, $submission, $ecId, $organization, $webSite, $address, $tel, $food, $accommodation, $extra_note, $corresponding, $joined, $isTest = false)
    {
        $email = strtolower($email);

        $isAvailable = Database::isIsset("SELECT user_id FROM users WHERE user_email = '{$email}'");

        if ($isAvailable->status == true) {
            return new Output(false, Lang::get('user_email_already_registered', $email));
        }

        if($isTest){
            return new Output(true);
        }

        $encryptedPassword = Text::encryptPassword($password);

        $insertUser = Database::insertReturnID(
            "INSERT INTO users (user_email, user_password, user_first_name, user_last_name, user_country, user_submission, user_ec_id, user_organization, user_web_page, user_address, user_tel, user_food, user_accommodation, user_extra_note, user_is_corresponding, user_joined) VALUES 
('{$email}', '{$encryptedPassword}', '{$firstName}', '{$lastName}', {$country}, {$submission}, {$ecId}, '{$organization}', '{$webSite}', '{$address}', '{$tel}', '{$food}', '{$accommodation}', '{$extra_note}', {$corresponding}, {$joined})"
        );

        if ($insertUser->status && $insertUser->data != false) {
            Mail::queue($email, Lang::get('mail_title_register'), Lang::get('mail_template_register', $firstName, $lastName, $submission, $ecId, $password), $insertUser->data);
            Log::insertWithKey('log_user_insert', [70, $submission], [$email, $firstName . ' - ' .$lastName]);

            return new Output(true, Lang::get('register_success', $email));
        } else {
            Log::insert('log_user_insert_failure', [71, $submission], [$email, $firstName . ' - ' .$lastName]);

            return new Output(false, Lang::get('register_failure', $email));
        }

        //todo
    }

    public function registerInputCheck()
    {
        return InputCheck::checkAll([
            new Input("email", Input::METHOD_POST, "input_email", Input::TYPE_EMAIL, 3, 64),
            new Input('password', Input::METHOD_POST, 'input_password', Input::TYPE_STRING, 0, 32),
            new Input('name', Input::METHOD_POST, 'input_name', Input::TYPE_STRING, 2, 32),
            new Input('surname', Input::METHOD_POST, 'input_surname', Input::TYPE_STRING, 2, 32),
            new Input('country', Input::METHOD_POST, 'input_country', Input::TYPE_INT, 1, 8),
            new Input('submission', Input::METHOD_POST, 'input_submission', Input::TYPE_INT, 1, 8),
            new Input('ec_id', Input::METHOD_POST, 'input_ec_id', Input::TYPE_INT, 1, 8),
            new Input('organization', Input::METHOD_POST, 'input_organization', Input::TYPE_STRING, 0, 128),
            new Input('web_site', Input::METHOD_POST, 'input_web_site', Input::TYPE_URL, 0, 128),
            new Input('address', Input::METHOD_POST, 'input_address', Input::TYPE_STRING, 0, 128),
            new Input('tel', Input::METHOD_POST, 'input_tel', Input::TYPE_STRING, 0, 128),
            new Input('food', Input::METHOD_POST, 'input_food', Input::TYPE_STRING, 0, 256),
            new Input('accommodation', Input::METHOD_POST, 'input_accommodation', Input::TYPE_STRING, 0, 256),
            new Input('extra_note', Input::METHOD_POST, 'input_extra_note', Input::TYPE_STRING, 0, 256),
            new Input('corresponding', Input::METHOD_POST, 'input_corresponding', Input::TYPE_CHECK, 0, 2),
            new Input('joined', Input::METHOD_POST, 'input_joined', Input::TYPE_CHECK, 0, 2),
        ]);
    }

    //endregion

    //region Login

    public function checkLogin()
    {
        $userID = Session::get("user_id");
        $tokenLock = Session::get("token_lock");
        $tokenKey = Session::get("token_key");

        if ($userID == "" || $tokenLock == "" || $tokenKey == "") {
            return new Output(false); //todo
        }

        $selectToken = Database::first("SELECT token_id FROM tokens WHERE token_lock = '{$tokenLock}' AND token_key = '{$tokenKey}' AND token_user = '{$userID}' AND token_active = 1");

        if ($selectToken->status == false) {
            return new Output(false);
        }

        $this->tokenID = $selectToken->data['token_id'];

        $getUser = Database::first("SELECT * FROM users WHERE user_id = {$userID}");

        if ($getUser->status == false) {
            return new Output(false);
        }

        $getUser = $getUser->data;

        $this->id = $getUser['user_id'];
        $this->email = $getUser['user_email'];
        $this->fistName = $getUser['user_first_name'];
        $this->lastName = $getUser['user_last_name'];
        $this->isAdmin = $getUser['user_is_admin'];
        $this->country = $getUser['user_country'];
        $this->organization = $getUser['user_organization'];
        $this->webPage = $getUser['user_web_page'];
        $this->address = $getUser['user_address'];
        $this->tel = $getUser['user_tel'];
        $this->noteFood = $getUser['user_food'];
        $this->noteAccommodation = $getUser['user_accommodation'];
        $this->isCorresponding = $getUser['user_is_corresponding'];
        $this->noteExtra = $getUser['user_extra_note'];
        $this->isJoined = $getUser['user_joined'];
        $this->submissionID = $getUser['user_submission'];
        $this->ecID = $getUser['user_ec_id'];
        $this->permGroup = ($this->isAdmin ? self::PERM_GROUP_ADMIN : self::PERM_GROUP_USER);

        $this->isLogged = true;

        return new Output(true, '', $this);
    }

    public function loginInputCheck()
    {
        return InputCheck::checkAll([
            new Input("email", Input::METHOD_POST, "input_email", Input::TYPE_EMAIL, 3, 64),
            new Input('password', Input::METHOD_POST, 'input_password', Input::TYPE_STRING, 3, 32),
        ]);
    }

    public function loginWithInput(){
        $inputCheck = $this->loginInputCheck();

        if($inputCheck->status == false){
            return $inputCheck;
        }

        return $this->login(post('email'), post('password'));
    }

    public function login($userName, $password)
    {
        $userName = strtolower($userName);

        $encryptedPassword = Text::encryptPassword($password);

        $user = Database::first("SELECT * FROM users WHERE user_email = '{$userName}'  AND user_password = '{$encryptedPassword}' AND user_active = 1");

        if ($user->status == false) {
            return new Output(false, Lang::get('user_wrong_login'), null);
        }

        $userID = $user->data['user_id'];

        $tokenLock = Text::generate();
        $tokenKey = Text::generate();
        $userIP = $this->getIP()->data;

        while (Database::isIsset("SELECT token_id FROM tokens WHERE token_user = {$userID} AND token_lock =  '{$tokenLock}' AND token_key = '{$tokenKey}'")->data) {
            $tokenLock = Text::generate();
            $tokenKey = Text::generate();
        }

        Database::exec("UPDATE tokens SET token_active = 0 WHERE token_user = {$userID}");

        $insertToken = Database::insertReturnID("INSERT INTO tokens (token_user, token_lock, token_key, token_ip) VALUES ({$userID}, '{$tokenLock}', '{$tokenKey}','{$userIP}')");

        if ($insertToken->status) {
            Session::set('token_id', $insertToken->data);
            Session::set('token_lock', $tokenLock);
            Session::set('token_key', $tokenKey);
            Session::set('user_id', $userID);

            return new Output(true, Lang::get('login_success'), [$insertToken->data, $tokenLock, $tokenKey, $userID]);
        } else {
            return new Output(false, Lang::get('system_error_login'), null);
        }
    }

    //endregion

    public function perm($permType, $optionalFirst = 0, $optionalSecond = 0)
    {
        switch ($permType) {
            case self::PERM_IS:
                //First => İstenilen Perm

                if ($this->permGroup != $optionalFirst) {
                    return false;
                }
                break;
            case self::PERM_SELF:
                //First => İstenilen datadaki ID
                if ($this->id != $optionalFirst) {
                    return false;
                }
                break;
            case self::PERM_SELF_OR_UPPER:
                //First => İstenilen Kullanıcı ID
                //Seond => Min. Gereken Grup
                if ($this->id != $optionalFirst && $optionalSecond > $this->permGroup) {
                    return false;
                }
                break;
            case self::PERM_UPPER:
                //First => İstenilen Grup ID
                if ($this->permGroup < $optionalFirst) {
                    return false;
                }
                break;
        }

        return true;
    }

    public function isAdmin()
    {
        return $this->isAdmin;
    }

    public function isLogged()
    {
        return $this->isLogged;
    }

    public function getFullName(){
        return $this->fistName . ' ' . $this->lastName;
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

$user = new UserObject();