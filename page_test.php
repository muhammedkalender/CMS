<?php

require_once 'core/EasyCode.php';
require_once 'object/UserObject.php';

$category = $_GET['c'];
$request = $_GET['r'];

require_once 'views/header.php';

if ($category == 'user') {
    if ($request == 'login') {
        require_once 'views/user/login.php';
    } else if ($request == 'register') {
        require_once 'views/user/register.php';
    }
} else if ($category == 'basic') {
    if ($request == 'home') {
        require_once 'views/basic/home.php';
    }
}

require_once 'views/footer.php';