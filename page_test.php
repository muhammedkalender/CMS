<?php

require_once 'core/EasyCode.php';
require_once 'object/UserObject.php';

$category = $_GET['c'];
$request = $_GET['r'];

require_once 'views/header.php';

if ($category == 'user') {
    if($request == 'login'){
        require_once 'views/user/login.php';
    }
}

require_once 'views/footer.php';