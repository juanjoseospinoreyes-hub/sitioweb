<?php
include("../php/conectar.php");
$msj = isset($_GET['msj']) ? $_GET['msj'] : "";

$sql = "SELECT * FROM categoria";
$resultado = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Categorías</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="container">
        <!-- Formulario -->
        <form action="../php/procesarCategoria.php" method="POST">
            <h2>🍷 Registro de Categorías</h2>

            <?php 
            if (!empty($msj)) {
                echo "<h3 style='color:green; text-align:center;'>$msj</h3>";
            }
            ?>

            <label for="ic1">Código</label>
            <input type="number" name="ic1" placeholder="Ingrese el código" max="9999999999" required>

            <label for="ic2">Descripción</label>
            <input type="text" name="ic2" placeholder="Ingrese la descripción" maxlength="60" required>

            <div class="botones">
                <input type="submit" value="Guardar" name="ibg" class="btn-guardar">
                <input type="reset" value="Cancelar" name="ibc" class="btn-cancelar">
				<a href="../indexp.html" class="volver">⬅️ Volver</a>
            </div>
        </form>


        <h2 class="titulo">📋 Lista de Categorías Registradas</h2>
        <table>
            <tr>
                <th>CÓDIGO</th>
                <th>DESCRIPCIÓN</th>
                <th>ACCIONES</th>
            </tr>

            <?php while ($fila = mysqli_fetch_array($resultado)) { ?>
            <tr>
                <td><?php echo $fila['COD']; ?></td>
                <td><?php echo $fila['DESCRIPCION']; ?></td>
                <td>
                    <a class="editar" href="../php/actualizarCategoria.php?cod=<?php echo $fila['COD']; ?>">Editar</a>
                    <a class="eliminar" href="../php/eliminarCategoria.php?cod=<?php echo $fila['COD']; ?>" onclick="return confirm('¿Seguro que desea eliminar esta categoría?')">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
