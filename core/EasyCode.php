<?php

require_once 'core/Lang.php';

const DEFAULT_HTML_SPLITTER = '[::--::]';
const COMPANY_NAME = 'CMS';

function post($name, $defaultValue = '')
{
    if (!isset($_POST[$name])) {
        return $defaultValue;
    }

    return $_POST[$name];
}

function setPost($name, $value)
{
    $_POST[$name] = $value;
}

function getCustomDate()
{
    return date('Y-m-d h:m:s');
}

function folder()
{
    return '';
    //return '../cms/';
}

function inputLang($key, $firstParam = "", $secondParam = "", $thirdParam = "", $fourthParam = "", $fifthParam = "")
{
    if (Config::HIDE_LANG) {
        return '[input_' . $key . ']';
    } else {
        return Lang::get('input_' . $key, $firstParam, $secondParam, $thirdParam, $fourthParam, $fifthParam);
    }
}

function uiLang($key, $firstParam = "", $secondParam = "", $thirdParam = "", $fourthParam = "", $fifthParam = "")
{
    if (Config::HIDE_LANG) {
        return '[ui_' . $key . ']';
    } else {
        return Lang::get('ui_' . $key, $firstParam, $secondParam, $thirdParam, $fourthParam, $fifthParam);
    }
}

function hintLang($key, $firstParam = "", $secondParam = "", $thirdParam = "", $fourthParam = "", $fifthParam = "")
{
    if (Config::HIDE_LANG) {
        return '[hint_' . $key . ']';
    } else {
        return Lang::get('hint_' . $key, $firstParam, $secondParam, $thirdParam, $fourthParam, $fifthParam);
    }
}

function pageLang($key, $firstParam = "", $secondParam = "", $thirdParam = "", $fourthParam = "", $fifthParam = "")
{
    if (Config::HIDE_LANG) {
        return '[page_' . $key . ']';
    } else {
        return Lang::get('page_' . $key, $firstParam, $secondParam, $thirdParam, $fourthParam, $fifthParam);
    }
}

function sidebarLang($key, $firstParam = "", $secondParam = "", $thirdParam = "", $fourthParam = "", $fifthParam = "")
{
    if (Config::HIDE_LANG) {
        return '[sidebar_' . $key . ']';
    } else {
        return Lang::get('sidebar_' . $key, $firstParam, $secondParam, $thirdParam, $fourthParam, $fifthParam);
    }
}

function dataTablesLikeQuery($keyword, $columns)
{
    $query = "";

    foreach ($columns as $column) {
        if ($query) {
            $query .= " OR ";
        }

        $query .= "{$column} LIKE '%{$keyword}%'";
    }

    return " AND (  $query  ) ";
}

function redirect($URL)
{
    header('Location: ' . $URL);
    die();
}

function domain()
{
    return Config::PROTOCOL . "//" . Config::URL . "/";
}

function internalURL($category, $request, $additional = '', $additionalValue = '')
{
    return "/index.php?call_category={$category}&call_request={$request}" . ($additional ? "&{$additional}={$additionalValue}" : "");
}

function apiURL($category, $request){
    return "/api.php?call_category={$category}&call_request={$request}";
}

function sidebar()
{
    global $user;

    if ($user->isLogged()) {
        if ($user->isAdmin()) {
            require_once 'views/sidebar-admin.php';
        } else {
            require_once 'views/sidebar.php';
        }
    }
}