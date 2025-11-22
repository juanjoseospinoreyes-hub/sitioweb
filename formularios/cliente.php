<?php 
$msj = isset($_GET['msj']) ? $_GET['msj'] : '';
?>

<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cliente - Restaurante</title>
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
</head>

<body>
    <div class="container">
        <section>
            <div id="register" class="animate form">
                <form method="POST" action="../php/procesarCliente.php">
                    <h2>Formulario de Registro</h2>

                    <?php 
                    if (!empty($msj)) {
                        echo "<h3 style='color:green; text-align:center;'>$msj</h3>";
                    }
                    ?>

                    <p>
                        <label for="cc">Cédula de Ciudadanía</label>
                        <input id="cc" name="ic1" required type="number" placeholder="Ej: 10234758" max="999999999">
                    </p>

                    <p>
                        <label for="nombre">Nombres</label>
                        <input id="nombre" name="ic2" required type="text" maxlength="60" placeholder="Ej: Carolina">
                    </p>

                    <p>
                        <label for="apellido">Apellidos</label>
                        <input id="apellido" name="ic3" required type="text" maxlength="60" placeholder="Ej: Cervantes">
                    </p>

                    <p>
                        <label for="telefono">Teléfono</label>
                        <input id="telefono" name="ic4" required type="number" placeholder="Ej: 3004567890" max="9999999999">
                    </p>

                    <p>
                        <label for="direccion">Dirección</label>
                        <input id="direccion" name="ic5" required type="text" maxlength="100" placeholder="Ej: Calle 10 #15-25">
                    </p>

                    <p class="signin button">
                        <input type="submit" value="Guardar" name="ibg">
                        <input type="reset" value="Cancelar" name="ibc">
                    </p>
                </form>
            </div>


           
        </section>
    </div>
</body>
</html>
