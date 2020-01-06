<?php

require_once 'core/EasyCode.php';
require_once 'object/UserObject.php';

$showSidebar = true;
$title = 'CMS';
$allowAccess = true;
$page = null;

if (!isset($_GET['call_category']) || !isset($_GET['call_request'])) {
    if ($user->isLogged()) {
        $title = pageLang('home');

        require_once 'views/header.php';
        require_once 'views/basic/home.php';
    } else {
        $showSidebar = false;

        $title = pageLang('login');

        require_once 'views/header.php';
        require_once 'views/user/login.php';
    }

    require_once 'views/footer.php';

    die();
}

$category = $_GET['call_category'];
$request = $_GET['call_request'];

if ($category == 'user') {
    if ($request == 'login') {
        $title = pageLang('login');
        $page =  'views/user/login.php';
    }else if($request == 'profile'){
        $title = pageLang('profile');

        $userID = $user->id;

        if(isset($_GET['id'])){
            $userID = intval($_GET['id']);

            if(!$userID){
                $userID = $user->id;
            }
        }

        $allowAccess = $user->perm(UserObject::PERM_UPPER, UserObject::PERM_GROUP_USER);

        $page =  'views/user/profile.php';
    }else if($request == 'logout'){
        $user->logOut();

        $title = pageLang('login');

        $page = 'views/user/login.php';
    }else if($request == 'forgot-password'){
        $title = pageLang("forgot_password");

        $page = "views/user/forgot-password.php";
    }
} else if ($category == 'basic') {
//TODO
} else if ($category == 'submission') {
    if ($request == 'insert') {
        $title = pageLang('insert_submission');
        $showSidebar = false;

        $page =  'views/submission/insert.php';
    }else if($request == 'show'){
        $allowAccess = $user->perm(UserObject::PERM_UPPER, UserObject::PERM_GROUP_USER);
        $title = pageLang('view_submission');
        $submissionID = 0;

        if(isset($_GET['id'])){
            $submissionID = intval($_GET['id']);
        }else{
            redirect('/');
        }

        $page =  'views/submission/show.php';
    }
}else if($category == 'admin'){
    $allowAccess = $user->perm(UserObject::PERM_UPPER, UserObject::PERM_GROUP_ADMIN);

    if($request == 'announcement'){
        $title = pageLang('announcement');
        $page =  'views/admin/announcement.php';
    }else if($request == 'user-announcement'){
        $title = pageLang('user_announcement');
        $page =  'views/admin/user-announcement.php';
    }else if($request == 'user'){
        $title = pageLang('user');
        $page =  'views/admin/user.php';
    }else if($request == 'submission'){
        $title = pageLang('submission');
        $page =  'views/admin/submission.php';
    }else if($request == 'request-submission-invoices'){
        $title = pageLang('request_submission_invoices');
        $page =  'views/admin/request-submission-invoice.php';
    }else if($request == 'request-submission-full-papers'){
        $title = pageLang('request_submission_full_papers');
        $page =  'views/admin/request-submission-full-paper.php';
    }else if($request == 'filter-submission'){
        $title = pageLang('filter_submission');
        $page =  'views/admin/filter-submission.php';
    }
}


if($allowAccess){
    if($page == null){
        require_once 'views/http/404.html';
    }else{
        require_once 'views/header.php';
        require_once $page;
        require_once 'views/footer.php';
    }
}else{
    require_once 'views/http/401.html';
}

