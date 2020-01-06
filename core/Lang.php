<?php

require_once "core/Config.php";
require_once "core/Session.php";

if(Session::get("language")){
    require_once "lang/".Session::get("language").".php";
}else{
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

    if(file_exists("lang/{$lang}.php")){
        Session::set("language", $lang);

        require_once "index_{$lang}.php";
    }else{
        Session::set("language", Config::DEFAULT_LANGUAGE);

        require_once "language/".Config::DEFAULT_LANGUAGE.".php";
    }
}

