<?php
require_once "conectar.php";

$sql = "SELECT * FROM cliente";
$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    echo("Error al consultar los clientes: " . mysqli_error($conexion));
}
?>

<link rel="stylesheet" href="../css/estilo.css">

<h2 class="titulo">📋 Lista de Clientes Registrados</h2>

<table>
    <tr>
        <th>CC</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Teléfono</th>
        <th>Dirección</th>
        <th>Acciones</th>
    </tr>

    <?php while ($fila = mysqli_fetch_array($resultado)) { ?>
    <tr>
        <td><?php echo $fila['IDENTIFICACION']; ?></td>
        <td><?php echo $fila['NOMBRE']; ?></td>
        <td><?php echo $fila['APELLIDO']; ?></td>
        <td><?php echo $fila['TELEFONO']; ?></td>
        <td><?php echo $fila['DIRECCION']; ?></td>
        <td>
            <a class="editar" href="../php/actualizarCliente.php?cc=<?php echo $fila['IDENTIFICACION']; ?>">Editar</a>
<a class="eliminar" href="../php/eliminarCliente.php?cc=<?php echo $fila['IDENTIFICACION']; ?>" onclick="return confirm('¿Seguro que desea eliminar este cliente?')">Eliminar</a>

        </td>
    </tr>
    <?php } ?>
</table>
