<?php

function post($name, $defaultValue = ''){
    if(!isset($_POST[$name])){
        return $defaultValue;
    }

    return $_POST[$name];
}