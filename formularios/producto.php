<?php
include("../php/conectar.php");


$categoria_sql = "SELECT COD, DESCRIPCION FROM CATEGORIA";
$categoria_res = mysqli_query($conexion, $categoria_sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Artículos</title>
  <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
  <div class="container">
    <section>
      <form method="POST" action="../php/procesarProducto.php">
	  
        <h2>🍽️ Registro de Artículos</h2>

        <label for="cod">Código del Artículo</label>
        <input type="text" id="cod" name="cod" maxlength="15" required placeholder="Ej: A001">

        <label for="desc">Descripción</label>
        <input type="text" id="desc" name="desc" maxlength="60" required placeholder="Ej: Hamburguesa Doble">

        <label for="idcat">Categoría</label>
        <select name="idcat" id="idcat" required>
          <option value="">Seleccione una categoría</option>
          <?php while ($cat = mysqli_fetch_assoc($categoria_res)) { ?>
            <option value="<?php echo $cat['COD']; ?>">
              <?php echo $cat['DESCRIPCION']; ?>
            </option>
          <?php } ?>
        </select>

<label for="precio">Precio Unitario</label>
  <input type="number" name="precio" placeholder="Ej: 25000" required>

  <label for="existencia">Existencia Actual</label>
  <input type="number" name="existencia" placeholder="Ej: 50" required>

  <label for="min">Mínimo en Inventario</label>
  <input type="number" name="min" placeholder="Ej: 10" required>

  <label for="max">Máximo en Inventario</label>
  <input type="number" name="max" placeholder="Ej: 100" required>

        <div class="botones">
          <input type="submit" value="Guardar">
          <input type="reset" value="Cancelar">
		  <a href="../indexp.html" class="volver">⬅️ Volver</a>
        </div>
      </form>
    </section>

    <div style="margin-top: 30px;">
      <?php include("../php/consultarProducto.php"); ?>
    </div>
  </div>
</body>
</html>
