<?php


class Session
{
    public static function get($requestName)
    {
        //https://stackoverflow.com/a/18542272
        if (session_status() == PHP_SESSION_NONE || !isset($_SESSION[$requestName])) {
            return new Output(false);
        }

        return new Output(true, '', $_SESSION[$requestName]);
    }

    public static function set($requestName, $requestValue)
    {
        //https://stackoverflow.com/a/18542272
        if (session_status() == PHP_SESSION_NONE) {
            return new Output(false);
        }

        $_SESSION[$requestName] = $requestValue;

        return new Output(true,);
    }

    public static function del($requestName)
    {
        //https://stackoverflow.com/a/18542272
        if (session_status() == PHP_SESSION_NONE) {
            return new Output(false);
        }

        unset($_SESSION[$requestName]);

        return new Output(true);
    }
}