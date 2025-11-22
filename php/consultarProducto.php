<?php
include("conectar.php");

$sql = "SELECT a.CODARTICULO, a.DESCRIPCION, a.PRECIOUNI, a.EXISTENCIA, 
               a.MINEXISTENCIA, a.MAXEXISTENCIA, c.DESCRIPCION AS CATEGORIA
        FROM articulo a
        INNER JOIN CATEGORIA c ON a.IDCATEGORIA = c.COD";

$resultado = mysqli_query($conexion, $sql);
?>

<h2 class="titulo">📦 Lista de Artículos Registrados</h2>
<table>
  <tr>
    <th>Código</th>
    <th>Descripción</th>
    <th>Categoría</th>
    <th>Precio</th>
    <th>Existencia</th>
    <th>Mínimo</th>
    <th>Máximo</th>
    <th>Acciones</th>
  </tr>

  <?php while ($fila = mysqli_fetch_array($resultado)) { ?>
  <tr>
    <td><?php echo $fila['CODARTICULO']; ?></td>
    <td><?php echo $fila['DESCRIPCION']; ?></td>
    <td><?php echo $fila['CATEGORIA']; ?></td>
    <td><?php echo $fila['PRECIOUNI']; ?></td>
    <td><?php echo $fila['EXISTENCIA']; ?></td>
    <td><?php echo $fila['MINEXISTENCIA']; ?></td>
    <td><?php echo $fila['MAXEXISTENCIA']; ?></td>
    <td>
      <a class="editar" href="../php/actualizarProducto.php?cod=<?php echo $fila['CODARTICULO']; ?>">Editar</a>
      <a class="eliminar" href="../php/eliminarProducto.php?cod=<?php echo $fila['CODARTICULO']; ?>" onclick="return confirm('¿Seguro que desea eliminar este artículo?')">Eliminar</a>
    </td>
  </tr>
  <?php } ?>
</table>
