<?php
session_start();

if (isset($_GET['cod'])) {
  $cod = $_GET['cod'];
  unset($_SESSION['carrito'][$cod]);
}

header("Location: ../formularios/registroFactura.php");
exit;
?>
