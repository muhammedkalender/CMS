<?php


class Input
{
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