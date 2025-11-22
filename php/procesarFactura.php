<?php
session_start();
require_once("conectar.php");

// Si el carrito está vacío, salir
if (empty($_SESSION['carrito'])) {
    header("Location: ../formularios/indexusuario.php?msj=Carrito vacío");
    exit;
}

$cc = $_POST['cc'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$total = $_POST['total'];

mysqli_autocommit($conexion, FALSE);

try {

    // -----------------------------
    // Validar si el cliente existe
    // -----------------------------
    $consulta_cliente = "SELECT * FROM cliente WHERE IDENTIFICACION = '$cc'";
    $res_cliente = mysqli_query($conexion, $consulta_cliente);

    if (mysqli_num_rows($res_cliente) == 0) {
        $insert_cliente = "INSERT INTO cliente (IDENTIFICACION, NOMBRE, APELLIDO, TELEFONO, DIRECCION)
                           VALUES ('$cc', '$nombre', '$apellido', '$telefono', '$direccion')";
        mysqli_query($conexion, $insert_cliente);
    }

    // -----------------------------
    // Crear factura / pedido
    // -----------------------------
    $fecha = date("Y-m-d H:i:s");
    $nroPedido = "FAC" . time();
    $valorDescuento = 0;

    $insert_pedido = "INSERT INTO PEDIDO (NROPEDIDO, FECHA, IDCLIENTE, VALORTOTAL, VALORDESCUENTO)
                      VALUES ('$nroPedido', '$fecha', '$cc', '$total', '$valorDescuento')";
    mysqli_query($conexion, $insert_pedido);

   
    foreach ($_SESSION['carrito'] as $codArt => $prod) {

        $cantidadSolicitada = $prod['cantidad'];

        $q = mysqli_query($conexion, "SELECT EXISTENCIA FROM ARTICULO WHERE CODARTICULO='$codArt'");
        $existenciaActual = mysqli_fetch_assoc($q)['EXISTENCIA'];

        if ($cantidadSolicitada > $existenciaActual) {
            mysqli_rollback($conexion);
            die("<h2>Error: No hay existencias suficientes del producto $codArt</h2>
                 <a href='../formularios/registroFactura.php'>Volver</a>");
        }
    }

   
    $item = 1;

    foreach ($_SESSION['carrito'] as $codArt => $prod) {
        
        $cantidad = $prod['cantidad'];
        $precio = $prod['precio'];
        $subtotal = $precio * $cantidad;

 
        $insert_detalle = "INSERT INTO DETALLEPEDIDO 
            (NROPEDIDO, ITEM, CODARTICULO, CANTIDAD, VALORUNIT, VALORTOTAL, VALORDESCUENTO)
            VALUES ('$nroPedido', '$item', '$codArt', '$cantidad', '$precio', '$subtotal', '0')";
        mysqli_query($conexion, $insert_detalle);

        // Descontar inventario (YA VALIDADO)
        $update_inv = "UPDATE ARTICULO 
                       SET EXISTENCIA = EXISTENCIA - $cantidad 
                       WHERE CODARTICULO = '$codArt'";
        mysqli_query($conexion, $update_inv);

        $item++;
    }

 
    mysqli_commit($conexion);
    mysqli_autocommit($conexion, TRUE);

 
    unset($_SESSION['carrito']);

 
    header("Location: ../formularios/factura.php?nro=$nroPedido");
    exit;

} catch (Exception $e) {

    mysqli_rollback($conexion);
    echo "<h3>Error procesando la factura: " . $e->getMessage() . "</h3>";
}
?>
