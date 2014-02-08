<?php
/*
* Mysql database class - only one connection alowed
*/
class SingletonDb {
	private static $_instance; //The single instance
	private $_npi_data_db_connection;
        private $_seaweb_buffer_db_connection;
        private $_seaweb_primevera_db_connection;
        private $_seaweb_dashboard_db_connection;
	private $_host = "mysqldev01-atx";
	private $_username = "seaweb";
	private $_password = "webmaster";
	private $_npi_data_database = "seaweb_npi_data_db";
        private $_seaweb_buffer_database = "seaweb_buffer";
        private $_seaweb_primevera_database = "seaweb_pv_db";
         private $_seaweb_dashboard_database = "seaweb_dashboard_db";
 
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
		$this->_npi_data_db_connection = new mysqli($this->_host, $this->_username, 
			$this->_password, $this->_npi_data_database);
                $this->_seaweb_buffer_db_connection = new mysqli($this->_host, $this->_username, 
			$this->_password, $this->_seaweb_buffer_database);
                $this->_seaweb_primevera_db_connection = new mysqli($this->_host, $this->_username, 
			$this->_password, $this->_seaweb_primevera_database);
                 $this->_seaweb_dashboard_db_connection = new mysqli($this->_host, $this->_username, 
			$this->_password, $this->_seaweb_dashboard_database);
	
		// Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to npi_data_db MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
		}
	}
 
	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }
 
	// Get mysqli connection
	public function getNpiDbConnection() {
		return $this->_npi_data_db_connection;
	}
       // Get mysqli connection
	public function getSeawebBufferDbConnection() {
		return $this->_seaweb_buffer_db_connection;
	}
         // Get mysqli connection
	public function getSeawebPrimeveraDbConnection() {
		return $this->_seaweb_primevera_db_connection;
	}
        
        public function getSeawebDashboardDbConnection() {
		return $this->_seaweb_dashboard_db_connection;
	}
       
        //Select rows from the database.
	//returns a full row or rows from $table using $where as the where clause.
	//return value is an associative array with column names as keys.
	public function select($table, $where) {
		$sql = "SELECT * FROM $table WHERE $where"; 
		$result = $this->_connection->query($sql);
		if(mysqli_num_rows($result) == 1)
			return $this->processRowSet($result, true);
		
		return $this->processRowSet($result);
	}
	
	//Updates a current row in the database.
	//takes an array of data, where the keys in the array are the column names
	//and the values are the data that will be inserted into those columns.
	//$table is the name of the table and $where is the sql where clause.
	public function update($data, $table, $where) {
		foreach ($data as $column => $value) {
			$sql = "UPDATE $table SET $column = $value WHERE $where";
			$this->_connection->query($sql)  ;
		}
		return true;
	}
	
	//Inserts a new row into the database.
	//takes an array of data, where the keys in the array are the column names
	//and the values are the data that will be inserted into those columns.
	//$table is the name of the table.
	public function insert($data, $table) {
		
		$columns = "";
		$values = "";
		
		foreach ($data as $column => $value) {
			$columns .= ($columns == "") ? "" : ", ";
			$columns .= $column;
			$values .= ($values == "") ? "" : ", ";
			$values .= $value;
		}
		
		$sql = "insert into $table ($columns) values ($values)";
				
		$this->_connection->query($sql)  ;
		
		//return the ID of the user in the database.
		return mysql_insert_id();
		
	}
	 
}
?>