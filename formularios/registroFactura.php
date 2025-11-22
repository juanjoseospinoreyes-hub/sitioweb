<?php
session_start();
include("../php/conectar.php");

// Si el carrito está vacío
if (empty($_SESSION['carrito'])) {
    echo "<h2 style='text-align:center; color:red;'>🛒 Tu carrito está vacío.</h2>";
    echo "<div style='text-align:center;'><a href='indexusuario.php' class='volver'>⬅️ Volver al menú</a></div>";
    exit;
}

// Calcular total
$total = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total += $item['precio'] * $item['cantidad'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Factura - Restaurante Reyes</title>
  <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
  <div class="container">
    <form action="../php/procesarFactura.php" method="POST">
      <h2>🧾 Registro de Datos del Cliente</h2>

      <label for="cc">Cédula de Ciudadanía</label>
      <input type="number" id="cc" name="cc" required placeholder="Ej: 1023456789">

      <label for="nombre">Nombres</label>
      <input type="text" id="nombre" name="nombre" maxlength="60" required placeholder="Ej: Juan Reyes">

      <label for="apellido">Apellidos</label>
      <input type="text" id="apellido" name="apellido" maxlength="60" placeholder="Ej: González">

      <label for="telefono">Teléfono</label>
      <input type="number" id="telefono" name="telefono" maxlength="10" required placeholder="Ej: 3004567890">

      <label for="direccion">Dirección</label>
      <input type="text" id="direccion" name="direccion" maxlength="100" required placeholder="Ej: Calle 10 #15-25">

      <h3>🛍️ Resumen del Pedido</h3>

      <table>
        <tr>
          <th>Artículo</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Subtotal</th>
          <th>Acciones</th>
        </tr>

        <?php foreach ($_SESSION['carrito'] as $cod => $item) { ?>
        <tr>
          <td><?php echo htmlspecialchars($item['descripcion']); ?></td>
          <td><?php echo $item['cantidad']; ?></td>
          <td>$<?php echo number_format($item['precio']); ?></td>
          <td>$<?php echo number_format($item['precio'] * $item['cantidad']); ?></td>
          <td>
            <a href="../php/eliminarCarrito.php?cod=<?php echo urlencode($cod); ?>" 
               class="btn-eliminar" 
               onclick="return confirm('¿Eliminar este producto del pedido?')">
               🗑 Eliminar
            </a>
          </td>
        </tr>
        <?php } ?>

        <tr class="total">
          <th colspan="3">TOTAL</th>
          <th>$<?php echo number_format($total); ?></th>
          <th></th>
        </tr>
      </table>

      <input type="hidden" name="total" value="<?php echo $total; ?>">

      <div class="botones">
        <input type="submit" value="Confirmar Compra 🧾">
        <a href="indexusuario.php" class="volver">⬅️ Volver</a>
      </div>
    </form>
  </div>
</body>
</html>
