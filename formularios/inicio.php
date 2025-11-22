<?php
session_start();
include("../php/conectar.php"); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="../css/login.css">
</head>
<body>

  <div class="login-container">
    <h2>🔐 Iniciar Sesión</h2>


    <form action="../php/procesarUsuario.php" method="POST">
      <label for="usuario">Usuario:</label>
      <input type="text" id="usuario" name="usuario" required placeholder="Ingrese su usuario">

      <label for="clave">Contraseña:</label>
      <input type="password" id="clave" name="clave" required placeholder="Ingrese su contraseña">

      <label for="categoria">Categoría:</label>
      <select id="categoria" name="categoria" required>
        <option value="">Seleccione...</option>
        <option value="A">Administrador</option>
        <option value="M">Mesero</option>
      </select>

      <div class="botones">
        <input type="submit" value="Ingresar">
      </div>
    </form>

    <a href="indexusuario.php" class="volver">← Regresar</a>
  </div>

</body>
</html>
