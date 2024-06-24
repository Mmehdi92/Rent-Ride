<?php

namespace Framework;

class Session
{

    // start session
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // set session
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    // get session key
    public static function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    // check if session has key
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    // clear session
    public static function clear($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    //clear session and destroy session 
    public static function clearALL()
    {
        session_unset();
        session_destroy();
    }
}
