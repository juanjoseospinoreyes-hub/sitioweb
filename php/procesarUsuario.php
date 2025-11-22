<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conectar.php");

$usuario = $_POST['usuario'] ?? '';
$clave   = $_POST['clave'] ?? '';

if (empty($usuario) || empty($clave)) {
    die("Todos los campos son obligatorios.");
}

$sql = "SELECT * FROM usuario WHERE IDUSUARIO = ?";
$stmt = $conexion->prepare($sql);  // 

if (!$stmt) {
    die("Error al preparar la consulta: " . $conexion->error);
}

$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($clave === $row['CLAVE']) {
        session_start();
        $_SESSION['usuario'] = $row['IDUSUARIO'];
        $_SESSION['categoria'] = $row['CATEGORIA'];

        if ($row['CATEGORIA'] === "A") {
            header("Location: ../indexp.html");
            exit;
        } elseif ($row['CATEGORIA'] === "M") {
            header("Location: ../index.html");
            exit;
        } else {
            echo "Categoría desconocida.";
        }
    } else {
        echo "<script>alert('⚠️ Contraseña incorrecta'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('⚠️ Usuario no encontrado'); window.history.back();</script>";
}

$stmt->close();
$conexion->close(); 
?>
