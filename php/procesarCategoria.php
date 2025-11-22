<?php
require_once "conectar.php";

// Verifica si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod = $_POST["ic1"];
    $des = $_POST["ic2"];
    $msj = "";

    // Si existe 'cod_original', significa que se está actualizando
    if (isset($_POST["cod_original"])) {
        $cod_original = $_POST["cod_original"];

        $sql = "UPDATE categoria 
                SET COD = '$cod', DESCRIPCION = '$des' 
                WHERE COD = '$cod_original'";

        if (mysqli_query($conexion, $sql)) {
            $msj = "Categoría actualizada correctamente";
        } else {
            echo "Error al actualizar categoría: " . mysqli_error($conexion);
            exit;
        }

    } else {
        // Si no existe 'cod_original', se inserta una nueva categoría
        $sql = "INSERT INTO categoria (COD, DESCRIPCION) 
                VALUES ('$cod', '$des')";

        if (mysqli_query($conexion, $sql)) {
            $msj = "Categoría guardada correctamente";
        } else {
            echo "Error insertando categoría: " . mysqli_error($conexion);
            exit;
        }
    }

    // Redirige al formulario principal con el mensaje
    header("Location: ../formularios/categoria.php?msj=" . urlencode($msj));
    exit();
}
?>
