<?php
require_once 'includes/global.inc.php';
require_once 'UserTools.class.php'; 


class User {

	public $user_id;
	public $username;
	public $password;
	public $email; 
        private $mysqli; 
         private $db; 
 
	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
                $this->db = SingletonDb::getInstance(); 
               $this->mysqli = $this->db->getConnection(); 
		$this->user_id = (isset($data['user_id'])) ? $data['user_id'] : "";
		$this->username = (isset($data['username'])) ? $data['username'] : "";
		$this->password = (isset($data['password'])) ? $data['password'] : "";
		$this->email = (isset($data['email'])) ? $data['email'] : ""; 
	}

	public function save($isNewUser = false) {
		//create a new database object. 
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewUser) {
			//set the data array
			$data = array(
				"username" => "'$this->username'",
				"password" => "'$this->password'",
				"email" => "'$this->email'"
			);
			
			//update the row in the database
                         $result =  $this->mysqli->query("UPDATE users WHERE user_id = $id");
			$this->db->update($data, 'users', 'user_id = '.$this->user_id);
		}else {
		//if the user is being registered for the first time.
			$data = array(
				"username" => "'$this->username'",
				"password" => "'$this->password'",
				"email" => "'$this->email'" 
			);
			
			$this->user_id = $this->db->insert($data, 'users');
			$this->joinDate = time();
		}
		return true;
	}
	
}

?>