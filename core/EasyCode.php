<?php

require_once 'core/Lang.php';

const DEFAULT_HTML_SPLITTER = '[::--::]';

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

function domain(){
    return 'http://dev.cms.system/'; //todo
}