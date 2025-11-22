<?php
include("conectar.php");

if (isset($_GET['cc'])) {
    $cc = $_GET['cc'];

    // 1️⃣ Verificar si el cliente tiene pedidos asociados
    $consulta_pedidos = "SELECT * FROM pedido WHERE IDCLIENTE = '$cc'";
    $res_pedidos = mysqli_query($conexion, $consulta_pedidos);

    if (mysqli_num_rows($res_pedidos) > 0) {
        // 🚫 No se puede eliminar
        header("Location: ../php/consultarCliente.php?error=No se puede eliminar: el cliente tiene pedidos registrados");
        exit();
    }

    // 2️⃣ Si no tiene pedidos, sí se puede eliminar
    $sql = "DELETE FROM cliente WHERE IDENTIFICACION = '$cc'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        header("Location: ../php/consultarCliente.php?msj=Cliente eliminado correctamente");
        exit();
    } else {
        echo "Error al eliminar el cliente: " . mysqli_error($conexion);
    }

} else {
    echo "No se recibió el parámetro de identificación.";
}
?>
