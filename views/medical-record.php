<?php
    require_once('../controllers/medical-record.controller.php');
    require_once('../controllers/user.controller.php');
    require_once('../config/config.php');
    session_start();

    use Controllers\MedicalRecordController;
    use Controllers\UserController;

    if (!isset($_SESSION['login'])) {
        header('Location: '.URL.'/views/login.php?error=Usted no ha iniciado sesión.');
        die();
    }
    
    $user_controller = new UserController();
    $user = $user_controller->getUser($_SESSION['login']);

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (!$id) {
        header('Location: '.URL.'/views');
        die();
    }

    $mrecord_controller = new MedicalRecordController();
    $record = $mrecord_controller->getMedicalRecord($id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ver</title>
    <link rel="stylesheet" href="../assets/styles/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="./index.php">Ver historial médico</a>
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
                                <a class="dropdown-item" href="require_once('../config/config.php');">Cerrar sesión</a>
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <br>
        <form>
            <div class="form-row">
                <div class="form-group col-8">
                    <label for="">Nombre:</label>
                    <input type="text" name="full_name" placeholder="Nombre" class="form-control" value="<?php echo $record['full_name']; ?>" disabled>
                </div>
                <div class="form-group col-2">
                    <label for="">Género:</label>
                    <select name="gender" class="form-control" disabled>
                        <option value="m" <?php if ($record['gender'] == 'm') echo 'selected'; ?>>Masculino</option>
                        <option value="f" <?php if ($record['gender'] == 'f') echo 'selected'; ?>>Femenino</option>
                    </select>
                </div>
                <div class="form-group col-2">
                    <label for="">Edad:</label>
                    <input type="number" name="age" placeholder="Edad" class="form-control" minlength="1" maxlength="2" value="<?php echo $record['age']; ?>" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-4">
                    <label for="">Fecha de nacimiento:</label>
                    <input type="date" name="date_of_birth" placeholder="Fecha de nacimiento" class="form-control" value="<?php echo $record['date_of_birth']; ?>" disabled>
                </div>
                <div class="form-group col-4">
                    <label for="">Ocupación:</label>
                    <input type="text" name="occupation" placeholder="Ocupación" class="form-control" value="<?php echo $record['occupation']; ?>" disabled>
                </div>
                <div class="form-group col-4">
                    <label for="">Localidad:</label>
                    <input type="text" name="location" placeholder="Localidad" class="form-control" value="<?php echo $record['location']; ?>" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-6">
                    <label for="">Nacionalidad:</label>
                    <input type="text" name="nationality" placeholder="Nacionalidad" class="form-control" value="<?php echo $record['nationality']; ?>" disabled>
                </div>
                <div class="form-group col-3">
                    <label for="">Religión:</label>
                    <input type="text" name="religion" placeholder="Religión" class="form-control" value="<?php echo $record['religion']; ?>" disabled>
                </div>
                <div class="form-group col-3">
                    <label for="">Teléfono:</label>
                    <input type="number" name="phone" placeholder="Teléfono" class="form-control" minlength="10" value="<?php echo $record['phone']; ?>" maxlength="10" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-4">
                    <label for="">Domicilo:</label>
                    <input type="text" name="address" placeholder="Domicilio" class="form-control" value="<?php echo $record['address']; ?>" disabled>
                </div>
                <div class="form-group col-4">
                    <label for="">Email:</label>
                    <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo $record['email']; ?>" disabled>
                </div>
                <div class="form-group col-4">
                    <label for="">Teléfono de emergencia:</label>
                    <input type="number" name="emergency_phone" placeholder="Teléfono de emergencia" class="form-control" minlength="10" maxlength="10" value="<?php echo $record['emergency_phone']; ?>" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12">
                    <label for="">Contacto de emergencia:</label>
                    <input type="text" name="emergency_contact" placeholder="Contacto de emergencia" class="form-control" value="<?php echo $record['emergency_contact']; ?>" disabled>
                </div>
            </div>
            
            <?php
            if (isset($_GET['success'])) {
                $success = $_GET['success'];
                $class = $success ? 'success' : 'danger';
                $message = $success ?
                'El registro se actualizó correctamente' :
                'Ha ocurrido un error al editar el registro';
                
                echo 
                '<div class="alert alert-'. $class . ' alert-dismissible fade show" role="alert">' .
                    $message .
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
            ?>

            <a href="./index.php" class="btn btn-default">Regresar</a>
        </form>

    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>