<?php
/**
 * Created by PhpStorm.
 * User: soms
 * Date: 07.06.16
 * Time: 13:37
 */

class DB {
    private
        $conn = null;

    function __construct($conn_string = "")
    {
        if ($conn_string == "") {
            return;
        }
        if (($this->conn = pg_connect($conn_string)) === false) {
            die("Не удалось подчиться к СУБД");
        }
    }

    function __destruct()
    {
        if ($this->conn !== null && $this->conn !== false)
            pg_close($this->conn);
    }

    function get_test() {
        $resource = pg_query(
            $this->conn,
            "SELECT * FROM test"
        );
        if ($resource === false)
            die("Все плохо: " . pg_last_error($this->conn));
        $res = array();
        while (($row = pg_fetch_assoc($resource)) !== false)
            $res[] = $row;
        return $res;
    }
};

$db = new DB("dbname=mult user=mult");