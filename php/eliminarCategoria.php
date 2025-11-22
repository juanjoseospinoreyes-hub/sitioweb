<?php
include("conectar.php");

if (isset($_GET['cod'])) {
    $cod = $_GET['cod'];
    $sql = "DELETE FROM categoria WHERE COD = '$cod'";

    if (mysqli_query($conexion, $sql)) {
        header("Location: ../formularios/categoria.php?msj=" . urlencode("Categoría eliminada correctamente"));
        exit();
    } else {
        echo "Error al eliminar la categoría: " . mysqli_error($conexion);
    }
} else {
    echo "Código de categoría no especificado.";
}
?>
