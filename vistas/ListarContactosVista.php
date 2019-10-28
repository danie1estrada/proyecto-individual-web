
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Contacto</title>
</head>

<body>
    <div class="container">
        <h2 class="mb-4 mt-4">Listar Contactos</h2>
        <form class="row mb-4" action="ListarContactosVista.php" method="GET">
            <div class="col-10">
                <input type="text" class="form-control" id="param" name="param" aria-describedby="emailHelp"
                    placeholder="Busqueda..." value ="<?php echo isset($_GET['param'])? $_GET['param'] : '' ?>">
            </div>

            <input type="submit" value="Buscar" class="btn btn-primary col-2">
        </form>

        <table class="table">
            <thead>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Telefono Fijo</th>
                <th>Telefono Celular</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                <?php 
                    require_once('../bd/Conexion.php');
                    require_once('../configuracion/configuracion.php');
                    use  BD\Conexion;
                    $conexion = Conexion::obtenerConexion();
                    $param = isset($_GET['param']) ? $_GET['param'] : null;
                    $query = "SELECT * FROM contactos";

                    if($param) {
                        $query .= " WHERE nombre LIKE :param or apellidos LIKE :param or telefono_fijo LIKE :param or telefono_celular LIKE :param or email LIKE :param";
                    }
                    $statement = $conexion->prepare($query);
                    if($param)
                        $statement->execute(['param' => '%'.$param.'%']);
                    else {
                        $statement->execute();
                    }
                    while($row = $statement->fetch()) {
                        echo "<tr>" . 
                            "<td>" . $row['nombre'] . "</td>" .
                            "<td>" . $row['apellidos'] . "</td>" . 
                            "<td>" . $row['email'] . "</td>" .
                            "<td>" . $row['telefono_fijo'] . "</td>" .
                            "<td>" . $row['telefono_celular'] . "</td>" .
                            "<td> <a href=\"EditarContactoVista.php?id=".$row['id']."\"> <button class=\"btn btn-primary\">Editar</button><a/></td>".
                            "<td> <a href=\"EliminarContactoVista.php?id=".$row['id']."\"> <button class=\"btn btn-danger\">Eliminar</button><a/></td>".
                            "</tr>";
                    }
                        
                ?>
            </tbody>
        </table>
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