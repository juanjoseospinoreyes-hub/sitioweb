<?php
require_once "conectar.php";

$msj = "";

if (isset($_POST['ibg'])) {
    $cc = $_POST["ic1"];
    $nom = $_POST["ic2"];
    $apell = $_POST["ic3"];
    $tel = $_POST["ic4"];
    $direc = $_POST["ic5"];

    $sql = "INSERT INTO cliente (IDENTIFICACION, NOMBRE, APELLIDO, TELEFONO, DIRECCION)
            VALUES ('$cc', '$nom', '$apell', '$tel', '$direc')";
    
    $resultado = mysqli_query($conexion, $sql);

    if (!$resultado) {
        echo " Error insertando cliente: " . mysqli_error($conexion);
        exit();
    } else {
        $msj = " Cliente guardado correctamente";
        header("Location: ../formularios/cliente.php?msj=$msj");
        exit();
    }
}

if (isset($_POST['actualizar'])) {
    $cc_original = $_POST['cc_original'];
    $cc = $_POST['cc'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql = "UPDATE cliente SET 
                IDENTIFICACION='$cc',
                NOMBRE='$nombre',
                APELLIDO='$apellido',
                TELEFONO='$telefono',
                DIRECCION='$direccion'
            WHERE IDENTIFICACION='$cc_original'";

    $resultado = mysqli_query($conexion, $sql);

    if (!$resultado) {
        echo " Error al actualizar: " . mysqli_error($conexion);
        exit();
    } else {
        $msj = " Cliente actualizado correctamente";
        header("Location: ../php/consultarcliente.php?msj=$msj");
        exit();
    }
}




if (isset($_GET['eliminar'])) {
    $cc = $_GET['eliminar'];

    $sql = "DELETE FROM cliente WHERE IDENTIFICACION='$cc'";
    $resultado = mysqli_query($conexion, $sql);

    if (!$resultado) {
        echo " Error al eliminar: " . mysqli_error($conexion);
        exit();
    } else {
        $msj = " Cliente eliminado correctamente";
        header("Location: ../formularios/cliente.php?msj=$msj");
        exit();
    }
}
?>
