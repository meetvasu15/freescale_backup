<?php

/*
 * Mysql database class - only one connection alowed
 */

class SingletonDb {

    private $_connection;
    private static $_instance; //The single instance
    private $_host = "ddmdmdb-atx";
    private $_username = "oswdm";
    private $_password = "oswpass";
    private $_database_service = "ddedm";

    /*
      Get an instance of the Database
      @return Instance
     */

    public static function getInstance() {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Constructor
    private function __construct() {
        $this->_connection = oci_connect($this->_username, $this->_password, "//" . $this->_host . "/" . $this->_database_service);

        // Error handling
        if (!$this->_connection) {
            $m = oci_error();
            echo $m['message'], "\n";
            exit;
        }
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone() {
        
    }

    // Get oracle connection
    public function getConnection() {
        return $this->_connection;
    }
 
}

?>