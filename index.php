

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APIRest</title>
    <link rel="stylesheet" href="src/css/style.css">
</head>
<body>
        <div class="contenido">
            <h1>¡Bienvenido!</h1>

            <div class="boxLogin">
                <form action="router/login.php" method="POST">
                    <input type="text" id="token" name="token" style="display:none" value="$2y$10$oMOTe7hMySaxP2oNDi.vIuP2lsfMZ6pw.kCC8GxEmFH/VouBVD9um" />
                    <div class="input">
                        <p>Nombre</p>
                        <input type="text" id="name" name="name" />
                    </div>
                    <div class="input">
                        <p>password</p>
                        <input type="password" id="password" name="password" />
                    </div>
                    <div class="btn  text-center">
                        <button submit onClick="" >Ingresar</button>
                    </div>
                    
                </form>


            </div>
        </div>
</body>
</html>