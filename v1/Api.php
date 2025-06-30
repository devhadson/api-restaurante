<?php 
 
 //getting the dboperation class
 require_once '../includes/DbOperation.php';
 
 //function validating all the paramters are available
 //we will pass the required parameters to this function 
 function isTheseParametersAvailable($params){
 //assuming all parameters are available 
 $available = true; 
 $missingparams = ""; 
 
 foreach($params as $param){
 if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
	$available = false; 
	$missingparams = $missingparams . ", " . $param; 
	}
 }
 
 //if parameters are missing 
 if(!$available){
	 $response = array(); 
	 $response['error'] = true; 
	 $response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
	 
	 //displaying error
	 echo json_encode($response);
	 
	 //stopping further execution
	 die();
	 }
 }
 
 //an array to display response
 $response = array();
 //$response = $response();

 //if it is an api call 
 //that means a get parameter named api call is set in the URL 
 //and with this parameter we are concluding that it is an api call
 if(isset($_GET['apicall'])){
 
	 switch($_GET['apicall']){
		
		 case 'createuser':
			 //first check the parameters required for this request are available or not 
			 isTheseParametersAvailable(array('user', 'firstname', 'lastname', 'address', 'email', 'mobile', 'password', 'confirmpass'));
			 
			 //creating a new dboperation object
			 $db = new DbOperation();
			 
			 //creating a new record in the database
			 $result = $db->createUser(
				 $_POST['user'],
				 $_POST['firstname'],
				 $_POST['lastname'],
				 $_POST['address'],
				 $_POST['email'],
				 $_POST['mobile'],
				 $_POST['password'],
				 $_POST['confirmpass']
			 ); 
	 
			 //if the record is created adding success to response
			 if($result){
			 	 //record is created means there is no error
				 $response['error'] = false; 			 
				 //in message we have a success message
				 $response['message'] = 'Usuario agregado con éxito';			 
				 //and we are getting all the user from the database in the response
				 $response['user'] = $db->getUser();
			 }else{		 
				 //if record is not added that means there is an error 
				 $response['error'] = true; 			 
				 //and we have the error message
				 $response['message'] = 'Se produjo un error. Inténtalo de nuevo';
			 }
			 
		 break; 
	 
		 //the READ operation
		 //if the call is getuser
		 case 'getuser':
			 $db = new DbOperation();
			 $response['error'] = false; 
			 $response['message'] = 'Solicitud completada con éxito';
			 $response['user'] = $db->getUser();
		 break;
		 
		
		 //the UPDATE operation
		 case 'updateuser':
			 isTheseParametersAvailable(array('id', 'user', 'firstname', 'lastname', 'address', 'email', 'mobile', 'password', 'confirmpass'));
			 $db = new DbOperation();
			 $result = $db->updateUser(
				 $_POST['id'],
				 $_POST['user'],
				 $_POST['firstname'],
				 $_POST['lastname'],
				 $_POST['address'],
				 $_POST['email'],
				 $_POST['mobile'],
				 $_POST['password'],
				 $_POST['confirmpass']

		   	 );
		  
			 if($result){
				 $response['error'] = false; 
				 $response['message'] = 'Usuario actualizado con éxito';
				 $response['user'] = $db->getUser();
			 }else{
				 $response['error'] = true; 
				 $response['message'] = 'Se produjo un error. Inténtalo de nuevo';
			 }
		 break; 
	 
		 //the delete operation
		 case 'deleteuser':
		 
			 //for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
			 if(isset($_GET['id'])){
				 $db = new DbOperation();
				 if($db->deleteUser($_GET['id'])){
					 $response['error'] = false; 
					 $response['message'] = 'Usuario eliminado con éxito';
					 $response['user'] = $db->getUser();
				 }else{
					 $response['error'] = true; 
					 $response['message'] = 'Se produjo un error. Inténtalo de nuevo';
				 }
			 }else{
				 $response['error'] = true; 
				 $response['message'] = 'No encontro para eliminar, proporcione una identificación por favor';
			 }
		 break; 
	}	
	 
}else{
	 //if it is not api call 
	 //pushing appropriate values to response array 
	 $response['error'] = true; 
	 $response['message'] = 'Problemas en la llamada a la API';
}
 
//displaying the response in json structure 
echo json_encode($response);
?>