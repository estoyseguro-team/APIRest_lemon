<?php
    function removeUser(){
        include '../controller/CRUDController.php';
        $name = $_POST["name"];
        $id = $_POST["id"];
        $newPassword = $_POST["newPassword"];
        $token = $_POST["token"];
        $out = new stdClass();
        $VerifyToken = verificarToken($name, $token);

        if($VerifyToken->response){
            $user = deleteUser($name, $id);
            $out->code = 200;
            $out->response = true;
            $out->body = $user;
        }else{
            $out->code = 500;
            $out->response = false;
            $out->body = 'No existe el token';
        }
        return $out;    
        $mysqli->close();
    }


    print_r(removeUser()); 



?>