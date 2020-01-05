<?php

require_once 'core/Database.php';
require_once 'core/Session.php';
require_once 'core/Text.php';
require_once 'core/EasyCode.php';
require_once 'core/Mail.php';
require_once 'core/Log.php';
require_once 'core/Config.php';

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
        PERM_SELF_OR_UPPER = 3,
        //Yazarların veya yönetici
        AUTHOR_OR_ADMIN = 4,
        //Baş yazar veya yönetici
        CORRESPONDING_AUTHOR_OR_ADMIN = 5;

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
            case self::AUTHOR_OR_ADMIN:
                //First submission id
                if (!$this->isAdmin()) {
                    $isAuthor = Database::isIsset("SELECT user_id FROM users WHERE user_submission = {$optionalFirst} AND user_id = {$this->id} AND user_active = 1");

                    return $isAuthor;
                }
                break;
            case self::CORRESPONDING_AUTHOR_OR_ADMIN:
                //First submission id
                if (!$this->isAdmin()) {
                    $isCorrespondingAuthor = Database::isIsset("SELECT user_id FROM users WHERE user_submission = {$optionalFirst} AND user_id = {$this->id} AND user_is_corresponding = 1 AND user_active = 1");

                    return $isCorrespondingAuthor;
                }
                break;
        }

        return true;
    }

    public function loadPostData($arr, $type, $submission = 1)
    {
        if ($type == 'SUBMISSION_TEST') {
            setPost('first_name', $arr[0]);
            setPost('last_name', $arr[1]);
            setPost('email', $arr[2]);
            setPost('country', $arr[3]);
            setPost('submission', $submission);
            setPost('organization', $arr[4]);
            setPost('web_page', $arr[5]);
            setPost('corresponding', $arr[6]);
            setPost('joined', $arr[7]);
        }
    }

    //region Register

    public function registerWithInput($isTest = false)
    {
        $inputCheck = $this->registerInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        $password = post('password');

        if ($password == '') {
            $password = Text::generate(16);
        }

        return $this->register(
            post('email'),
            $password,
            post('first_name'),
            post('last_name'),
            post('country'),
            post('submission'),
            post('ec_id'),
            post('organization'),
            post('web_page'),
            post('address'),
            post('tel'),
            post('food'),
            post('accommodation'),
            post('extra_note'),
            post('corresponding'),
            post('joined', 0),
            $this->perm(self::PERM_IS, self::PERM_GROUP_ADMIN) ? post('admin', 0) : 0,
            $isTest
        );
    }

    public function register($email, $password, $firstName, $lastName, $country, $submission, $ecId, $organization, $webPage, $address, $tel, $food, $accommodation, $extra_note, $corresponding, $joined, $admin, $isTest = false)
    {
        $email = strtolower($email);

        $isAvailable = Database::isIsset("SELECT user_id FROM users WHERE user_email = '{$email}'");

        if ($isAvailable->status == true) {
            return new Output(false, Lang::get('user_email_already_registered', $email));
        }

        if ($isTest) {
            return new Output(true);
        }

        $encryptedPassword = Text::encryptPassword($password);

        $insertUser = Database::insertReturnID(
            "INSERT INTO users (user_email, user_password, user_first_name, user_last_name, user_country, user_submission, user_ec_id, user_organization, user_web_page, user_address, user_tel, user_food, user_accommodation, user_extra_note, user_is_corresponding, user_joined, user_is_admin) VALUES 
('{$email}', '{$encryptedPassword}', '{$firstName}', '{$lastName}', {$country}, {$submission}, {$ecId}, '{$organization}', '{$webPage}', '{$address}', '{$tel}', '{$food}', '{$accommodation}', '{$extra_note}', {$corresponding}, {$joined}, {$admin})"
        );

        if ($insertUser->status && $insertUser->data != false) {
            Mail::queue($email, Lang::get('mail_title_register'), Lang::get('mail_template_register', $firstName, $lastName, $submission, $ecId, $password), $insertUser->data);
            Log::insertWithKey('log_user_insert', [70, $submission], [$email, $firstName . ' ' . $lastName]);

            return new Output(true, Lang::get('register_success', $email));
        } else {
            Log::insert('log_user_insert_failure', [71, $submission], [$email, $firstName . ' ' . $lastName]);

            return new Output(false, Lang::get('register_failure', $email));
        }
    }

    public function registerInputCheck()
    {
        return InputCheck::checkAll([
            new Input("email", Input::METHOD_POST, "input_email", Input::TYPE_EMAIL, 3, 64),
            new Input('password', Input::METHOD_POST, 'input_password', Input::TYPE_STRING, 0, 32),
            new Input('first_name', Input::METHOD_POST, 'input_first_name', Input::TYPE_STRING, 2, 32),
            new Input('last_name', Input::METHOD_POST, 'input_last_name', Input::TYPE_STRING, 2, 32),
            new Input('country', Input::METHOD_POST, 'input_country', Input::TYPE_INT, 1, 8),
            new Input('submission', Input::METHOD_POST, 'input_submission', Input::TYPE_INT, 1, 8),
            new Input('ec_id', Input::METHOD_POST, 'input_ec_id', Input::TYPE_INT, 1, 8),
            new Input('organization', Input::METHOD_POST, 'input_organization', Input::TYPE_STRING, 0, 128),
            new Input('web_page', Input::METHOD_POST, 'input_web_page', Input::TYPE_URL, 0, 128),
            new Input('address', Input::METHOD_POST, 'input_address', Input::TYPE_STRING, 0, 128),
            new Input('tel', Input::METHOD_POST, 'input_tel', Input::TYPE_STRING, 0, 128),
            new Input('food', Input::METHOD_POST, 'input_food', Input::TYPE_STRING, 0, 256),
            new Input('accommodation', Input::METHOD_POST, 'input_accommodation', Input::TYPE_STRING, 0, 256),
            new Input('extra_note', Input::METHOD_POST, 'input_extra_note', Input::TYPE_STRING, 0, 256),
            new Input('corresponding', Input::METHOD_POST, 'input_corresponding', Input::TYPE_CHECK, 0, 2),
            new Input('joined', Input::METHOD_POST, 'input_joined', Input::TYPE_CHECK, 0, 2),
            new Input('admin', Input::METHOD_POST, 'input_admin', Input::TYPE_CHECK, 0, 2),
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

    public function loginWithInput()
    {
        $inputCheck = $this->loginInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->login(post('email'), post('password'));
    }

    public function login($userName, $password)
    {
        $userName = strtolower($userName);

        $encryptedPassword = Text::encryptPassword($password);

        $user = Database::first("SELECT * FROM users WHERE user_email = '{$userName}'  AND user_password = '{$encryptedPassword}' AND user_active = 1");

        if(isset($user->data['user_login_attempt']) && $user->data['user_login_attempt'] >= Config::ALERT_LOGIN_ATTEMPT){
            //TODO

            return new Output(false, Lang::get('user_wrong_brute_force'), null);
        }

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
        Database::exec("UPDATE users SET user_login_attempt = 0 WHERE user_id = {$userID}");

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

    //region Basic Functions

    public function isAdmin()
    {
        return $this->isAdmin;
    }

    public function isLogged()
    {
        return $this->isLogged;
    }

    public function getFullName()
    {
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

    //endregion

    //region Select

    public function selectInputCheck()
    {
        return InputCheck::checkAll([]);
    }

    public function selectWithInput()
    {
        $inputCheck = $this->selectInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->select();
    }

    private function select()
    {
        global $user;

        if (!$user->perm(UserObject::PERM_UPPER, UserObject::PERM_GROUP_USER)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $select = Database::select("SELECT user_id, user_first_name, user_last_name, user_created_at, user_submission, user_ec_id, user_joined, user_is_admin FROM users WHERE user_active = 1");

        if ($select->status) {
            //Log::insert('announcement_select_success', 84, $language);

            return new Output(true, Lang::get('user_select_success'), $select->data);
        } else {
            return new Output(false, Lang::get('user_select_failure'));
        }
    }

    //endregion

    //region Data Tables

    public function dataTablesWithInput()
    {
        $inputCheck = $this->dataTablesInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->dataTables(
            post('start'),
            post('length'),
            post('keyword'),
            post('orderColumn'),
            post('orderDir')
        );
    }

    public function dataTablesInputCheck()
    {
        if (isset($_POST['search']) && isset($_POST['search']['value'])) {
            setPost('keyword', $_POST['search']['value']);
        } else {
            setPost('keyword', '');
        }

        if (isset($_POST['order']) && isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {
            setPost('orderColumn', $_POST['order'][0]['column']);
            setPost('orderDir', $_POST['order'][0]['dir'] == 'asc' ? 'ASC' : 'DESC');
        } else {
            setPost('orderColumn', 1);
            setPost('orderDir', 'ASC');
        }

        return InputCheck::checkAll([
            new Input('start', Input::METHOD_POST, 'input_start', Input::TYPE_INT, 1, 8),
            new Input('length', Input::METHOD_POST, 'input_length', Input::TYPE_INT, 1, 8),
            new Input('keyword', Input::METHOD_POST, 'input_keyword', Input::TYPE_TEXT, 0, 64),
            new Input('orderColumn', Input::METHOD_POST, 'input_order_column', Input::TYPE_INT, 1, 8),
            new Input('orderDir', Input::METHOD_POST, 'input_order_dir', Input::TYPE_TEXT, 3, 4),
        ]);
    }

    public function dataTables($start, $length, $keyword, $orderColumn, $orderDir)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $columns = [
            'user_id',
            'user_ec_id',
            'user_submission',
            'user_first_name',
            'user_last_name',
            'user_email',
            'user_created_at'
        ];

        $querySearch = "";

        if (post('keyword')) {
            $querySearch = dataTablesLikeQuery($keyword, [
                'user_id',
                'user_ec_id',
                'user_submission',
                'user_first_name',
                'user_last_name',
                'user_email',
                'user_created_at'
            ]);
        }

        $select = Database::select("SELECT user_id, user_ec_id, user_submission, user_first_name, user_last_name, user_email, user_created_at FROM users WHERE user_active = 1 {$querySearch} ORDER BY " . $columns[$orderColumn] . ' ' . $orderDir . ' LIMIT ' . $length . ' OFFSET ' . $start);
        $stats = Database::select("SELECT COUNT(*) as recordsFiltered, (SELECT COUNT(*) FROM users WHERE user_active = 1) as recordsTotal FROM users WHERE user_active = 1 {$querySearch}");

        if ($select->status && $stats->status) {
            return new DataTablesOutput(true, Lang::get('user_select_success'), $select->data, $stats->data[0]['recordsTotal'], $stats->data[0]['recordsFiltered']);
        } else {
            return new DataTablesOutput(false, Lang::get('user_select_failure'));
        }

    }

    //endregion

    //region Delete

    public function deleteInputCheck()
    {
        return InputCheck::checkAll([]);
    }

    public function deleteWithInput()
    {
        $inputCheck = $this->deleteInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->delete(post('id'));
    }

    private function delete($userID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_IS, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $select = Database::exec("UPDATE users SET user_active = 0 WHERE user_id = {$userID}");

        if ($select->status) {
            Log::insert('user_delete_success', 74, $userID);

            return new Output(true, Lang::get('user_delete_success'));
        } else {
            return new Output(false, Lang::get('user_delete_failure'));
        }
    }

    //endregion

    //region Update Preferences

    public function updatePreferencesInputCheck()
    {
        return InputCheck::checkAll([
            new Input('id', Input::METHOD_POST, 'input_user', Input::TYPE_INT, 1, 8),
            new Input('food', Input::METHOD_POST, 'input_food', Input::TYPE_STRING, 0, 256),
            new Input('accommodation', Input::METHOD_POST, 'input_accommodation', Input::TYPE_STRING, 0, 256),
            new Input('extra_note', Input::METHOD_POST, 'input_extra_note', Input::TYPE_STRING, 0, 256),
        ]);
    }

    public function updatePreferencesWithInput()
    {
        $inputCheck = $this->updatePreferencesInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->updatePreferences(
            post('id'),
            post('food'),
            post('accommodation'),
            post('extra_note')
        );
    }

    private function updatePreferences($userID, $food, $accommodation, $extra_note)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_SELF_OR_UPPER, $userID, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $select = Database::exec("UPDATE users SET user_food = '{$food}', user_accommodation = '{$accommodation}', user_extra_note = '{$extra_note}' WHERE user_id = {$userID}");

        if ($select->status) {
            Log::insert('user_update_preferences_success', 78, $userID);

            return new Output(true, Lang::get('user_update_preferences_success'));
        } else {
            return new Output(false, Lang::get('user_update_preferences_failure'));
        }
    }

    //endregion

    //region Update Info

    //region Update Preferences

    public function updateInfoInputCheck()
    {
        return InputCheck::checkAll([
            new Input('id', Input::METHOD_POST, 'input_user', Input::TYPE_INT, 1, 8),
            new Input("email", Input::METHOD_POST, "input_email", Input::TYPE_EMAIL, 3, 64),
            new Input('first_name', Input::METHOD_POST, 'input_first_name', Input::TYPE_STRING, 2, 32),
            new Input('last_name', Input::METHOD_POST, 'input_last_name', Input::TYPE_STRING, 2, 32),
            new Input('country', Input::METHOD_POST, 'input_country', Input::TYPE_INT, 1, 8),
            new Input('organization', Input::METHOD_POST, 'input_organization', Input::TYPE_STRING, 0, 128),
            new Input('web_page', Input::METHOD_POST, 'input_web_page', Input::TYPE_URL, 0, 128),
            new Input('address', Input::METHOD_POST, 'input_address', Input::TYPE_STRING, 0, 128),
            new Input('tel', Input::METHOD_POST, 'input_tel', Input::TYPE_STRING, 0, 128),
            new Input('is_corresponding', Input::METHOD_POST, 'input_corresponding', Input::TYPE_CHECK, 0, 2),
            new Input('joined', Input::METHOD_POST, 'input_joined', Input::TYPE_CHECK, 0, 2),
        ]);
    }

    public function updateInfoWithInput()
    {
        $inputCheck = $this->updateInfoInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->updateInfo(
            post('id'),
            post('email'),
            post('first_name'),
            post('last_name'),
            post('country'),
            post('organization'),
            post('web_page'),
            post('address'),
            post('tel'),
            post('is_corresponding'),
            post('joined')
        );
    }

    private function updateInfo($userID, $email, $firstName, $lastName, $country, $organization, $webPage, $address, $tel, $isCorresponding, $joined)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_SELF_OR_UPPER, $userID, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $select = Database::exec("UPDATE users SET user_email= '{$email}', user_first_name = '{$firstName}', user_last_name = '{$lastName}', user_country = '{$country}', user_organization = '{$organization}', user_web_page = '{$webPage}', user_address = '{$address}', user_tel = '{$tel}', user_joined = '{$joined}', user_is_corresponding = '{$isCorresponding}'  WHERE user_id = {$userID}");

        if ($select->status) {
            Log::insert('user_update_info_success', 79, $userID);

            return new Output(true, Lang::get('user_update_info_success'));
        } else {
            return new Output(false, Lang::get('user_update_info_failure'));
        }
    }

    //endregion

    //endregion

    //region Show

    public function showInputCheck()
    {
        return InputCheck::checkAll([
            new Input('id', Input::METHOD_POST, 'input_user', Input::TYPE_INT, 1, 8)
        ]);
    }

    public function showWithInput()
    {
        $inputCheck = $this->showInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->show(post('id'));
    }

    private function show($userID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_SELF_OR_UPPER, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $select = Database::first("SELECT user_accommodation, user_address, user_country, user_ec_id, user_email, user_extra_note, user_first_name, user_food, user_id, user_is_admin, user_is_corresponding, user_joined, user_last_name, user_login_attempt, user_organization, user_submission, user_tel, user_web_page FROM users WHERE user_id = {$userID}");

        if ($select->status) {
            Log::insert('user_select_success', 79, $userID);

            return new Output(true, Lang::get('user_show_success'), $select->data);
        } else {
            return new Output(false, Lang::get('user_show_failure'), "SELECT user_accommodation, user_address, user_country, user_ec_id, user_email, user_extra_note, user_first_name, user_food, user_id, user_is_admin, user_is_corresponding, user_joined, user_last_name, user_login_attempt, user_organization, user_submission, user_tel, user_web_page FROM users WHERE user_id = {$userID}");
        }
    }

    //endregion

    //region Logout

    public function logout()
    {
        //tood

        Session::del('user_id');
        Session::del('token_lock');
        Session::del('token_key');

        $this->isLogged = false;
    }

    //endregion

    //region Forgot Password

    public function forgotPasswordWithInput()
    {
        $inputCheck = $this->forgotPasswordInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->forgotPassword(
            post('email')
        );
    }

    public function forgotPasswordInputCheck()
    {
        return InputCheck::checkAll([
            new Input("email", Input::METHOD_POST, "input_email", Input::TYPE_EMAIL, 3, 64)
        ]);
    }

    public function forgotPassword($email)
    {
        $email = strtolower($email);

        $user = Database::first("SELECT user_id FROM users WHERE user_email = '{$email}' AND user_active = 1");

        if ($user->status == false) {
            return new Output(false, Lang::get('null_user', $email));
        }

        $password = Text::generate(16);
        $encryptedPassword = Text::encryptPassword($password);

        $updateUser = Database::exec("UPDATE users SET user_password = '{$encryptedPassword}', user_updated_by = -1, user_updated_at = '" . getCustomDate() . "' WHERE user_id = " . $user['id']);

        if ($updateUser->status && $updateUser->data != false) {
            Mail::queue($email, Lang::get('mail_title_forgot_password'), Lang::get('mail_template_forgot_password', $password));
            Log::insertWithKey('log_user_forgot_password', [200, $user['id']]);

            return new Output(true, Lang::get('forgot_password_success', $email));
        } else {
            return new Output(false, Lang::get('forgot_password_failure', $email));
        }
    }

    //endregion

    //region Change Password

    public function changePasswordWithInput()
    {
        $inputCheck = $this->changePasswordInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->changePassword(
            post('id'),
            post('password_old'),
            post('password_new')
        );
    }

    public function changePasswordInputCheck()
    {
        global $user;

        return InputCheck::checkAll([
            new Input("id", Input::METHOD_POST, "input_user", Input::TYPE_INT, 1, 64),
            new Input('password_old', Input::METHOD_POST, 'input_password_old', Input::TYPE_STRING, ($user->isAdmin() ? 0 : 6), 32),
            new Input('password_new', Input::METHOD_POST, 'input_password_new', Input::TYPE_STRING, 6, 32)
        ]);
    }

    public function changePassword($userID, $passwordOld, $passwordNew)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_SELF_OR_UPPER, $userID, UserObject::PERM_GROUP_ADMIN)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $encryptedPasswordOld = Text::encryptPassword($passwordOld);

        $selectUser = Database::first("SELECT user_id FROM users WHERE user_id = '{$userID}' AND user_active = 1" . ($user->isAdmin ? '' : (" AND user_password = '{$encryptedPasswordOld}'")));

        if ($selectUser->status == false) {
            return new Output(false, Lang::get('null_user_change_password'));
        }

        $selectUser = $selectUser->data;

        $encryptedPasswordNew = Text::encryptPassword($passwordNew);

        $updateUser = Database::exec("UPDATE users SET user_password = '{$encryptedPasswordNew}', user_updated_by = " . $user->id . ", user_updated_at = '" . getCustomDate() . "' WHERE user_id = " . $selectUser['user_id']);

        if ($updateUser->status) {
            Log::insertWithKey('log_user_change_password', [201, $selectUser['user_id']]);

            return new Output(true, Lang::get('change_password_success'));
        } else {
            return new Output(false, Lang::get('change_password_failure'));
        }
    }

    //endregion

    //region Authors

    public function selectAuthorsInputCheck()
    {
        return InputCheck::checkAll([
            new Input('id', Input::METHOD_POST, 'submission', Input::TYPE_INT, 1, 8)
        ]);
    }

    public function selectAuthorsWithInput()
    {
        $inputCheck = $this->selectAuthorsInputCheck();

        if ($inputCheck->status == false) {
            return $inputCheck;
        }

        return $this->selectAuthors(
            post('id')
        );
    }

    private function selectAuthors($submissionID)
    {
        global $user;

        if (!$user->perm(UserObject::PERM_UPPER, UserObject::PERM_GROUP_USER)) {
            return new Output(false, Lang::get('perm_error'));
        }

        $select = Database::select("SELECT user_id, user_first_name, user_last_name, user_created_at, user_submission, user_email, user_joined, user_is_corresponding, user_is_admin FROM users WHERE user_active = 1 AND user_submission = {$submissionID}");

        if ($select->status) {
            //Log::insert('announcement_select_success', 84, $language);

            return new Output(true, Lang::get('user_select_success'), $select->data);
        } else {
            return new Output(false, Lang::get('user_select_failure'));
        }
    }

    //endregion
}

$user = new UserObject();