<?php

const DEFAULT_HTML_SPLITTER = '[::--::]';

function post($name, $defaultValue = ''){
    if(!isset($_POST[$name])){
        return $defaultValue;
    }

    return $_POST[$name];
}

function setPost($name, $value){
    $_POST[$name] = $value;
}

function getDate(){
    return date('Y-m-d h:m:s');
}