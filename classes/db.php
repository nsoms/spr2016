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

    function one_row($resource) {
        if ($resource === false)
            die("Все плохо: " . pg_last_error($this->conn));
        $res = pg_fetch_assoc($resource);
        return ($res === false ? null : $res);
    }

    function all_rows($resource) {
        if ($resource === false)
            die("Все плохо: " . pg_last_error($this->conn));
        $res = array();
        while (($row = pg_fetch_assoc($resource)) !== false)
            $res[] = $row;
        return $res;
    }

    function get_test() {
        $resource = pg_query(
            $this->conn,
            "SELECT * FROM test"
        );
        return $this->all_rows($resource);
    }

    function check_auth($login, $passwd) {
        $resource = pg_query_params(
            $this->conn,
            "SELECT 
                id, login, 
                name,        
                email,       
                reg_date,    
                last_login 
            FROM users WHERE 
                login=$1 AND passwd=$2 AND NOT disabled",
            array($login, $passwd)
        );
        return $this->one_row($resource);
    }
};

$db = new DB("dbname=mult user=mult");