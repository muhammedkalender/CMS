<?php


class Input
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
        TYPE_CHECK = 6,
        //Email
        TYPE_EMAIL = 7,
        //URL
        TYPE_URL = 8,
        //ARRAY
        TYPE_ARRAY = 10;

    const
        METHOD_GET = 0,
        METHOD_POST = 1;

    public $requestName, $method, $name, $inputType, $minCharacter, $maxCharacter;

    public function __construct($requestName, $method, $name, $inputType, $minCharacter, $maxCharacter)
    {
        $this->requestName = $requestName;
        $this->method = $method;
        $this->name = $name;
        $this->inputType = $inputType;
        $this->minCharacter = $minCharacter;
        $this->maxCharacter = $maxCharacter;
    }

    public function castArray()
    {
        return [$this->requestName, $this->method, $this->name, $this->inputType, $this->minCharacter, $this->maxCharacter];
    }
}