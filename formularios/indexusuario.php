<?php
session_start();
include("../php/conectar.php");

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
  $_SESSION['carrito'] = [];
}

// Agregar producto al carrito
if (isset($_GET['agregar'])) {
  $cod = $_GET['agregar'];

  // Verificar si ya está en el carrito
  if (isset($_SESSION['carrito'][$cod])) {
    $_SESSION['carrito'][$cod]['cantidad']++;
  } else {
    // Consultar el producto
    $sqlProd = "SELECT CODARTICULO, DESCRIPCION, PRECIOUNI FROM ARTICULO WHERE CODARTICULO='$cod'";
    $resProd = mysqli_query($conexion, $sqlProd);
    $producto = mysqli_fetch_assoc($resProd);

    if ($producto) {
      $_SESSION['carrito'][$cod] = [
        'descripcion' => $producto['DESCRIPCION'],
        'precio' => $producto['PRECIOUNI'],
        'cantidad' => 1
      ];
    }
  }

  // Recargar la página para reflejar el cambio
  header("Location: indexusuario.php");
  exit;
}

// Consultar todos los artículos con su categoría
$sql = "SELECT a.CODARTICULO, a.DESCRIPCION, a.PRECIOUNI, c.DESCRIPCION AS CATEGORIA
        FROM articulo a
        JOIN categoria c ON a.IDCATEGORIA = c.COD";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>🍔 Menú del Restaurante</title>
  <link rel="stylesheet" href="../css/menu_usuario.css">
</head>
<body>
  
<header>
  <div class="header-content">
    <div class="header-left">
      <h1>🍽 Restaurante Reyes & Sabores by Juan 🍷</h1>
      <p class="slogan">“El sabor que conquista tu paladar”</p>
    </div>

    <div class="header-right">
      <button class="login-btn" onclick="window.location.href='../formularios/inicio.php'">🔐 Iniciar sesión</button>
      <button class="carrito-btn" onclick="window.location.href='registroFactura.php'">🛒 Carrito (<?php echo count($_SESSION['carrito']); ?>)</button>
    </div>
  </div>
</header>


  <main class="menu-container">
    <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
      <div class="card">
        <img src="../img/<?php echo $fila['CODARTICULO']; ?>.jpg"
             alt="<?php echo $fila['DESCRIPCION']; ?>"
             onerror="this.src='../img/default.jpg'">

        <h3><?php echo $fila['DESCRIPCION']; ?></h3>
        <p class="categoria"><?php echo $fila['CATEGORIA']; ?></p>
        <p class="precio">$<?php echo number_format($fila['PRECIOUNI']); ?></p>

        <a href="?agregar=<?php echo $fila['CODARTICULO']; ?>" class="btn-agregar">Agregar al carrito 🛒</a>
      </div>
    <?php } ?>
  </main>
  
  <footer>
    <div class="footer-content">
      <div class="footer-info">
        <h3>📞 Contáctanos</h3>
        <p>Teléfono: +57 310 456 7890</p>
        <p>WhatsApp: +57 312 654 3210</p>
        <p>Dirección: Calle 10 #15-25, Montería - Córdoba, Colombia</p>
        <p>Horario: Lunes a Domingo — 10:00 AM a 10:00 PM</p>
      </div>
    </div>

    <div class="footer-bottom">
      <p>© 2025 Restaurante Reyes & Sabores by Juan — Todos los derechos reservados 🍷</p>
    </div>
  </footer>

</body>
</html>
