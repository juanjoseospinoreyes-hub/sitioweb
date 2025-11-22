<?php
include("conectar.php");


if (isset($_GET['cod'])) {
    $cod = $_GET['cod'];

    // Obtener los datos actuales
    $sql = "SELECT * FROM categoria WHERE COD = '$cod'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $categoria = mysqli_fetch_array($resultado);
    } else {
        echo "Categoría no encontrada.";
        exit;
    }
} else {
    echo "Código de categoría no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
<div class="container">
    <form action="procesarCategoria.php" method="POST">
        <h2>✏️ Editar Categoría</h2>

        <input type="hidden" name="cod_original" value="<?php echo $categoria['COD']; ?>">

        <label for="ic1">Código</label>
        <input type="number" name="ic1" id="ic1" value="<?php echo $categoria['COD']; ?>" required>

        <label for="ic2">Descripción</label>
        <input type="text" name="ic2" id="ic2" value="<?php echo $categoria['DESCRIPCION']; ?>" required>

        <div class="botones">
            <input type="submit" value="Actualizar" name="ibg">
            <a href="../formularios/categoria.php" class="volver">Cancelar</a>
        </>
    </form>
</div>
</body>
</html>
