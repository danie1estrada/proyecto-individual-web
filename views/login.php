<?php
    require_once('../config/config.php');
    session_start();
    
    if (isset($_SESSION['login'])) {
        header('Location: '.URL.'/views');
        die();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="../assets/styles/bootstrap.min.css">
    <style>
        form {
            padding: 2em;
            margin-top: 2em;
            border-radius: 5px;
        }
    </style>
</head>
<body class="bg-dark">
    <div class="container">    
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <form action="../controllers/login.controller.php" method="post" class="bg-light">
                    <h1 class="text-center">Iniciar sesión</h1><br>
        
                    <div class="form-group">
                        <label for="">Usuario</label>
                        <input type="text" name="username" class="form-control" require_onced>
                    </div>
            
                    <div class="form-group">
                        <label for="">Contraseña</label>
                        <input type="password" name="password" class="form-control" require_onced>
                    </div>
            
                    <input type="submit" value="Entrar" class="btn btn-primary btn-block">
                    
                    <?php
                        $error = isset($_GET['error']) ? $_GET['error'] : null;
                        
                        if ($error) {
                            echo '<br>' .
                            '<div class="alert alert-danger">' .
                                $error .
                            '</div>';
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>