<?php
include("conectar.php");

if (isset($_GET['cc'])) {
    $cc = $_GET['cc'];
    $sql = "SELECT * FROM cliente WHERE IDENTIFICACION = '$cc'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $cliente = mysqli_fetch_array($resultado);
    } else {
        echo "Cliente no encontrado.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
<div class="container">
    <form action="procesarCliente.php" method="POST">
        <h2>✏️ Editar Cliente</h2>

        <input type="hidden" name="cc_original" value="<?php echo $cliente['IDENTIFICACION']; ?>">

        <label>Cédula:</label>
        <input type="number" name="cc" value="<?php echo $cliente['IDENTIFICACION']; ?>" required>

        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $cliente['NOMBRE']; ?>" required>

        <label>Apellido:</label>
        <input type="text" name="apellido" value="<?php echo $cliente['APELLIDO']; ?>" required>

        <label>Teléfono:</label>
        <input type="text" name="telefono" value="<?php echo $cliente['TELEFONO']; ?>" required>

        <label>Dirección:</label>
        <input type="text" name="direccion" value="<?php echo $cliente['DIRECCION']; ?>" required>
<div class="botones">
        <input type="submit" value="Actualizar" name="actualizar">
        <a href="../php/consultarCliente.php" class="volver">Cancelar</a>
		</div> 
    </form>
</div>
</body>
</html>
