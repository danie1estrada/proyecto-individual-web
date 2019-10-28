
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Contacto</title>
</head>

<body>
    <div class="container">
        <?php 
        require_once('../bd/Conexion.php');
        require_once('../configuracion/configuracion.php');
        use  BD\Conexion;
        $conexion = Conexion::obtenerConexion();
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$id) {
            header('Location: '.ROOT_URL.'/vistas/ErrorVista.php?err=El id es incorrecto');
            die();
        }
        $query = "SELECT * FROM contactos WHERE id = :id";
        $statement = $conexion->prepare($query);
        $statement->execute(['id' => $id]);
        $row = $statement->fetch();
        
        if (!$row) {
            header('Location: '.ROOT_URL.'/vistas/ErrorVista.php?err=El usuario no exist22');
            die();
        }
        ?>
        <h1>Crear contacto</h1>
        <form action="../controladores/EditarContactoControlador.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="hidden" name="id" value="<?php echo $row['id']?>">
                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="emailHelp"
                    placeholder="Escribe el nombre del contacto" value="<?php echo $row['nombre']?>">
                <small id="emailHelp" class="form-text text-muted">Escribe el nombre del contacto</small>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos"value="<?php echo $row['apellidos']?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $row['email']?>">
            </div>
            <div class="form-group">
                <label for="telefono">Telefono Fijo</label>
                <input type="text" class="form-control" id="telefono_fijo" name="telefono_fijo" placeholder="Telefono Fijo" value="<?php echo $row['telefono_fijo']?>">
            </div>
            <div class="form-group">
                <label for="telefono">Telefono Celular</label>
                <input type="text" class="form-control" id="telefono_celular" name="telefono_celular" placeholder="Celular" value="<?php echo $row['telefono_celular']?>">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>