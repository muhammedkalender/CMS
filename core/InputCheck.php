<?php

require_once 'core/Text.php';
require_once 'core/Output.php';

class InputCheck
{
    public static function check($requestName, $method, $name, $inputType, $minCharacter, $maxCharacter)
    {
        $data = null;

        switch ($method) {
            case Input::METHOD_GET:
                if (isset($_GET[$requestName])) {
                    $data = $_GET[$requestName];
                }
                break;
            case Input::METHOD_POST:
                if (isset($_POST[$requestName])) {
                    $data = $_POST[$requestName];
                }
                break;
            default:
        }

        if ($data == null && $minCharacter > 0) {
            if($inputType == Input::TYPE_CHECK){
                $data = 0;

                //Aşağıda olacak kontroller check türü için anlamsız
                goto skipControls;
            }else{
                return new Output(false, Lang::getWithKey('check_input_null', $name));
            }
        }

        if($data == null && $minCharacter == 0){
            if($inputType == Input::TYPE_CHECK){
                $data = 0;
            }else if($inputType == Input::TYPE_INT){
                $data = 0;
            }else{
                $data = '';
            }

            goto skipControls;
        }

        if ($inputType != Input::TYPE_ARRAY && strlen($data) < $minCharacter) {
            return new Output(false, Lang::get('check_input_short', Lang::get($name), $minCharacter));
        }

        if ($inputType != Input::TYPE_ARRAY && strlen($data) > $maxCharacter) {
            return new Output(false, Lang::get('check_input_long', Lang::get($name), $maxCharacter));
        }

        if ($inputType == Input::TYPE_INT) {
            if (!filter_var($data, FILTER_VALIDATE_INT)) {
                return new Output(false, Lang::getWithKey('check_input_type', $name, 'type_int'));
            }
        } else if ($inputType == Input::TYPE_FLOAT) {
            if (!filter_var($data, FILTER_VALIDATE_FLOAT)) {
                return new Output(false, Lang::getWithKey('check_input_type', $name, 'type_float'));
            }
        } else if ($inputType == Input::TYPE_STRING) {
            //todo varsa hata vericek özel karakter felan
        } else if ($inputType == Input::TYPE_CLEAN_STRING) {
            //todo güncellenebilir
            $data = preg_replace("[^\S]|[^a-zA-Z_-]", '', $data);
        } else if ($inputType == Input::TYPE_TEXT) {
            //todo varsa özel karakter encode edecek
            $data = Text::encode($data);
        } else if ($inputType == Input::TYPE_DATE) {
            if (($time_stamp = strtotime($data)) == false) {
                return new Output(false, Lang::get('check_input_date', Lang::get($name)));
            } else {
                $data = date('Y-m-d', $time_stamp);
            }
        }else if($inputType == Input::TYPE_EMAIL){
            $data = strtolower($data);

            if(!filter_var($data, FILTER_VALIDATE_EMAIL)){
                return new Output(false, Lang::getWithKey('check_input_type', $name, 'type_email'));
            }
        }else if($inputType == Input::TYPE_URL){
            $data = strtolower($data);

            if(!filter_var($data, FILTER_VALIDATE_URL)){
                return new Output(false, Lang::getWithKey('check_input_type', $name, 'type_url'));
            }
        }else if($inputType == Input::TYPE_ARRAY){
            if($data == '' || !is_array($data)){
                return new Output(false, Lang::getWithKey('check_input_array', $name, 'type_array'));
            }
        }else if($inputType == Input::TYPE_CHECK){
            if($data == '' || $data == null){
                $data = 0;
            }else{
                $data = 1;
            }
        }

        skipControls:

        switch ($method) {
            case Input::METHOD_GET:
                $_GET[$requestName] = $data;
                break;
            case Input::METHOD_POST:
                $_POST[$requestName] = $data;
                break;
            default:
        }

        return new Output(true, null, $data);
    }

    public static function checkAll($inputs)
    {
        foreach ($inputs as $input) {
            $output = self::check(
                $input->requestName,
                $input->method,
                $input->name,
                $input->inputType,
                $input->minCharacter,
                $input->maxCharacter
            );

            if(!$output->status){
                return $output;
            }
        }

        return new Output(true);
    }
}