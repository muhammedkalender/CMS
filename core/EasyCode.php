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

function inputLang($key)
{
    return '[input_' . $key . ']';
    //todo return Lang::get('input_' . $key);
}

function uiLang($key)
{
    return '[ui_' . $key . ']';
    //todo return Lang::get('ui_' . $key);
}

function hintLang($key)
{
    return '[hint_' . $key . ']';
    //todo return Lang::get('hint_' . $key);
}

function pageLang($key, $firstParam = '', $secondParam = '')
{
    return '[page_' . $key . ']';
    //todo return Lang::get('page_' . $key);
}

function sidebarLang($key){
    return '[sidebar_' . $key . ']';
    //todo return Lang::get('page_' . $key);
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
    return 'http://dev.cms.system/'; //todo
}

function internalURL($category, $request, $additional = '', $additionalValue = '')
{
    return "/index.php?call_category={$category}&call_request={$request}" . ($additional ? "&{$additional}={$additionalValue}" : "");
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