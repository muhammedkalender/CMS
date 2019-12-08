<?php

require_once 'core/EasyCode.php';
require_once 'object/UserObject.php';

if (!isset($_GET['c']) || !isset($_GET['r'])) {
    require_once 'views/header.php';

    if ($user->isLogged()) {
        require_once 'views/basic/home.php';
    } else {
        require_once 'views/user/login.php';
    }

    require_once 'views/footer.php';

    die();
}

$category = $_GET['c'];
$request = $_GET['r'];

require_once 'views/header.php';


if ($category == 'user') {
    if ($request == 'login') {
        require_once 'views/user/login.php';
    }else if($request == 'profile'){
        $userID = $user->id;

        if($_GET['user']){
           $userID = intval($_GET['user']);

           if(!$userID){
               $userID = $user->id;
           }
        }

        require_once 'views/user/profile.php';
    }
} else if ($category == 'basic') {

} else if ($category == 'submission') {
    if ($request == 'insert') {
        require_once 'views/submission/insert.php';
    }
}else if($category == 'admin'){
    if($request == 'announcement'){
        require_once 'views/admin/announcement.php';
    }else if($request == 'user-announcement'){
        require_once 'views/admin/user-announcement.php';
    }else if($request == 'user'){
        require_once 'views/admin/user.php';
    }else if($request == 'submission'){
        require_once 'views/admin/submission.php';
    }
}

require_once 'views/footer.php';