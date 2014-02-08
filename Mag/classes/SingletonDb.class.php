<?php
/*
* Mysql database class - only one connection alowed
*/
class SingletonDb {
        private $_database_connection;
	private static $_instance; //The single instance 
	private $_host = "localhost";
	private $_username = "root";
	private $_password = "root";
	private $_database = "mag";
	/*
	Get an instance of the Database
	@return Instance
	*/
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
 
	// Constructor
	private function __construct() {
		$this->_database_connection = new mysqli($this->_host, $this->_username, 
			$this->_password, $this->_database); 
		// Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to npi_data_db MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
		}
	}
 
	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }
 
	// Get mysqli connection
	public function getMagDbConnection() {
		return $this->_database_connection;
	} 
}
?>
