<?php

    include '../controller/CRUDController.php';

        $out = new stdClass();

        $name = $_POST["name"];
        $password = $_POST["password"];
        $token = $_POST["token"];
        $passHash = password_hash($password, PASSWORD_DEFAULT);
        $out->name=$name;
        $out->password=$passHash;
        $realPass = '';

        if(isset($token)){
            $query = "SELECT * FROM `user` WHERE `name`='".$name."' AND `flag`='1' ";
            $conn = $mysqli->query($query);
            if ($conn->num_rows > 0) {
    
                // output data of each row
          
                while($row = $conn->fetch_array()) {
                    $realPass = $row["password"];
                    $login = login($name, $password, $realPass, $token);  
                    
                    if($login->response){
                        $out->code = 200;
                        $out->response = true;
                        $out->body = 'Bienvenido';
                    }else{
                        $out->code = 200;
                        $out->response = true;
                        $out->body = 'No existe el usuario';
                    }
            }
    
          }else{
                    $out->code = 200;
                    $out->response = true;
                    $out->body = 'No existe el usuario';
          }
        }else{
            $out->code = 500;
            $out->response = false;
            $out->body = 'No existe el token';
        }

      echo '<h1>'.$out->body.'</h1>';
      echo '<h2>'.$out->name.'</h2>';
      return $out;    
      $mysqli->close();  

            
        

?>

