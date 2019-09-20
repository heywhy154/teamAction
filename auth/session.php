<?php
session_start();
class session
{
    public static function start_session($id)
    {
        $_SESSION['user'] = $id;
    }

    public static function end_session()
    {
        session_unset();
        session_destroy();
    }
}
