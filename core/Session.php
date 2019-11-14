<?php


class Session
{
    public function select($requestName)
    {
        //https://stackoverflow.com/a/18542272
        if (session_status() == PHP_SESSION_NONE || !isset($_SESSION[$requestName])) {
            return new Output(false);
        }

        return new Output(true, '', $_SESSION[$requestName]);
    }

    public function update($requestName, $requestValue)
    {
        //https://stackoverflow.com/a/18542272
        if (session_status() == PHP_SESSION_NONE) {
            return new Output(false);
        }

        $_SESSION[$requestName] = $requestValue;

        return new Output(true,);
    }

    public function delete($requestName)
    {
        //https://stackoverflow.com/a/18542272
        if (session_status() == PHP_SESSION_NONE) {
            return new Output(false);
        }

        unset($_SESSION[$requestName]);

        return new Output(true);
    }
}