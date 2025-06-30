<?php
	/**
	* 
	*/
	class DbLogin
	{
		//Database connection link
        private $con;

		function __construct()
		{
            require_once dirname(__FILE__) . '/DbConnect.php';
            //Creating a DbConnect object to connect to the database
            $db = new DbConnect();
            $this->con = $db->connect();
		}

		function __destruct(){

		}

		/**
        * Get user by email and password
        */
        public function getUserByEmailAndPassword($email, $password) {

            $stmt = $this->con->prepare("SELECT * FROM users WHERE email = ? and password = ?");

            $stmt->bind_param("ss", $email, $password);

            if ($stmt->execute()) {
                $user = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                
                return $user;
                
            } else {
                return NULL;
            }
        }
	}	
?>