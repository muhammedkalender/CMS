<?php

require_once 'core/Output.php';

class InputCheck
{
    const
        //Sadece tam sayılar
        TYPE_INT = 0,
        //Bütün sayılar
        TYPE_FLOAT = 1,
        //Sadece Düz Yazılar a-Z,0-9
        TYPE_STRING = 2,
        //Bütün karakterler, decode - encode ile
        TYPE_TEXT = 3,
        //Bütün karakterler ama izin verilmeyenler silinecek
        TYPE_CLEAN_STRING = 4,
        //D-M-Y ŞEKLİNDE DATE
        TYPE_DATE = 5,
        //INPUT YOKSA FALSE VARSA TRUE
        TYPE_CHECK = 6;

    const
        METHOD_GET = 0,
        METHOD_POST = 1;

    public function check($requestName, $method, $name, $inputType, $minCharacter, $maxCharacter)
    {
        $data = null;

        switch ($method) {
            case self::METHOD_GET:
                if (isset($_GET[$requestName])) {
                    $data = $_GET[$requestName];
                }
                break;
            case self::METHOD_POST:
                if (isset($_POST[$requestName])) {
                    $data = $_POST[$requestName];
                }
                break;
            default:
        }

        if ($data == null && $minCharacter > 0) {
            if($inputType == self::TYPE_CHECK){
                $data = 0;

                //Aşağıda olacak kontroller check türü için anlamsız
                goto skipControls;
            }else{
                return new Output(false, Lang::getWithKey('check_input_null', $name));
            }
        }

        if (strlen($data) < $minCharacter) {
            return new Output(false, Lang::get('check_input_short', Lang::get($name), $minCharacter));
        }

        if (strlen($data) > $maxCharacter) {
            return new Output(false, Lang::get('check_input_long', Lang::get($name), $maxCharacter));
        }

        if ($inputType == self::TYPE_INT) {
            if (!is_int($data)) {
                return new Output(false, Lang::getWithKey('check_input_type', $name, 'type_int'));
            }
        } else if ($inputType == self::TYPE_FLOAT) {
            if (!is_float($data)) {
                return new Output(false, Lang::getWithKey('check_input_type', $name, 'type_float'));
            }
        } else if ($inputType == self::TYPE_STRING) {
            //todo varsa hata vericek özel karakter felan
        } else if ($inputType == self::TYPE_CLEAN_STRING) {
            //todo güncellenebilir
            $data = preg_replace("[^\S]|[^a-zA-Z_-]", '', $data);
        } else if ($inputType == self::TYPE_TEXT) {
            //todo varsa özel karakter encode edecek
        } else if ($inputType == self::TYPE_DATE) {
            if (($time_stamp = strtolower($data)) == false) {
                return new Output(false, Lang::get('check_input_date', Lang::get($name)));
            } else {
                $data = date('d-m-Y', $time_stamp);
            }
        }

        skipControls:

        switch ($method) {
            case self::METHOD_GET:
                $_GET[$requestName] = $data;
                break;
            case self::METHOD_POST:
                $_POST[$requestName] = $data;
                break;
            default:
        }

        return new Output(true, null, $data);
    }

    public function checkAll($inputs)
    {
        foreach ($inputs as $input) {
            $output = $this->check(
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