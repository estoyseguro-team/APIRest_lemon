<?php
include '../env.php';
    /*  //CREANDO AL USUARIO */
    function newUser($user, $pass, $flag="1"){
       $resp = '';
       $out = new stdClass();
       /* Verificando si el usuario ya ha sido creado */
        if(findUser($user)->response){
            $out->response = true;
            $out->code = 201;
            $out->body = "ya a sido creado";
                        
        }else{
            /* Se intenta buscar en la base de datos la tabla user */
            try{
                include '../env.php';
                $passHash = password_hash($pass, PASSWORD_DEFAULT);
                $query = "INSERT INTO `user` (`id`, `name`, `password`, `flag`) VALUES (NULL, '".$user."' , '".$passHash."', '".$flag."')";
                if ($mysqli->query($query) === true ){
                    $resp = "creado el usuario";
                }else{
                    $resp = "Error ".$mysqli->query($query);
                }
                
                $out->response = true;
                $out->code = 200;
                $out->body = $resp;
        
                
            }
            catch(Exception $err){
                $resp = "Error ".$err;
                $out->response = true;
                $out->code = 400;
                $out->body = $resp;
            }
        }

        //Se formatea y manda la respuesta y se cierra la conexion
        return $out;    
        $mysqli->close();

    }

    function findUser($user){
        //CREANDO AL USUARIO
        try{

            $resp = '';
            $out = new stdClass();

            include '../env.php';
            $query = "SELECT * FROM `user` WHERE `name`='".$user."' AND `flag`='1' ";
            $conn = $mysqli->query($query);
            
            if ($conn->num_rows > 0) {

                    // output data of each row
              
                    while($row = $conn->fetch_array()) {
                       
                            $resp = "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
                        
                        
                    
                    $out->code = 200;
                    $out->response = true;
                    $out->body = $resp;
                }

              } else {
                $resp = "Sin Resultados";
                $out->response = false;
                $out->code = 500;
                $out->body = $resp;
              }
            

    
            
        }
        catch(Exception $err){
            $resp = "Error ".$err;
            $out->response = false;
            $out->code = 400;
            $out->body = $resp;
        }

        return $out;    
        $mysqli->close();

    }

    function updateUser($user, $id, $newPassword){
        /* Verificando si el usuario existe */
        include '../env.php';
        
        $user = findUser($user);
        $out = new stdClass();

       
        if($user->response){
            $passHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $query = "UPDATE user SET `password`='".$passHash."' WHERE id='".$id."' ";
       
            if ($mysqli->query($query) === TRUE) {
                $out->response = true;
                $out->code = 200;
                $out->body = "Modificado correctamente";  
            } else {
                $out->response = false;
                $out->code = 400;
                $out->body =  $sql;  
            }
        
        }
        return $out;    
        $mysqli->close();
    }


    function deleteUser($user, $id){
        include '../env.php';

         /* Verificando si el usuario existe */
         
        
         $user = findUser($user);
         $out = new stdClass();
         if($user->response){
            $query = "UPDATE user SET `flag`='2' WHERE id='".$id."' ";
       
            if ($mysqli->query($query) === TRUE) {
                $out->response = true;
                $out->code = 200;
                $out->body = "Usuario eliminado correctamente";  
            } else {
                $out->response = false;
                $out->code = 400;
                $out->body =  $sql;  
            }
         }else{
            $out->response = false;
            $out->code = 400;
            $out->body =  "El usuario no existe";  
         }
         return $out;    
        $mysqli->close();


    }


    function login($name, $pass, $hash, $token){

        $out = new stdClass();
    
        if(verificarToken($name, $token)){
            if (password_verify($pass, $hash)) {
                $out->response = true;
                $out->code = 200;
                $out->body =  "Bienvenido";  
            } else {
                $out->response = false;
                $out->code = 400;
                $out->body =  "La contraseña no es válida.";  
            }
        }else{
            $out->response = false;
            $out->code = 500;
            $out->body =  "Token Invalido";  
        }
            
            
        return $out;    
        $mysqli->close();  




    }


    function verificarToken($user, $Sendhach){
        $out = new stdClass();
        include '../env.php';

        $passHash = password_hash($user, PASSWORD_DEFAULT);
        
        $query = "SELECT * FROM dev WHERE name='ebros' AND flag='1'  ";
        $conn = $mysqli->query($query);
            
            if ($conn->num_rows > 0) {

                    // output data of each row
              
                    while($row = $conn->fetch_array()) {
                       
                            $resp = "hash: " . $row["hash"]. "-- Name: " . $row["name"]. "<br>";
                        
                            if(password_verify($row["name"], $Sendhach)){
                                $out->code = 200;
                                $out->response = true;
                                $out->body = $resp;
                            }else{
                                $out->code = 201;
                                $out->response = false;
                                $out->body = 'hach no es correcto';
                            }
                        
                    
                    
                }

              } else {
                $resp = "Sin Resultados";
                $out->response = false;
                $out->code = 500;
                $out->body = $resp;
              }

              return $out;    
              $mysqli->close();
    }

     

    
?>