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
<body>

<div class="index-hero">
  <div class="login-box">
    <h2>Inicio de Sesión - Administrador</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuario = trim($_POST['usuario']);
        $contrasena = trim($_POST['contrasena']);
        
        // Credenciales de admin (ejemplo)
        if ($usuario === 'admin' && $contrasena === 'admin123') {
            $_SESSION['admin'] = true;
            header("Location: panel_admin.php");
            exit();
        } else {
            echo "<p style='color:red;'>Credenciales incorrectas.</p>";
        }
    }
    ?>
    <form action="login_admin.php" method="post">
      <label for="usuario">Usuario</label>
      <input type="text" name="usuario" id="usuario" required>
      <label for="contrasena">Contraseña</label>
      <input type="password" name="contrasena" id="contrasena" required>
      <input type="submit" value="Ingresar">
    </form>
    <p><a href="index.php">Volver al Inicio</a></p>
  </div>
</div>

</body>
</html>
