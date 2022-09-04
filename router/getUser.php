<?php
    function getUser(){
        include '../controller/CRUDController.php';
        $name = $_GET["name"];
        $token = $_GET["token"];
        $out = new stdClass();
        $VerifyToken = verificarToken($name, $token);
     
        if($VerifyToken->response){
            $user = findUser($name);
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


    print_r(getUser()); 



?>