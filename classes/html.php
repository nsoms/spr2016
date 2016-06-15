<?php
/*
Apache C CGI script

github.com

task1 / task.c

Ubuntu LTS

Scientific Linux
Debian
CentOS
*/

if (!defined('ROOT'))
    define ('ROOT', '../');

define('TYPE_TEMPLATE', 0);
define('TYPE_META', 1);


class HTML {
    static $sitename = "MySite";
    static $templates = [];
    static $js = [];
    static $css = [];
    static $templates_dir = "/templates/";

    /**
     * Function outputs header template
     * @param string $title
     */
    static public function header($title = "") {
        if ($title == "")
            $title = HTML::$sitename;
        else
            $title = HTML::$sitename . " - " . $title;
        HTML::template("header", array($title));
    }

    /**
     */
    static public function footer($aaa) {
        HTML::template("footer");
        return $aaa;
    }

    static function template($name, $args = array()) {
        if (file_exists(ROOT . HTML::$templates_dir . $name . ".meta.php"))
            HTML::$templates[] = array($name . ".meta", array(), TYPE_META);
        HTML::$templates[] = array($name, $args, TYPE_TEMPLATE);
    }

    static function flush() {
        foreach (HTML::$templates as $t) {
            list($name, $args, $type) = $t;
            if ($type != TYPE_META)
                continue;
            include(ROOT . "templates/" . $name . ".php");
        }
        foreach (HTML::$templates as $t) {
            list($name, $args, $type) = $t;
            if ($type == TYPE_META)
                continue;
            include(ROOT . "templates/" . $name . ".php");
        }
    }

    static function include_js($name) {
        HTML::$js[] = $name;
    }

    static function include_css($name) {
        HTML::$css[] = $name;
    }

    static function put_js() {
        HTML::$js = array_unique(HTML::$js);
        foreach (HTML::$js as $name) {
            echo "<script type='text/javascript' " .
                "src='js/" . $name . "'></script>";
        }
    }

    static function put_css() {
        HTML::$css = array_unique(HTML::$css);
        foreach (HTML::$css as $name) {
            echo "<link rel='stylesheet' ".
                "href='styles/" . $name . "' />";
        }
    }



};

