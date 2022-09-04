<?php
    function token(){
        include '../controller/CRUDController.php';
        $name = $_POST["name"];
        $token = $_POST["token"];
        $tokenHash = password_hash($token, PASSWORD_DEFAULT);
        return print_r(verificarToken($name, $tokenHash));
    }

    token();
?>