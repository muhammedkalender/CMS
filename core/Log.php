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

    public static function insertWithKey($text, $ids, $keys = []){
        $text = Text::encode($text);

        $newKeys = ['', '', '', ''];
        $newIds = [0, 0, 0];

        for($i = 0; $i < count($keys); $i++){
            $newKeys[$i] = Text::encode($keys[$i]);
        }

        for($i = 0; $i < count($ids); $i++){
            $newIds[$i] = $ids[$i];
        }

        $userID = Session::get('user_id', 0);

        return Database::insert("INSERT INTO logs (log_text, log_param_text_first, log_param_text_second, log_param_text_third, log_param_text_fourt, log_first_param, log_second_param, log_third_param, log_created_by) VALUES ('{$text}', '{$newKeys[0]}', '{$newKeys[1]}', '{$newKeys[2]}', '{$newKeys[3]}', {$newIds[0]}, {$newIds[1]}, {$newIds[2]}, {$userID})");
    }
}