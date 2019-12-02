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
    return Lang::get('input_' . $key);
}

function uiLang($key)
{
    return Lang::get('ui_' . $key);
}