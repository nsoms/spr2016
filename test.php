<?php

define("ROOT", './');

include (ROOT . "classes/helpers.php");
include (ROOT . "classes/html.php");
include (ROOT . "classes/session.php");
require_once (ROOT . "classes/db.php");
require_once (ROOT . "classes/user.php");

Session::start_session();

HTML::header("Страница");

$login = get_or_post('login');
$passwd = get_or_post('passwd');
if ($login !== null && $passwd !== null) {
    $user->authorize($login, $passwd);
}

if (!$user->is_auth())
    HTML::template("login", array($login));

HTML::template("form", array($x, $y));
HTML::template("test", array($x / 2, $y / 2));

HTML::footer();
HTML::flush();

Session::store_session();
?>