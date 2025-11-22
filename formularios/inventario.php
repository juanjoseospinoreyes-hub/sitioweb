<?php
include("../php/conectar.php");

// Inicializamos la variable para la tabla
$mostrarTabla = false;

// Comprobamos si se ha pulsado el botón
if (isset($_POST['ver_articulos'])) {
    $mostrarTabla = true;

    // Consultar productos con sus existencias
    $sql = "SELECT CODARTICULO, DESCRIPCION, PRECIOUNI, EXISTENCIA FROM articulo";
    $resultado = mysqli_query($conexion, $sql);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario de Productos</title>
    <link rel="stylesheet" href="../css/tablaClientes.css"> 

    <style>
        h1 { text-align: center; margin-top: 20px; font-family: 'Poppins', sans-serif; }
        .btn {
            display: inline-block;
            margin: 10px 5px;
            padding: 10px 18px;
            background: #2c3e50;
            color: white;
            text-decoration: none;
            text-align: center;
            border-radius: 8px;
            cursor: pointer;
            border: none;
            font-family: 'Poppins', sans-serif;
        }
        .btn:hover { background: #1a242f; }
        /* Si tu tablaClientes.css ya define table, th, td, no hace falta repetir */
    </style>
</head>

<body>

<h1>📦 Inventario de Productos</h1>

<div style="text-align:center; margin-bottom: 20px;">
    <form method="POST" style="display:inline;">
        <button type="submit" name="ver_articulos" class="btn">🧾 Ver Artículos (Editar / Eliminar)</button>
    </form>
    <a href="../php/consultarcliente.php" class="btn">📄 Ver Clientes</a>
    <a href="../indexp.html" class="btn">⬅ Volver al menú</a>
</div>

<?php if ($mostrarTabla) : ?>
    <table class="tablaClientes"> <!-- Aplicamos la clase de tu CSS -->
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Existencia</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
            <tr>
                <td><?php echo $fila['CODARTICULO']; ?></td>
                <td><?php echo $fila['DESCRIPCION']; ?></td>
                <td>$<?php echo number_format($fila['PRECIOUNI']); ?></td>
                <td><?php echo $fila['EXISTENCIA']; ?> unidades</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>
