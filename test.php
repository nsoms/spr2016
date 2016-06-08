<?php

define("ROOT", './');

include (ROOT . "classes/helpers.php");
include (ROOT . "classes/html.php");
include (ROOT . "classes/session.php");
require_once (ROOT . "classes/db.php");

Session::start_session();

Session::set("mama", "woman");
Session::set("pap", "man");

HTML::header("Страница1");

$x = get_or_post('x', "");
$y = get_or_post('y', "");


HTML::template("form", array($x, $y));
HTML::template("test", array($x / 2, $y / 2));

HTML::footer();
HTML::flush();

Session::store_session();
?>