<?php
include("conectar.php");

if (isset($_GET['cod'])) {
    $cod = $_GET['cod'];

    $sql = "DELETE FROM articulo WHERE CODARTICULO = '$cod'";

    if (mysqli_query($conexion, $sql)) {
        header("Location: ../formularios/producto.php?msj=Artículo eliminado correctamente");
        exit();
    } else {
        echo "Error al eliminar el artículo: " . mysqli_error($conexion);
    }
} else {
    echo "Código no proporcionado.";
}
?>
