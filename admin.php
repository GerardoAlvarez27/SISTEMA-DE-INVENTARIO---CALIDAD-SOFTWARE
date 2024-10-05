<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Tabla Central</title>

    <?php include("conexion.php"); ?>
    <style>
        body {
            background-color: rgb(209, 209, 209);
        }
        .nav-bar {
            width: 100%;
            background-color: rgb(30, 85, 37);
        }
        .nav-bar a {
            font-style: italic;
            color: white;
        }
        .table-container {
            width: 80%;
            margin: 0 auto; /* Centra el contenedor horizontalmente */
        }
        table {
            width: 100%;
            table-layout: fixed;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .footer-content a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }
        .footer-content a:hover {
            text-decoration: underline;
        }
        .footer-bottom {
            margin-top: 10px;
            font-size: 14px;
        }

        label {
    font-size: 1.2em;
    color: black;    
    margin-bottom: 1px; 
}
    </style>
</head>
<body>
    <nav class="nav-bar">
        <div>
            <ul>
                <li><a href="pagina.html">NUEVO PRODUCTO</a></li>
                <li><a href="pagina.html">CERRAR SESION</a></li>
            </ul>
        </div>
    </nav>
    <br>

    <div class="container">
    <h3>Agregar Nuevo Producto</h3>
    <br>
    <form action="nuevo_prod.php" method="POST">
        <div class="row">
            <div class="col-md-6">
                <label for="nombre">Nombre del producto</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="existencias">Existencias</label>
                <input type="number" id="existencias" name="existencias" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="tamaño">Tamaño</label>
                <input type="text" id="tamaño" name="tamaño" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <input type="submit" value="Agregar producto" class="btn btn-success">
            </div>
        </div>
    </form>
</div>


    <nav style="background-color:rgb(30, 85, 37)">
        <a style="margin-top: 15px; position: absolute; margin-left: 40%; color: white;"><h2>LISTADO DE PRODUCTOS</h2></a>
    </nav>
    <br><br>

    <div class="table-container">
        <table class="striped responsive-table">
            <thead style="font-size: large; text-align: center">
                <tr>
                    <th>ID Producto</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Existencias</th>
                    <th>Tamaño</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta para obtener los datos de la tabla 'producto'
                $sql = "SELECT * FROM producto";
                $resultado = $conexion->query($sql);

                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        // Mostrar los datos en la tabla
                        while($fila = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td style='text-align: center'>{$fila['id_producto']}</td>";
                            echo "<td style='text-align: center'>{$fila['nombre']}</td>";
                            echo "<td style='text-align: center'>{$fila['precio']}</td>";
                            echo "<td style='text-align: center'>{$fila['existencias']}</td>";
                            echo "<td style='text-align: center'>{$fila['tamaño']}</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>SIN PRODUCTOS INGRESADOS</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Error en la consulta: " . $conexion->error . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <br><br><br><br>
    <footer>
        <div class="footer-content">
            <p><a href="#">Política de Privacidad</a> | <a href="#">Términos y Condiciones</a> | <a href="#">Contacto</a></p>
            <div class="footer-bottom">
                &copy; 2024 Gerardo Álvarez. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script> 
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.carousel');
            var instances = M.Carousel.init(elems);
        });
    </script>       
</body>
</html>