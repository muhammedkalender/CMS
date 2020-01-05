<?php


class Text
{
    public static function generate($textLength = 128)
    {
        $list = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $listLength = strlen($list);
        $text = "";

        for ($i = 0; $i < $textLength; $i++) {
            $randomIndex = rand(0, $listLength - 1);
            $text .= $list[$randomIndex];
        }

        return $text;
    }

    public static function encode($rawText)
    {
        return htmlspecialchars($rawText, ENT_QUOTES);
    }

    public static function decode($rawText)
    {
        return htmlspecialchars_decode($rawText, ENT_QUOTES);
    }

    public static function encryptPassword($password)
    {
        return md5($password);
    }
}