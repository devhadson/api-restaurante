<?php

require_once '../includes/DBLogin.php';
$db = new DBLogin();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['email']) && isset($_POST['password'])) {

    // receiving the post params
    $email = $_POST['email'];
    $password = $_POST['password'];

    // get the user by email and password
    $user = $db->getUserByEmailAndPassword($email, $password);

    if ($user != false) {
        // use is found
        $response["error"] = FALSE;
        $response["id"] = $user["id"];
        $response["user"]["user"] = $user["user"];
        $response["user"]["email"] = $user["email"];
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Las credenciales de inicio de sesión son incorrectas. ¡Inténtalo de nuevo!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Los parámetros requeridos no coinciden el correo electrónico o la contraseña....";
    echo json_encode($response);
}
?>