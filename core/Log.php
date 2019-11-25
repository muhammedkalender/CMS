<?php


require_once 'core/Database.php';
require_once 'core/Text.php';
require_once 'core/Session.php';

class Log
{
    //Param İD ler eşlemek için örneğin 0 => insert, 1 => ahmet
    //Insert Yapıldı Ahmete gibi ...
    public static function insert($text, $firstParamID = 0, $secondParamID = 0, $thirdParamID = 0){
        $text = Text::encode($text);
        $userID = Session::get('user_id', 0);

        return Database::insert("INSERT INTO logs (log_text, log_first_param, log_second_param, log_third_param, log_created_by) VALUES ('{$text}', {$firstParamID}, {$secondParamID}, {$thirdParamID}, {$userID})");
    }

    public static function insertWithKey($text, $firstParam = '', $secondParam = '', $thirdParam = '', $fourthParam = ''){
        $text = Text::encode($text);
        $firstParam = Text::encode($firstParam);
        $secondParam = Text::encode($secondParam);
        $thirdParam = Text::encode($thirdParam);
        $fourthParam = Text::encode($fourthParam);

        $userID = Session::get('user_id', 0);

        return Database::insert("INSERT INTO logs (log_text, log_param_text_first, log_param_text_second, log_param_text_third, log_param_text_fourth, log_created_by) VALUES ('{$text}', '{$firstParam}', '{$secondParam}', '{$thirdParam}', '{$fourthParam}' {$userID})");
    }
}