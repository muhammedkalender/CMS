<?php

require_once 'lang/tr.php'; //todo
require_once 'core/Output.php'; //todo
require_once 'core/InputCheck.php'; //todo
require_once 'core/Input.php'; //todo

$_POST['call_category'] = $_GET['c'];
$_POST['call_request'] = $_GET['r'];

$callResult = null;

if (isset($_POST["call_category"]) == false || isset($_POST["call_request"]) == false) {
    goto nothing;
}

$callCategory = $_POST["call_category"];
$callRequest = $_POST["call_request"];

if($callCategory == "user"){
    require_once 'object/UserObject.php';

    if($callRequest == "register"){
        $user = new UserObject();

        $_POST['email'] = "test@gmail.com";
        $_POST['name'] = "Test Name";
        $_POST['surname'] = "Surname";
        $_POST['country'] = "1";
        $_POST['submission'] = '1';
        $_POST['ec_id'] = '1';
        $_POST['web_site'] = '';

        $callResult = $user->registerWithInput();
    }else if($callRequest == "login"){
        $user = new UserObject();

        $_POST['email'] = 'test@gmail.com';
        $_POST['password'] = 'vePuXKUW7uGVoPV9';

        $callResult = $user->loginWithInput();
    }else if($callRequest == "check-login"){
        $user = new UserObject();

        $callResult = new Output($user->isLogged());
    }
}

nothing:
if($callResult == null){
    $callResult = new Output(false, Lang::get("api_request_null"));
}

output:
echo json_encode($callResult, true);