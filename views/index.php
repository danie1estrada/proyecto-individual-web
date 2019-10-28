<?php
    require_once('../controllers/user.controller.php');
    require_once('../config/config.php');
    session_start();

    use Controllers\UserController;

    if (!isset($_SESSION['login'])) {
        header('Location: '.URL.'/views/login.php?error=Usted no ha iniciado sesión.');
        die();
    }
    
    $user_controller = new UserController();
    $user = $user_controller->getUser($_SESSION['login']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historial médico</title>
    <link rel="stylesheet" href="../assets/styles/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="./index.php">Consulta de historiales médicos</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $user['full_name'] ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="./medical-record-create.php">Nuevo registro...</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../util/close.session.php">Cerrar sesión</a>
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <form action="index.php" method="get" class="row pt-4">
            <div class="col-10">
                <input type="text" class="form-control" name="params" aria-describedby="emailHelp"
                    placeholder="Buscar historial...">
            </div>

            <div class="col-2">
                <input type="submit" value="Buscar" class="btn btn-info btn-block">
            </div>
        </form> <br>
        
        <?php
        if (isset($_GET['success']) && isset($_GET['message'])) {
            $success = $_GET['success'];
            $class = $success == 'true' ? 'success' : 'danger';
            echo
            '<div class="alert alert-'.$class.' alert-dismissible fade show" role="alert">'
                .$_GET['message'].
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
        ?>
        
        <table class="table table-hover table-bordered table-striped table-sm">
            <thead>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Ocupación</th>
                <th colspan="2"></th>
            </thead>
            <tbody>
                <?php
                require_once('../controllers/medical-record.controller.php');
                use Controllers\MedicalRecordController;

                $controller = new MedicalRecordController();
                $params = isset($_GET['params']) ? $_GET['params'] : null;
                $stmt = $controller->getMedicalRecords($params);
                while($row = $stmt->fetch()) {
                    echo
                    '<tr>
                        <td>'.$row['full_name'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['phone'].'</td>
                        <td>'.$row['occupation'].'</td>
                        <td class="justify-content-center">
                            <a href="./medical-record-edit.php?id='.$row['id'].'" target="_blank" class="btn btn-warning btn-sm btn-block">Editar</a>
                        </td>
                        <td class="justify-content-center">
                            <a href="../controllers/medical-record-delete.controller.php?id='.$row['id'].'" class="btn btn-danger btn-sm btn-block">Eliminar</a>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>

    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>