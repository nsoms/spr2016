<?php

function get_or_post($name, $default = null) {
    if (isset($_GET[$name]))
        return $_GET[$name];
    if (isset($_POST[$name]))
        return $_POST[$name];
    return $default;
}