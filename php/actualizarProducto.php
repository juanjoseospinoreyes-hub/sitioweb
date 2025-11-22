<?php
include("conectar.php");

// Verificamos si llega el código del artículo por la URL
if (isset($_GET['cod'])) {
    $cod = $_GET['cod'];
    $sql = "SELECT * FROM articulo WHERE CODARTICULO = '$cod'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $articulo = mysqli_fetch_array($resultado);
    } else {
        echo "Artículo no encontrado.";
        exit;
    }
} else {
    echo "Código de artículo no proporcionado.";
    exit;
}

// Cargamos las categorías para el <select>
$categoria_sql = "SELECT COD, DESCRIPCION FROM CATEGORIA";
$categoria_res = mysqli_query($conexion, $categoria_sql);
?>

<?php
include("conectar.php");

if (isset($_GET['cod'])) {
  $cod = $_GET['cod'];

  // Obtener datos del artículo
  $sql_articulo = "SELECT * FROM articulo WHERE CODARTICULO = '$cod'";
  $resultado_articulo = mysqli_query($conexion, $sql_articulo);
  $articulo = mysqli_fetch_array($resultado_articulo);

  // Obtener categorías
  $sql_categoria = "SELECT * FROM categoria";
  $categoria_res = mysqli_query($conexion, $sql_categoria);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Artículo</title>
  <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
  <div class="container">
    <form action="procesarProducto.php" method="POST">
      <h2>✏️ Editar Artículo</h2>

      <input type="hidden" name="cod_original" value="<?php echo $articulo['CODARTICULO']; ?>">

      <label for="cod">Código del Artículo</label>
      <input type="text" id="cod" name="cod" value="<?php echo $articulo['CODARTICULO']; ?>" required>

      <label for="desc">Descripción</label>
      <input type="text" id="desc" name="desc" value="<?php echo $articulo['DESCRIPCION']; ?>" required>

      <label for="idcat">Categoría</label>
      <select name="idcat" id="idcat" required>
        <option value="">Seleccione una categoría</option>
        <?php while ($cat = mysqli_fetch_assoc($categoria_res)) { ?>
          <option value="<?php echo $cat['COD']; ?>" 
            <?php if ($cat['COD'] == $articulo['IDCATEGORIA']) echo 'selected'; ?>>
            <?php echo $cat['DESCRIPCION']; ?>
          </option>
        <?php } ?>
      </select>

      <label for="precio">Precio Unitario</label>
      <input type="number" id="precio" name="precio" 
             value="<?php echo $articulo['PRECIOUNI']; ?>" required>

      <label for="existencia">Existencia</label>
      <input type="number" id="existencia" name="existencia" 
             value="<?php echo $articulo['EXISTENCIA']; ?>" required>

      <label for="min">Mínimo</label>
      <input type="number" id="min" name="min" 
             value="<?php echo $articulo['MINEXISTENCIA']; ?>" required>

      <label for="max">Máximo</label>
      <input type="number" id="max" name="max" 
             value="<?php echo $articulo['MAXEXISTENCIA']; ?>" required>

      <!-- Sección de botones centrados -->
      <div class="botones">
        <input type="submit" value="Actualizar">
        <a href="../formularios/producto.php" class="boton-cancelar">Cancelar</a>
      </div>
    </form>
  </div>
</body>
</html>
