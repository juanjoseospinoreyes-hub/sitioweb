<?php
include("conectar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset($_POST["cod_original"])) {
        
        $cod_original = $_POST["cod_original"];
        $cod = $_POST["cod"];
        $desc = $_POST["desc"];
        $idcat = $_POST["idcat"];
        $precio = $_POST["precio"];
        $existencia = $_POST["existencia"];
        $min = $_POST["min"];
        $max = $_POST["max"];

        $sql = "UPDATE articulo 
                SET CODARTICULO='$cod',
                    DESCRIPCION='$desc',
                    IDCATEGORIA='$idcat',
                    PRECIOUNI='$precio',
                    EXISTENCIA='$existencia',
                    MINEXISTENCIA='$min',
                    MAXEXISTENCIA='$max'
                WHERE CODARTICULO='$cod_original'";

        if (mysqli_query($conexion, $sql)) {
            header("Location: ../formularios/producto.php?msj=Artículo actualizado correctamente");
            exit();
        } else {
            echo " Error al actualizar el artículo: " . mysqli_error($conexion);
        }

    } else {
       
        $cod = $_POST["cod"];
        $desc = $_POST["desc"];
        $idcat = $_POST["idcat"];
        $precio = $_POST["precio"];
        $existencia = $_POST["existencia"];
        $min = $_POST["min"];
        $max = $_POST["max"];

        $sql = "INSERT INTO articulo 
                (CODARTICULO, DESCRIPCION, IDCATEGORIA, PRECIOUNI, EXISTENCIA, MINEXISTENCIA, MAXEXISTENCIA)
                VALUES ('$cod', '$desc', '$idcat', '$precio', '$existencia', '$min', '$max')";

        if (mysqli_query($conexion, $sql)) {
            header("Location: ../formularios/producto.php?msj=Artículo registrado exitosamente");
            exit();
        } else {
            echo " Error al guardar el artículo: " . mysqli_error($conexion);
        }
    }
}
?>
