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

<div class="index-hero">
  <!-- Contenedor con el estilo de fondo exclusivo (por ejemplo, imagen de fondo definida en la clase index-hero) -->

  <div class="login-box">
    <!-- Caja centrada para el formulario de registro -->

    <h2>Registro de Cliente</h2>
    <!-- Título del formulario de registro -->

    <?php
    include 'includes/conexion.php';
    // Se incluye el archivo de conexión a la base de datos para poder ejecutar consultas SQL

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Se comprueba si el formulario ha sido enviado mediante el método POST

        // Se recogen y limpian los datos enviados por el formulario
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        
        // Validación: Se verifica que ningún campo esté vacío
        if (empty($nombre) || empty($apellido) || empty($email) || empty($password)) {
            echo "<p style='color:red;'>Todos los campos son obligatorios.</p>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Validación del formato del email
            echo "<p style='color:red;'>Email inválido.</p>";
        } else {
            // Se prepara una consulta SQL para verificar si el email ya existe en la base de datos
            $stmt = mysqli_prepare($conexion, "SELECT id_socio FROM socios WHERE email = ? LIMIT 1");
            mysqli_stmt_bind_param($stmt, "s", $email); // Se vincula el parámetro $email a la consulta
            mysqli_stmt_execute($stmt); // Se ejecuta la consulta
            mysqli_stmt_store_result($stmt); // Se almacena el resultado

            if (mysqli_stmt_num_rows($stmt) > 0) {
                // Si ya existe un registro con ese email, se muestra un mensaje de error
                echo "<p style='color:red;'>El email ya está registrado.</p>";
            } else {
                // Si el email no existe, se procede a registrar el nuevo usuario
                mysqli_stmt_close($stmt); // Se cierra la sentencia anterior

                // Se genera el hash de la contraseña utilizando password_hash
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                // Se obtiene la fecha actual para el registro
                $fecha_inscripcion = date("Y-m-d");

                // Se prepara la consulta para insertar el nuevo usuario en la tabla 'socios'
                $stmt = mysqli_prepare($conexion, "INSERT INTO socios (nombre, apellido, email, password, fecha_inscripcion) VALUES (?, ?, ?, ?, ?)");
                // Se vinculan los parámetros correspondientes
                mysqli_stmt_bind_param($stmt, "sssss", $nombre, $apellido, $email, $hashedPassword, $fecha_inscripcion);

                if (mysqli_stmt_execute($stmt)) {
                    // Si la inserción es exitosa, se muestra un mensaje de confirmación
                    echo "<p style='color:green;'>Registro exitoso. Ahora puedes iniciar sesión.</p>";
                } else {
                    // Si ocurre un error durante la inserción, se muestra el mensaje de error con detalles
                    echo "<p style='color:red;'>Error en el registro: " . mysqli_error($conexion) . "</p>";
                }
            }
            // Se cierra la sentencia preparada
            mysqli_stmt_close($stmt);
        }
    }
    ?>
    <!-- Fin del bloque PHP para procesar el formulario de registro -->

    <form action="registro.php" method="post">
      <!-- Formulario que envía los datos a la misma página (registro.php) mediante el método POST -->
      
      <label for="nombre">Nombre</label>
      <!-- Etiqueta para el campo "Nombre" -->
      
      <input type="text" name="nombre" id="nombre" required>
      <!-- Campo de entrada para el nombre (obligatorio) -->
      
      <label for="apellido">Apellido</label>
      <!-- Etiqueta para el campo "Apellido" -->
      
      <input type="text" name="apellido" id="apellido" required>
      <!-- Campo de entrada para el apellido (obligatorio) -->
      
      <label for="email">Email</label>
      <!-- Etiqueta para el campo "Email" -->
      
      <input type="email" name="email" id="email" required>
      <!-- Campo de entrada para el email (obligatorio) y con validación de tipo email -->
      
      <label for="password">Contraseña</label>
      <!-- Etiqueta para el campo "Contraseña" -->
      
      <input type="password" name="password" id="password" required>
      <!-- Campo de entrada para la contraseña (obligatorio) -->
      
      <input type="submit" value="Registrarse">
      <!-- Botón para enviar el formulario -->
    </form>
    
    <p><a href="login.php">¿Ya tienes cuenta? Inicia sesión aquí</a></p>
    <!-- Enlace para redirigir a la página de inicio de sesión en caso de que el usuario ya esté registrado -->
  </div>
</div>

</body>
</html>

