<?php
include("../php/conectar.php");


if (!isset($_GET['nro'])) {
    echo "<h3 style='color:red; text-align:center;'>⚠️ No se especificó la factura.</h3>";
    exit;
}

$nroPedido = $_GET['nro'];


$sql_pedido = "SELECT p.NROPEDIDO, p.FECHA, p.VALORTOTAL, c.NOMBRE, c.APELLIDO, c.TELEFONO, c.DIRECCION
               FROM PEDIDO p
               JOIN CLIENTE c ON p.IDCLIENTE = c.IDENTIFICACION
               WHERE p.NROPEDIDO = '$nroPedido'";
$res_pedido = mysqli_query($conexion, $sql_pedido);
$pedido = mysqli_fetch_assoc($res_pedido);


if (!$pedido) {
    echo "<h3 style='color:red; text-align:center;'>Factura no encontrada.</h3>";
    exit;
}


$sql_detalles = "SELECT d.CANTIDAD, d.VALORUNIT, d.VALORTOTAL, a.DESCRIPCION
                 FROM DETALLEPEDIDO d
                 JOIN ARTICULO a ON d.CODARTICULO = a.CODARTICULO
                 WHERE d.NROPEDIDO = '$nroPedido'";
$res_detalles = mysqli_query($conexion, $sql_detalles);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Factura N° <?php echo $pedido['NROPEDIDO']; ?></title>
  <link rel="stylesheet" href="../css/estiloFactura.css">
</head>

<body>
  <div class="factura">
    <h2>🧾 Factura N° <?php echo $pedido['NROPEDIDO']; ?></h2>
    <p class="fecha">Fecha: <?php echo $pedido['FECHA']; ?></p>

    <section class="datos-cliente">
      <h3>👤 Datos del Cliente</h3>
      <p><strong>Nombre:</strong> <?php echo $pedido['NOMBRE'] . ' ' . $pedido['APELLIDO']; ?></p>
      <p><strong>Teléfono:</strong> <?php echo $pedido['TELEFONO']; ?></p>
      <p><strong>Dirección:</strong> <?php echo $pedido['DIRECCION']; ?></p>
    </section>

    <section class="detalles">
      <h3>🍽️ Detalles del Pedido</h3>
      <table>
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Valor Unitario</th>
          <th>Subtotal</th>
        </tr>
        <?php while ($detalle = mysqli_fetch_assoc($res_detalles)) { ?>
        <tr>
          <td><?php echo $detalle['DESCRIPCION']; ?></td>
          <td><?php echo $detalle['CANTIDAD']; ?></td>
          <td>$<?php echo number_format($detalle['VALORUNIT']); ?></td>
          <td>$<?php echo number_format($detalle['VALORTOTAL']); ?></td>
        </tr>
        <?php } ?>
        <tr class="total">
          <th colspan="3">TOTAL</th>
          <th>$<?php echo number_format($pedido['VALORTOTAL']); ?></th>
        </tr>
      </table>
    </section>

<div class="acciones">
  <a href="indexusuario.php" class="btn volver">🏠 Volver al Menú</a>
  <a href="registroFactura.php" class="btn nuevo">🛍️ Nueva Compra</a>
  <button onclick="window.print()" class="btn imprimir">🖨️ Imprimir Factura</button>

  <!-- Nuevo botón para descargar PDF -->
  <a href="../php/generarFacturaPDF.php?nro=<?php echo $pedido['NROPEDIDO']; ?>" 
     class="btn imprimir">📄 Descargar PDF</a>
</div>

  </div>
</body>
</html>

