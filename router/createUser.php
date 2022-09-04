<?php
    function createUser(){
        include '../controller/CRUDController.php';
        $name = $_POST["name"];
        $pass = $_POST["pass"];
        $token = $_POST["token"];
        $out = new stdClass();
 
        $VerifyToken = verificarToken($name, $token);
        
        if($VerifyToken->response){
            
            $user = newUser($name,$pass);

            if($user->response){
                $out->code = 200;
                $out->response = true;
                $out->body = $user;
            }else{
                if($user->code == 201){
                    $out->code = 500;
                    $out->response = false;
                    $out->body = 'Usuario ya existe';
                }else{
                    $out->code = 500;
                    $out->response = false;
                    $out->body = 'no se pudo crear el usuario';
                }

            }

        }else{
            $out->code = 500;
            $out->response = false;
            $out->body = 'No existe el token';
        }
        return $out;    
        $mysqli->close();
    }


    print_r(createUser()); 



?>