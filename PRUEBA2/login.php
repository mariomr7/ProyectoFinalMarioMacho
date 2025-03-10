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
<!-- Se incluye el archivo header.php, que abre el HTML, carga el CSS y puede iniciar la sesión -->

<div class="index-hero">
  <!-- Contenedor con el fondo definido en CSS para la página de acceso -->
  
  <div class="login-box">
    <!-- Caja de login centrada en la pantalla -->
    
    <h2>Login Cliente</h2>
    <!-- Título del formulario de login para el cliente -->
    
    <?php
    include 'includes/conexion.php';
    // Se incluye el archivo de conexión a la base de datos para poder ejecutar consultas SQL
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Se verifica que el formulario se haya enviado mediante el método POST
        
        $email = trim($_POST['email']);
        // Se obtiene y limpia el email enviado en el formulario
        
        $password = trim($_POST['password']);
        // Se obtiene y limpia la contraseña enviada en el formulario

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Se valida que el email tenga un formato correcto
            echo "<p style='color:red;'>Email inválido.</p>";
        } else {
            // Se prepara la consulta SQL para buscar en la tabla 'socios' el registro con el email indicado
            $stmt = mysqli_prepare($conexion, "SELECT * FROM socios WHERE email = ? LIMIT 1");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($result && mysqli_num_rows($result) > 0) {
                    // Si se encuentra un registro, se obtiene la información del usuario
                    $cliente = mysqli_fetch_assoc($result);
                    // Se verifica que la contraseña ingresada coincida con el hash almacenado en la base de datos
                    if (password_verify($password, $cliente['password'])) {
                        // Si la contraseña es correcta, se guarda la información del cliente en la sesión
                        $_SESSION['cliente'] = $cliente;
                        
                        // Si el checkbox "Recuérdame" está marcado, se crea una cookie que dura 1 semana (7 días)
                        if (isset($_POST['remember'])) {
                            setcookie("cliente_email", $email, time() + (86400 * 7), "/");
                        }
                        
                        // Se redirige al usuario a la página del menú de cliente
                        header("Location: menu_cliente.php");
                        exit();
                    } else {
                        // Si la contraseña no coincide, se muestra un mensaje de error
                        echo "<p style='color:red;'>Contraseña incorrecta.</p>";
                    }
                } else {
                    // Si no se encuentra un usuario con ese email, se muestra un mensaje de error
                    echo "<p style='color:red;'>No existe un usuario con ese email.</p>";
                }
                mysqli_stmt_close($stmt);
            } else {
                // Si ocurre un error al preparar la consulta, se muestra un mensaje de error
                echo "<p style='color:red;'>Error en la consulta.</p>";
            }
        }
    }
    ?>
    <!-- Fin del bloque PHP que procesa el formulario de login -->
    
    <form action="login.php" method="post">
      <!-- Formulario para que el cliente ingrese sus datos de acceso (se envían mediante POST a esta misma página) -->
      
      <label for="email">Email</label>
      <input type="email" name="email" id="email" required>
      
      <label for="password">Contraseña</label>
      <input type="password" name="password" id="password" required>
      
      <!-- Checkbox para "Recuérdame" -->
      <div>
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Recuérdame</label>
      </div>
      
      <input type="submit" value="Ingresar">
    </form>
    
    <p><a href="registro.php">¿No tienes cuenta? Regístrate aquí</a></p>
    <p><a href="index.php">Volver al Inicio</a></p>
  </div>
</div>

</body>
</html>

