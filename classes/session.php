<?php

class Session {
    static $cookie_name = "SPR2016";
    static $sessions_dir = "sessions";
    static $data = array();
    static $uid = "";
    static $started = false;

    static public function start_session() {
        Session::$started = true;
        if (isset($_COOKIE[Session::$cookie_name])) {
            Session::$uid =$_COOKIE[Session::$cookie_name];
            Session::restore_session();
        }
        else {
            // сгенерировали уникальный номер сессии
            Session::$uid = md5(microtime(true));
            // установили куку
            setcookie(Session::$cookie_name, Session::$uid);
        }
    }
    
    static public function store_session() {
        if (!Session::$started)
            return;
        if (file_put_contents(
            Session::$sessions_dir . "/" . Session::$uid,
            serialize(Session::$data)
        ) === false)
            die("Couldn't save session data!!!");
    }

    static public function restore_session() {
        Session::$data = unserialize(
            file_get_contents(
                Session::$sessions_dir . "/" . Session::$uid
            )
        );
    }

    static public function set($name, $value) {
        if (Session::$started === false)
            return;
        Session::$data[$name] = $value;
    }

    static public function get($name) {
        if (!isset(Session::$data[$name]))
            return null;
        return Session::$data[$name];
    }
}