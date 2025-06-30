<?php
 
    class DbOperation
    {
        //Database connection link
        private $con;
     
        //Class constructor
        function __construct()
        {
            //Getting the DbConnect.php file
            require_once dirname(__FILE__) . '/DbConnect.php';
     
            //Creating a DbConnect object to connect to the database
            $db = new DbConnect();
     
            //Initializing our connection link of this class
            //by calling the method connect of DbConnect class
            $this->con = $db->connect();
        }
        
        /*
        * The create operation
        * When this method is called a new record is created in the database
        */        
        function createUser($user, $firstname, $lastname, $address, $email, $mobile, $password, $confirmpass){
            $stmt = $this->con->prepare("INSERT INTO users (user, firstname, lastname, address, email, mobile, password, confirmpass) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $user, $firstname, $lastname, $address, $email, $mobile, $password, $confirmpass);
            if($stmt->execute())
                return true; 
                return false; 
        }
         
        /*
        * The read operation
        * When this method is called it is returning all the existing record of the database
        */
        function getUser(){
            $stmt = $this->con->prepare("SELECT id, user, firstname, lastname, address, email, mobile, password, confirmpass, status FROM users");
            $stmt->execute();
            $stmt->bind_result($id, $user, $firstname, $lastname, $address, $email, $mobile, $password, $confirmpass, $status);
         
            $list = array(); 
         
            while($stmt->fetch()){
                $use  = array();
                $use['id']          = $id; 
                $use['user']        = $user; 
                $use['firstname']   = $firstname;
                $use['lastname']    = $lastname;
                $use['address']     = $address; 
                $use['email']       = $email; 
                $use['mobile']      = $mobile; 
                $use['password']    = $password; 
                $use['confirmpass'] = $confirmpass; 
                $use['status']      = $status;
             
                array_push($list, $use); 
            }
             
            return $list; 
        }
        
        /*
        * The update operation
        * When this method is called the record with the given id is updated with the new given values
        */
        function updateUser($id, $user, $firstname, $lastname, $address, $email, $mobile, $password, $confirmpass){
            $stmt = $this->con->prepare("UPDATE users SET user = ?, firstname = ?, lastname = ?, address = ?, email = ?, mobile = ?, password = ?, confirmpass = ? WHERE id = ?");
            $stmt->bind_param("ssssssssi", $user, $firstname, $lastname, $address, $email, $mobile, $password, $confirmpass, $id);
            if($stmt->execute())
                return true; 
                return false; 
        }
         
         
        /*
        * The delete operation
        * When this method is called record is deleted for the given id 
        */
        function deleteUser($id){
            $stmt = $this->con->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            if($stmt->execute())
                return true;  
                return false; 
        }
    }
?>