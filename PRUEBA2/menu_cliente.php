<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Club Deportivo</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<?php
if (!isset($_SESSION['cliente'])) {
    header("Location: login.php");
    exit();
}
?>
<div class="menu-screen">
  
    <!-- Botón para cerrar (opcional) -->
    <div class="menu-close">
      <a href="logout.php">X</a>
    </div>
    <h2 class="menu-title">MENÚ</h2>
    <a class="menu-button" href="tipo_pista.php">Tipos de pistas</a>
    <a class="menu-button" href="panel_cliente.php#reservar">Reservar</a>
    <a class="menu-button" href="index.php">Salir</a>
  </div>
</div>
</body>
</html>

