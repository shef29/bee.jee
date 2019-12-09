<?php


namespace app\vendor\mvc\models;


class Alert
{
    public static function add($key, $alert = null)
    {
        $_SESSION[$key] = $alert;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            $alert = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $alert;
        }
        return false;
    }

    public static function has($key)
    {
        if (isset($_SESSION[$key])) {
            return true;
        }
        return false;
    }
}