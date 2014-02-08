<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once __ROOT__.'/includes/global.inc.php';
require_once 'User.class.php';
require_once 'SingletonDb.class.php';

class UserTools {

	//Log the user in. First checks to see if the 
	//username and password match a row in the database.
	//If it is successful, set the session variables
	//and store the user object within.
    
            private $mysqli;

            public function __construct() 
            { 
               $db = SingletonDb::getInstance(); 
               $this->mysqli = $db->getConnection();
            } 
	public function login($username, $password)
	{

		$hashedPassword = md5($password);
		$result =   $this->mysqli->query("SELECT * FROM users WHERE username = '$username' AND password = '$hashedPassword'");

		if(mysqli_num_rows($result) == 1)
		{ 
			$_SESSION["user"] = serialize(new User(mysqli_fetch_assoc($result)));
			$_SESSION["login_time"] = time();
			$_SESSION["logged_in"] = 1;
			return true;
		}else{
			return false;
		}
	}
	
	//Log the user out. Destroy the session variables.
	public function logout() {
		unset($_SESSION["user"]);
		unset($_SESSION["login_time"]);
		unset($_SESSION["logged_in"]);
		session_destroy();
	}

	//Check to see if a username exists.
	//This is called during registration to make sure all user names are unique.
	public function checkUsernameExists($username) {
		$result =  $this->mysqli->query("select user_id from users where username='$username'");
		//echo $username;
    	if(mysqli_num_rows($result) == 0)
    	{
			return false;
	   	}else{
	   		return true;
		}
	}
	
	//get a user
	//returns a User object. Takes the users id as an input
	public function get($id)
	{
		//$db = new DB();
           // $result =  $this->mysqli->query("SELECT * FROM users WHERE user_id = $id");
		$result = $this->select('users', "user_id = $id");
		
		return new User($result);
	}
	
        public function select($table, $where) {
		$sql = "SELECT * FROM $table WHERE $where"; 
                
		$result = $this->mysqli->query($sql);
               // echo $sql;
		if($result && mysqli_num_rows($result) == 1)
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
			$this->mysqli->query($sql) or die(mysql_error());
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
				
		$this->mysqli->query($sql) or die(mysql_error());
		
		//return the ID of the user in the database.
		return mysql_insert_id();
		
	}
        
        public function processRowSet($rowSet, $singleRow=false)
	{
		$resultArray = array();
		while($row = mysqli_fetch_assoc($rowSet))
		{
			array_push($resultArray, $row);
		}
		
		if($singleRow === true)
			return $resultArray[0];
			
		return $resultArray;
	}
	
}

?>